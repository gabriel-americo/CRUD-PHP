$(document).ready(function () {

    $(function () {

        var numSuccess = 0;
        var numError = 0;
        var failedFiles = [];
        var dataListFail = [];

        var ul = $('#upload ul');

        $('#drop a').click(function () {
            $(this).parent().find('input').click();
        });

        $('#upload').fileupload({
            dropZone: $('#drop'),
            add: function (e, data) {
                var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"' + 'data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
                tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
                data.context = tpl.appendTo(ul);
                tpl.find('input').knob();
                tpl.find('span').click(function () {

                    if (tpl.hasClass('working')) {
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function () {
                        tpl.remove();
                    });
                });

                var jqXHR = data.submit().success(function (result, textStatus, jqXHR) {
                    var json = JSON.parse(result);
                    var status = json['status'];

                    if (status == 'error') {
                        data.context.addClass('error');
                        numError++;
                        failedFiles.push(data.files[0].name);
                        dataListFail.push(data);
                    } else {
                        numSuccess++;
                    }

                    updateNote();

                    setTimeout(function () {
                        data.context.fadeOut('slow');
                    }, 3000);
                });
            },
            progress: function (e, data) {

                var progress = parseInt(data.loaded / data.total * 100, 10);

                data.context.find('input').val(progress).change();

                if (progress == 100) {
                    data.context.removeClass('working');
                }
            },
            fail: function (e, data) {
                data.context.addClass('error');
                numError++;
                updateNote();
                dataListFail.push(data);
            }
        });

        $(document).on('drop dragover', function (e) {
            if (failedFiles.length > 0)
                e.preventDefault();
        });

        $(document).on('click', '#note-error', function (e) {
            if (failedFiles.length > 0)
                alert(failedFiles.join("\n"));
        });

        $(document).on('click', '#btn-retry', function (e) {
            e.preventDefault();
            failedFiles.length = 0;
            numError = 0;
            if ($('#note').length)
                $('#note').html('');
            var dataListFailClone = dataListFail.slice();
            dataListFail.length = 0;
            $.each(dataListFailClone, function () {
                if (this.context != null)
                    this.context.remove();
                $('#upload').fileupload('add', this);
            });
        });

        function updateNote() {
            if ($('#note').length)
                $('#note').html('<span>' + numSuccess + '</span> Enviados com sucesso!<br /><span id="note-error">' + numError + '</span> Falharam (Limite 30 Fotos).' + (numError > 0 ? '<a href="#" id="btn-retry">(Tentar)</a>' : ''));
        }

        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }
            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }
            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }
            return (bytes / 1000).toFixed(2) + ' KB';
        }
    });
});