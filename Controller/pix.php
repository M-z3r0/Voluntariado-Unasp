<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['user_name'] ?? '';
    $valor = floatval($_POST['don_value'] ?? 0);

    if ($nome && $valor > 0) {
        require_once 'gerencianet_pix.php';
        $qrcode = gerarCobrancaPix($nome, $valor);
    }
}
?>

<h2>Escaneie o QR Code:</h2>
<img src="<?= $qrcode['imagemQrcode'] ?>" alt="QR Code">
<input type="text" value="<?= $qrcode['qrcode'] ?>" readonly style="width: 100%" onclick="this.select();">

<script>
    const verificarPagamento = () => {
        fetch('verificar_pagamento.php')
            .then(res => res.json())
            .then(data => {
                if (data.pago) {
                    alert('Pagamento confirmado!');
                    window.location.href = '../view/userViews/aa.php';
                }
            });
    };

    setInterval(verificarPagamento, 5000);
</script>
