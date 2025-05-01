<?php 
function validateLogin($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE user_email = ? AND user_password = ?");
    $stmt->execute([$email, $password]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário ou false
}