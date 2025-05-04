<?php
session_start();
require_once '../config/connection.php';
require_once '../model/userlogin.php';

function redirectWithError($msg) {
    $_SESSION['error'] = $msg;
    header('Location: ../view/loginViews/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['user_email'] ?? '');
    $password = $_POST['user_password'] ?? '';

    if (empty($email) || empty($password)) {
        redirectWithError('Preencha todos os campos');
    }

    $user = validateLogin($pdo, $email, $password);

    if (!$user) {
        redirectWithError('Email ou senha incorretos.');
    }

    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_nickname'] = $user['user_nickname'];
    $_SESSION['user_type'] = $user['user_type'];

    header("Location: ../view/index.php");
    exit;
}
