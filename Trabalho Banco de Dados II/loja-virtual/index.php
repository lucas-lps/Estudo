<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="">Login</label>
        <input type="text" name="login" required>
        <label for="">Senha</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Entrar">
    </form>
    <a href="cadastro.php"><p>Crie seu cadastro</p></a>
</body>
</html>