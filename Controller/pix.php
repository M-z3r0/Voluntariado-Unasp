<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['user_name'] ?? '';
        $valor = floatval($_POST['don_value'] ?? 0);

        if ($nome && $valor > 0) {
            require_once 'gerencianet_pix.php';
            $qrcode = gerarCobrancaPix($nome, $valor);
            echo "foi";
            if (isset($qrcode['erro'])) {
                $erro = $qrcode['erro'];
                $qrcode = null;
            }
        }
    }
?>