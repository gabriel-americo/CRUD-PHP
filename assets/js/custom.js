$(document).ready(function () {
    $('#errolog').hide();
    $('#formlogin').submit(function () {
        var login = $('#usuario').val();
        var senha = $('#senha').val();
        $('.loader').show();
        $.ajax({
            url: "redirecionar.php",
            type: "post", //MÃ©todo de envio
            data: "login=" + login + "&senha=" + senha, //Dados
            success: function (result) {
                if (result == 1) {
                    location.href = 'index.php'
                } else {
                    $('.loader').hide();
                    $('#errolog').show();
                }
            }
        });
        return false;
    });

    $('.deletar').click(function () {
        
        var id = $(this).attr("id").replace('d_', '');
        var pai = $(this).parents(".foto");
        var tabela = $(this).attr("data-tabela");
        var dados = "id=" + id + "&tabela=" + tabela;
        
        $.ajax({
            type: "POST",
            url: "dados/apagar_foto.php",
            data: dados,
            success: function (retorno) {
                if (retorno == 1) {
                    pai.slideUp(function () {
                        $(this).remove();
                    });
                } else {
                    alert("Erro ao apagar esta imagem");
                }
            }
        });
    });

    $('.delete').click(function () {
        var id = $(this).attr('id').replace('del_', '');
        var pag = $(this).attr('data-pag');
        $.ajax({
            type: 'POST',
            url: 'dados/delete.php',
            data: {id: id, pag: pag},
            success: function (data) {
                if (data == "delete") {
                    $('tr td a#del_' + id).fadeOut().remove();
                } else {
                    alert("Não foi possivel deletar essa linha!");
                }
            }
        });
    });
});


