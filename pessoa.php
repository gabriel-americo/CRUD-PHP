<?php include("include/header.php") ?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h1 class="page-title"> Pessoas </h1>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="#">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Pessoas</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo $url ?>pessoa_novo.php"><button type="button" class="btn btn-primary margin-bottom-15">Adicionar</button></a>
            </div>
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"> <i class="fa fa-image"></i> Pessoas </div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body flip-scroll">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th> Código </th>
                                    <th> Nome </th>
                                    <th> Descrição </th>
                                    <th> Arquivo </th>
                                    <th> Editar </th>
                                    <th> Remover </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = $pdo->prepare("SELECT * FROM pessoa");
                                $sql->execute();
                                while ($dados = $sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr id="conteudo_<?php echo $dados['codigo'] ?>">
                                        <td> <?php echo $dados['codigo'] ?> </td>
                                        <td> <?php echo $dados['nome'] ?> </td>
                                        <td> <?php echo $dados['descricao'] ?> </td>
                                        <td> <?php echo $dados['arquivo'] ?> </td>
                                        <td> <a href="<?php echo $url ?>pessoa_novo.php?codigo=<?php echo $dados['codigo'] ?>"><i class="fa fa-pencil"></i></a> </td>
                                        <td> <a href="#" class="delete" id="del_<?php echo $dados['codigo'] ?>" data-pag="pessoa"><i class="fa fa-trash"></i></a> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


<?php

$n = fgets(STDIN);

for ($i=0; $i<$n; $i++){

    $input = split(" ", fgets(STDIN));
    
    
    echo $input[0] . " " . $input[1];
}

?>

<?php include ("include/footer.php") ?>