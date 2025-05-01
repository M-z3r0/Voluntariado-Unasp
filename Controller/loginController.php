<?php
session_start();
require_once '../config/connection.php';
require_once '../Model/userlogin.php';

$error = ''; // Inicializa a variável de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $email = trim($_POST['user_email'] ?? '');
    $password = $_POST['user_password'] ?? '';

    // Verifica se os campos foram preenchidos
    if (empty($email) || empty($password)) {
        $error = 'Preencha todos os campos';
    } else {
        // Chama a função de validação no Model
        $user = validateLogin($pdo, $email, $password);

        // Verifica se as credenciais são válidas
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Preencha todos os campos';
            header('Location: ../view/loginViews/login.php');
            exit;
        } else {
            $user = validateLogin($pdo, $email, $password);
            if ($user) {
                $_SESSION['user_email'] = $user['user_email'];
                header("Location: ../view/userViews/userDash.php");
                exit;
            } else {
                $_SESSION['error'] = 'Email ou senha incorretos';
                header('Location: ../view/loginViews/login.php');
                exit;
            }
        }
    }
}

