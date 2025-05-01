<?php
session_start();
require '../../config/connection.php';


// Verifique se o usuário está logado
if (isset($_SESSION["user_email"])) {
    echo 'Success';
} else {
    echo 'Não logado';
}
?>
