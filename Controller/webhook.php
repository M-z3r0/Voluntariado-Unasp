<?php
session_start();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['status']) && $data['status'] === 'CONFIRMADO'){
  // aqui deve salvar o status do pagamento no banco de dados, do jeito que está não vai funcionar pois a sessão pode não ser a mesma
  $_SESSION['pago'] = true;
  http_response_code(200);
  exit;
}

http_response_code(400);
?>