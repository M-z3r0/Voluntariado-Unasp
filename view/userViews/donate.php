<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../../controller/pix.php">
        <input type="text" name="user_name" placeholder="Seu nome" required><br>
        <input type="number" name="don_value" step="0.50" placeholder="Valor da doação (R$)" required><br>
        <button type="submit">Gerar QR Code</button>
    </form>
</body>
</html>