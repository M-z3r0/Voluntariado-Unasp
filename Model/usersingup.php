<?php
session_start();
require_once '../config/connection.php';

function create($pdo, $user_name, $user_nickname, $user_email, $user_password) {
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (user_name, user_nickname, user_email, user_password)
                               VALUES (:user_name, :user_nickname, :user_email, :user_password)");

        $passwordHash = password_hash($user_password, PASSWORD_DEFAULT);

        $stmt->bindParam(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindParam(":user_nickname", $user_nickname, PDO::PARAM_STR);
        $stmt->bindParam(":user_email", $user_email, PDO::PARAM_STR);
        $stmt->bindParam(":user_password", $passwordHash, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Retorna os dados inseridos
            return [
                'user_email' => $user_email,
                'user_id' => $pdo->lastInsertId(),
                'user_nickname' => $user_nickname,
                'user_type' => 0
            ];
        }
        return false;
    } catch (PDOException $e) {
        return false;
    }
}
