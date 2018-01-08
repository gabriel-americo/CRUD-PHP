<?php

function upload_arquivo($nome_arquivo, $tmp, $caminho) {
    $caminho_final = $caminho . $nome_arquivo;
    if (move_uploaded_file($tmp, $caminho_final)) {
        return true;
    }
}

function apaga_arquivo($caminho, $arquivo) {
    foreach ($caminho as $value) {
        if (file_exists($caminho[$value] . $arquivo[$value])) {
            unlink($caminho[$value] . $arquivo[$value]);
        }
    }
}
