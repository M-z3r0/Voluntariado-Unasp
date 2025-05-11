<?php
require '../vendor/autoload.php';

$clientId = 'Client_Id_22ae20f49e403bfec5c710cd407fa54a592b6b1e';
$clientSecret = 'Client_Secret_ab3fcd14a08e0db24e6cbec7cad8305fe00ae5b8';
$certificado = '../certs/cert.pem';
$pixKey = '44f96cf9-b152-4e0e-8d46-425c6477b312'; // sua chave Pix

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'certificate' => $certificado,
    'sandbox' => true // true se estiver em ambiente de teste
];

// 👇 USE sua URL gerada pelo Ngrok:
$webhookUrl = 'https://fa8b-2804-7f0-b081-6fdc-4896-c740-222d-3ed7.ngrok-free.app/voluntariado-Unasp/Controller/webhook.php';

try {
    $api = new Gerencianet\Gerencianet($options);

    $params = ['chave' => $pixKey];
    $body = ['webhookUrl' => $webhookUrl];

    $response = $api->pixConfigWebhook($params, $body);

    echo "<pre>";
    print_r($response);
    echo "</pre>";
} catch (Exception $e) {
    echo 'Erro ao configurar webhook: ' . $e->getMessage();
}
