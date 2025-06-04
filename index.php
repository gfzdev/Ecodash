<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ecodash</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <?php if (isset($_SESSION['erro'])): ?>
            <p style="color: red;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['sucesso'])): ?>
            <p style="color: green;"><?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></p>
        <?php endif; ?>
        
        
        <img src="logoEcodash.png" alt="Ecodash Logo" class="logo">
        <div class="auth-container">
            <h1>Acesse sua conta</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                
                <button type="submit" class="auth-button">Entrar</button>
                
                <p class="auth-text">Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
                <p class="auth-text"><a href="#">Esqueci minha senha</a></p>
            </form>
        </div>
    </div>
</body>
</html>