<?php
session_start();
header('Content-Type: application/json');
require_once '../config/connection.php';
$response = ['pago' => false];

if (isset($_SESSION['txid'])) {
    $txid = $_SESSION['txid'];
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT status FROM pagamentos_pix WHERE txid = ?");
    $stmt->bind_param("s", $txid);
    $stmt->execute();
    $result = $stmt->get_result();
    $pagamento = $result->fetch_assoc();

    if ($pagamento && $pagamento['status'] === 'confirmado') {
        $response['pago'] = true;
    }
}

echo json_encode($response);