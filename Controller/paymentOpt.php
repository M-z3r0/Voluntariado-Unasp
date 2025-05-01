<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $metodo = $_POST["metodo"] ?? "";

    if ($metodo === "pix") {
        header("Location: pagina_pix.php");
        exit;
    } elseif ($metodo === "cartao") {
        header("Location: pagina_cartao.php");
        exit;
    } else {
   
        echo "Método de pagamento inválido.";
    }
} else {
    echo "Acesso inválido.";
}
?>
