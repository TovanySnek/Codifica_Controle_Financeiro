<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="/criar-conta" method="POST">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>

        <label for="senha2">Confirmar Senha</label>
        <input type="password" name="senha2" id="senha2" required>

        <?php if(isset($_SESSION['cadastroError'])) : ?>
            <p style="color: red"><?= $_SESSION['cadastroError'] ?></p>
        <?php endif; ?>

        <button type="submit">Cadastrar</button><br><br>

        <a href="/login">Já tem uma conta? Faça login</a>

    </form>
</body>
</html>