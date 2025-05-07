<?php
function gerarCobrancaPix($nome, $valor)
{
    require '../vendor/autoload.php';
    session_start();

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


    $valorFormatado = number_format(floatval($valor), 2, '.', '');


    $body = [
        'calendario' => ['expiracao' => 600],
        'valor' => ['original' => $valorFormatado],
        'chave' => $pixKey,
        'solicitacaoPagador' => 'Doação'
    ];

    try {

        $api = new Gerencianet\Gerencianet($options);


        $response = $api->pixCreateImmediateCharge([], $body);
        $loc = $response['loc']['id'];


        $qrcode = $api->pixGenerateQRCode(['id' => $loc]);

        $_SESSION['pix_expire'] = time() + 60; // definido como 60 segundos para teste apenas
        $_SESSION['txid'] = $response['txid'];
        $_SESSION['pago'] = false;


        echo '<h2>Doação de R$ ' . number_format($valor, 2, ',', '.') . '</h2>';


        echo '<p><strong>Escaneie o QR Code abaixo ou use a chave Copia e Cola:</strong></p>';
        echo '<img src="' . $qrcode['imagemQrcode'] . '" alt="QR Code Pix">';
        echo '<br>';
        echo '<input type="text" value="' . $qrcode['qrcode'] . '" readonly style="width: 100%; padding: 10px;" onclick="this.select();">';

    } catch (Exception $e) {
        echo '<pre>Erro: ';
        print_r($e->getMessage());
        echo '</pre>';
    }
    ?>


    <?php
}
