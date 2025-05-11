<?php
// verificar_pagamento.php
require '../config/connection.php';

if (isset($_GET['txid'])) {
    $txid = $_GET['txid'];

    // Consulta no banco de dados para verificar o status do pagamento
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT status FROM pagamentos_pix WHERE txid = ?");
    $stmt->bind_param("s", $txid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Se o status do pagamento for 'CONCLUIDA', retorna um JSON com 'pago' como true
        if ($row['status'] === 'CONCLUIDA') {
            echo json_encode(['pago' => true]);
        } else {
            // Caso contrário, retorna como 'pendente'
            echo json_encode(['pago' => false]);
        }
    } else {
        echo json_encode(['pago' => false]);
    }
}
