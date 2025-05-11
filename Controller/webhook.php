<?php
file_put_contents('log.txt', "Webhook acessado em " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

require '../vendor/autoload.php';
require_once '../config/connection.php';
if (!isset($_SESSION)) session_start();

$json = file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pix'][0]['txid']) && $data['pix'][0]['status'] === 'CONCLUIDA') {
    $txid = $data['pix'][0]['txid'];
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("UPDATE pagamentos_pix SET status = 'confirmado' WHERE txid = ?");
    $stmt->bind_param("s", $txid);
    $stmt->execute();
    http_response_code(200);
    exit;
}

http_response_code(400);
