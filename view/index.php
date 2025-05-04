<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/style.css">nk
    <title>Página inicial - Voluntariados</title>
</head>
<body>
    <header>
        <a href=""><img src="" alt="logo"></a>
        <div>
            <ul>
                <li><a href="">Resgatar</a></li>
                <li><a href="">Sobre nós</a></li>
                <li><a href="">FAQ</a></li>
                <li><a href="userViews/donate.php">Doar</a></li>
                <li><a href="">Missões</a></li>
                <?php
                    if((isset($_SESSION) and !empty($_SESSION['user_id']))){
                        if($_SESSION['user_type'] === 2) {
                            ?>
                                <li><a href="admViews/admDash.php"><?php echo($_SESSION['user_nickname']);?></a></li>
                            <?php
                        }else{
                            ?>
                                <li><a href="userViews/userDash.php"><?php echo($_SESSION['user_nickname']);?></a></li>
                            <?php
                        }
                    }else{
                        ?>
                            <li><a href="loginViews/login.php">logar</a></li>
                        <?php
                    }
                ?>
            </ul><!--Menu Header-->
        </div>
    </header><!--Header-->
    <main>
        <section>
            <img src="" alt="Imagens fodas carossel explosão uaw">
        </section><!--Container - Contéudo 1-->
        <section>

            <!-- Botão de Doar -->
            <button id="openModalBtn">DOAR</button>

            <div id="donationModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModalBtn">&times;</span>
                    <form method="POST" action="../controller/paymentOpt.php">
                        <label for="metodo">Escolha o método de pagamento:</label><br><br>
                        <select name="metodo" id="metodo">
                            <option value="pix">PIX</option>
                            <option value="cartao">Cartão</option>
                        </select><br><br>
                        <button type="submit">Continuar</button>
                    </form>
                </div>
            </div><!--Donate Modal -->
        </section><!--Container - Doação-->
        <section>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam placeat eveniet aut impedit distinctio, illum sapiente quas ut asperiores odio, exercitationem corrupti error accusamus quasi consectetur neque explicabo quam deserunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit illum fuga, dolor pariatur a ipsa doloremque, tempora quibusdam sint natus adipisci id cum vitae consectetur quis ipsam minima molestiae. Esse?</p>
        </section><!--Container - Sobre nós-->
    </main><!--Content containers-->
    <footer>
        <p>Todos direitos reservados - &copy;2025 equipe MRM</p>
    </footer><!--Footer-->
    <script src="../public/scripts/script.js"></script>
</body>
</html>