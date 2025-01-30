<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">    
</head>
<body>
    <img src="logo.png" alt="">
    <form action="/validar-login" method="POST">
        
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>

        <?php if(isset($_SESSION['loginError'])) : ?>
            <p class="error-message"><?= $_SESSION['loginError'] ?></p>
        <?php endif; ?>

        <button type="submit">Login</button><br><br>

        <a href="/cadastro">Crie sua conta</a>
    </form>
</body>
</html>