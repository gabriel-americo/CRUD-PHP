<?php

include "db/conexao.php";
$pdo = conectar();

$login = $_POST['login'];
$senha = $_POST['senha'];

$sql_login = $pdo->prepare("SELECT * FROM login WHERE email='" . $login . "' and senha='" . md5($senha) . "'");
$sql_login->execute();
$res = $sql_login->fetch(PDO::FETCH_ASSOC);
$resultados = $sql_login->rowCount();

if ($resultados == 0) {
    echo 0;
} else {
    if (!isset($_SESSION))
        session_start();
    echo 1;

    $_SESSION['id'] = $res['id_login'];
    $_SESSION['email'] = $res['email'];
    exit;
}