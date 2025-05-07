<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doações em Pix</title>
    <link rel="stylesheet" href="../../public/styles/donatePix.css">
</head>

<body>
    <header>
        <a href="../index.php"><img src="" alt="logo"></a>
        <div>
            <ul>
                <li><a href="">Resgatar</a></li>
                <li><a href="">Sobre nós</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="userViews/donatePix.php">Doar</a></li>
                <li><a href="">Missões</a></li>
                <?php
                if ((isset($_SESSION) && !empty($_SESSION['user_id']))) {
                    if ($_SESSION['user_type'] === 2) {
                        echo '<li><a href="admViews/admDash.php">' . htmlspecialchars($_SESSION['user_nickname']) . '</a></li>';
                    } else {
                        echo '<li><a href="userViews/userDash.php">' . htmlspecialchars($_SESSION['user_nickname']) . '</a></li>';
                    }
                } else {
                    echo '<li><a href="loginViews/login.php">Logar</a></li>';
                }
                ?>
            </ul>
        </div>
    </header>

    <main class="container">
        <section class="why-donate">
            <h1>Por que doar?</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae omnis tenetur, veritatis voluptates
                nisi facilis hic nemo odit optio voluptatibus accusantium odio fugiat iusto at doloremque iste. Nemo,
                pariatur cum?</p>
            <p>Voluptate deserunt dolore unde, voluptas, beatae laboriosam dolorem aut maxime animi explicabo quam! Jure
                quas quaerat eaque doloribus nihil, ullam tempore cum sequi reiciendis, itaque ex, eum perferendis harum
                libero.</p>
        </section>

        <section class="donate-form">
            <h2>Faça sua doação via PIX</h2>
            <form method="post" action="../../controller/pix.php">

                <input type="text" name="user_name" placeholder="Seu nome" required>
                <input type="number" name="don_value" step="0.50" placeholder="Valor da doação (R$)" required>
                <button type="submit">Gerar QR Code</button>
            </form>
        </section>
    </main>

    <footer>
        <p>Todos direitos reservados - &copy;2025 equipe MRM</p>
    </footer>
</body>

</html>