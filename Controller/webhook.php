<?php
file_put_contents('log.txt', "Webhook acessado em " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

require '../vendor/autoload.php';
require_once '../config/connection.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// ✅ Confirma que veio um pagamento concluído
if (isset($data['pix'][0]['txid']) && $data['pix'][0]['status'] === 'CONCLUIDA') {
    $txid = $data['pix'][0]['txid'];

    try {
        $pdo = getDbConnection(); // <- sua função que retorna PDO
        $stmt = $pdo->prepare("UPDATE pagamentos_pix SET status = 'confirmado' WHERE txid = ?");
        $stmt->execute([$txid]);

        // Log extra pra ajudar
        file_put_contents('log.txt', "Pagamento confirmado: $txid\n", FILE_APPEND);
        
        http_response_code(200);
        exit;
    } catch (Exception $e) {
        file_put_contents('log.txt', "Erro no banco: " . $e->getMessage() . "\n", FILE_APPEND);
        http_response_code(500);
        exit;
    }
}

http_response_code(400);
