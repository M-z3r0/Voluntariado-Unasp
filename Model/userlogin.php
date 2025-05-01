<?php 
    function validateLogin($pdo, $email, $password) {
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE user_email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['user_password'])) {
            return $user;
        }
        return false;
    }