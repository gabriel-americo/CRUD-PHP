<?php
$pagina = 2;
include "include/header.php";

if (isset($_GET['codigo'])) {
    $sql = $pdo->prepare("SELECT * FROM pessoa WHERE codigo = '" . $_GET['codigo'] . "'");
    $sql->execute();
    $dados = $sql->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title"> Pessoas </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.php">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span> Pessoas </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="fa fa-file-o"></i>
                            <span class="caption-subject bold uppercase"> Pessoas </span>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" action="<?php echo $url ?>dados/pessoa.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="codigo" value="<?php echo (isset($_GET['codigo'])) ? $_GET['codigo'] : '' ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" type="text" placeholder="Nome" name="nome" value="<?php echo (isset($dados['nome'])) ? $dados['nome'] : '' ?>"> 
                                </div>
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea class="form-control" rows="3" name="descricao"><?php echo (isset($dados['descricao'])) ? $dados['descricao'] : '' ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Arquivo</label>
                                    <input class="form-control" type="file" name="arquivo"> 
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn blue" type="submit">Salvar</button>
                                <button class="btn default" type="button" onClick="history.go(-1)">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php" ?>