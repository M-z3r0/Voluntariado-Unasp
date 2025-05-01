<?php
    session_start();
    $error = $_SESSION['error'] ?? '';
    unset($_SESSION['error']); // Limpa a mensagem após exibir
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/styles/login.css">
    <title>Página de Login</title>
</head>
<body>
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <section class="container" id="container">
        <div class="form-container sign-up">
         
            <form action="loginController.php">
                <h1>Criação de conta</h1>
                <input type="text" name="user_reg_name" id="user_reg_name" placeholder="Nome...">
                <input type="text" name="user_reg_nickname" id="user_reg_nickname" placeholder="Nome de usuário...">
                <input type="email" name="user_reg_email" id="user_reg_email" placeholder="Email...">
                <h4 class="emailFeedBack"></h4>
                <input type="password" name="user_reg_password" id="user_reg_password" placeholder="Senha...">
                <ul>
                    <li>A senha deve conter no mínimo 8 caracteres</li>
                    <li>A senha deve conter letras e números [a1b2]</li>
                    <li>A senha deve conter letras maiúsculas e minusculas [aAbB]</li>
                    <li>A senha deve conter caracteres especiais [@&%$]</li>
                </ul>
                <input type="password" name="user_reg_confirmedpassword" id="user_reg_confirmedpassword" placeholder="Confirmação de senha...">
                <h4 class="confirmedpasswordFeedBack"></h4>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="../../Controller/loginController.php" method="POST">
                <h1>Entrar na sua conta</h1>
                <input type="email" name="user_email" id="user_email" placeholder="Email...">
                <input type="password" name="user_password" id="user_password" placeholder="Senha...">
                <a href="#">Esqueci minha senha</a>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Entre usando seu email e senha de cadastro</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Seja bem vindo!</h1>
                    <p>Preencha os campos para finalizar seu registero</p>
                    <button class="hidden" id="register">Sign up</button>
                </div>
            </div>
        </div>
    </section>
    <script src="../../public/scripts/login.js"></script>
</body>
</html>