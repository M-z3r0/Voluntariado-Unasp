<?php
session_start();

// Se já foi pago ou expirou, redireciona
if (isset($_SESSION['pago']) && $_SESSION['pago'] === true) {
    session_destroy();
    header('Location: ../view/index.php');
    exit;
}

if (isset($_SESSION['pix_expire']) && time() > $_SESSION['pix_expire']) {
    session_destroy();
    header('Location: ../view/index.php');
    exit;
}

$qrcode = null;
$txid = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['user_name'] ?? '';
    $valor = floatval($_POST['don_value'] ?? 0);

    if ($nome && $valor > 0) {
        require_once 'gerencianet_pix.php';
        $qrcode = gerarCobrancaPix($nome, $valor);

        if (isset($qrcode['txid'])) {
            $_SESSION['txid'] = $qrcode['txid'];
            $txid = $qrcode['txid'];
        }

        if (isset($qrcode['erro'])) {
            echo 'Erro: ' . $qrcode['erro'];
        } else {
            echo '<h2>Doação de R$ ' . number_format($valor, 2, ',', '.') . '</h2>';
            echo '<p><strong>Escaneie o QR Code abaixo ou use a chave Copia e Cola:</strong></p>';
            echo '<img src="' . $qrcode['imagemQrcode'] . '" alt="QR Code Pix"><br>';
            echo '<input type="text" value="' . $qrcode['qrcode'] . '" readonly style="width: 100%; padding: 10px;" onclick="this.select();">';
        }
    }
}
?>

<?php if (!empty($txid)): ?>
<script>
    const verificarPagamento = () => {
        fetch('verificar_pagamento.php?txid=<?php echo htmlspecialchars($txid); ?>')
            .then(res => res.json())
            .then(data => {
                if (data.pago) {
                    alert('Pagamento confirmado com sucesso!');
                    window.location.href = '../view/userViews/aa.php';
                }
            })
            .catch(err => console.error('Erro ao verificar pagamento:', err));
    };

    setInterval(verificarPagamento, 5000);
</script>
<?php endif; ?>
