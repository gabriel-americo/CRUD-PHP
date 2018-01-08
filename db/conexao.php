<?php

function conectar() {
    
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=crud", $user, $pass);
    } catch (PDOException $e) {
        $e->getMessage();
    }

    return $pdo;
}