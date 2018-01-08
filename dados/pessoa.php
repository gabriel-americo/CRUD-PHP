<?php

session_start();
require_once('../db/conexao.php');
require_once('../funcoes/imagem.php');
$pdo = conectar();

upload_arquivo($_FILES['arquivo']['name'], $_FILES['arquivo']['tmp_name'], '../arquivo/');

if ($_POST['codigo'] == '') {

    $insert = $pdo->prepare('INSERT INTO pessoa (`nome`, `descricao`, `arquivo`) VALUES ("' . $_POST['nome'] . '","' . $_POST['descricao'] . '","' . $_FILES['arquivo']['name'] . '")');
    $insert->execute();

} elseif (isset($_POST['codigo']) && $_POST['codigo'] != '') {

    $update = $pdo->prepare('UPDATE pessoa SET nome = "' . $_POST['nome'] . '", descricao = "' . $_POST['descricao'] . '" WHERE codigo = "' . $_POST['codigo'] . '"');
    if ($_FILES['arquivo']['name'] != '') {
        $update = $pdo->prepare('UPDATE pessoa SET arquivo = "' . $_FILES['arquivo']['name'] . '" WHERE codigo = "' . $_POST['codigo'] . '"');
    }
    $update->execute();
}

header("location:../pessoa.php");
