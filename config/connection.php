<?php

    function getDbConnection() {
    $host = 'localhost';
    $usuario = 'root'; // ajuste conforme seu banco
    $senha = '';
    $banco = 'bd_voluntariado';

    $conn = new mysqli($host, $usuario, $senha, $banco);
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $conn->set_charset('utf8');
    return $conn;
}

?>