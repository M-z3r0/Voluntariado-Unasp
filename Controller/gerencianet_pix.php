<?php
function gerarCobrancaPix($nome, $valor)
{
    require_once '../config/connection.php';
    require '../vendor/autoload.php';
    if(!isset($_SESSION)){
        session_start();
    }
    

    $clientId = 'Client_Id_22ae20f49e403bfec5c710cd407fa54a592b6b1e';
    $clientSecret = 'Client_Secret_ab3fcd14a08e0db24e6cbec7cad8305fe00ae5b8';
    $pixKey = '44f96cf9-b152-4e0e-8d46-425c6477b312';
    $certificado = '../certs/cert.pem';

   
    $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'certificate' => $certificado,
        'sandbox' => false
    ];

    $valorFormatado = number_format($valor, 2, '.', '');

    $body = [
        'calendario' => ['expiracao' => 600],
        'valor' => ['original' => $valorFormatado],
        'chave' => $pixKey,
        'solicitacaoPagador' => 'Doação'
    ];

    $api = new Gerencianet\Gerencianet($options);
    $response = $api->pixCreateImmediateCharge([], $body);
    $loc = $response['loc']['id'];
    $txid = $response['txid'];

    $qrcode = $api->pixGenerateQRCode(['id' => $loc]);

    // Salva no banco
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("INSERT INTO pagamentos_pix (txid, nome, valor) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $txid, $nome, $valorFormatado);
    $stmt->execute();
    $stmt->close();

    $_SESSION['txid'] = $txid;

    return $qrcode;
}