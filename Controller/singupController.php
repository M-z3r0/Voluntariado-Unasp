<?php
session_start();
require_once '../config/connection.php';
require_once '../Model/usersingup.php';

function redirectWithError($message) {
    $_SESSION['error'] = $message;
    header('Location: ../view/loginViews/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = trim($_POST['user_name'] ?? '');
    $user_nickname = trim($_POST['user_nickname'] ?? '');
    $user_email = trim($_POST['user_email'] ?? '');
    $user_password = $_POST['user_password'] ?? '';
    $confirm_password = $_POST['user_reg_confirmedpassword'] ?? '';

    if (empty($user_name) || empty($user_nickname) || empty($user_email) || empty($user_password)) {
        redirectWithError('Preencha todos os campos obrigatórios.');
    }

    if ($user_password !== $confirm_password) {
        redirectWithError('As senhas não coincidem.');
    }

    // Validação de senha segura
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $user_password)) {
        redirectWithError('A senha não atende aos requisitos de segurança.');
    }

    $user = create($pdo, $user_name, $user_nickname, $user_email, $user_password);

    if (!$user) {
        redirectWithError('Erro ao criar conta. Tente novamente.');
    }

    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_nickname'] = $user['user_nickname'];
    $_SESSION['user_type'] = $user['user_type'];

    header("Location: ../view/index.php");
    exit;
}
