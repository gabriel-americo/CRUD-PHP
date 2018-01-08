<?php
session_start();
require_once('../db/conexao.php');
$pdo = conectar();

if (isset($_POST["id"])) {

    $delete = $pdo->prepare('DELETE FROM '.$_POST['pag'].' WHERE id = "'.$_POST['id'].'"');
    $delete->execute();
    
    echo 'delete';
    exit;
}
