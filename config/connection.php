<?php
$host = 'localhost';
$dbname = 'bd_voluntariado';
$user = 'root';
$pass = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro ao conectar-se ao servidor: " . $e->getMessage());
    }
?>