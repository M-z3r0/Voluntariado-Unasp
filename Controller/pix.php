<?php
session_start();

// verifica se foi pago mas pode não estar funcionando pois a sessão do webhook pode ser diferente, quando houver salvamento em banco de dados, isso será corrigido
if (isset($_SESSION['pago']) && $_SESSION['pago'] === true) {
    session_destroy();
    header('Location: ../view/index.php');
    exit;
}

// verifica se a sessão expirou
if (isset($_SESSION['pix_expire']) && time() > $_SESSION['pix_expire']) {
    session_destroy();
    header('Location: ../view/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['user_name'] ?? '';
    $valor = floatval($_POST['don_value'] ?? 0);

    if ($nome && $valor > 0) {
        require_once 'gerencianet_pix.php';
        $qrcode = gerarCobrancaPix($nome, $valor);
        if (isset($qrcode['erro'])) {
            $erro = $qrcode['erro'];
            $qrcode = null;
        } else {
            echo "foi";
        }

    }
}
?>