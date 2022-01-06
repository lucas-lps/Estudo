<?php
    require_once("../classes/c_usuario.php");
    require_once("../classes/c_view.php");

	session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 1) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login     = $_COOKIE['login'];
    $senha     = $_COOKIE['senha'];
    $idUsuario = $_COOKIE['idUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastrar administrador</title>
</head>
<body>
    <ul class="menu">
        <li><a href="home.php">Início</a></li>
        <li><a href="jogos.php">Jogos</a></li>
        <li><a href="">Administradores</a></li>
        <li><a href="info.php">Informações</a></li>
        <li><a href="">Olá, <?php echo $login ?></a>
            <ul class="submenu">
                <li><a href="perfil.php">Perfil</a></li>
                <li><?php echo '<a href="../doLogout.php?token='.md5(session_id()).'">Sair</a>';?></li>
            </ul>
        </li>
    </ul>
    <h1>Cadastrar administrador</h1>
    <form action='<?php echo "salvarCadastro.php?id=2" ?>' method="POST">
        <label for="">Nome</label><br>
        <input type="text" name="nomeUsuario" placeholder="Nome completo"><br>
        <label for="">Data nasc.</label><br>
        <input type="date" name="dataNascimento" placeholder="Nome completo"><br>
        <label for="">CPF</label><br>
        <input type="text" name="cpf" placeholder="123.XXX.XXX-XX"><br>
        <label for="">Email</label><br>
        <input type="email" name="email" placeholder="joao.silva@exemplo.com"><br>
        <label for="">Telefone</label><br>
        <input type="text" name="telefone" placeholder="(DDD) 123XX-XXXX"><br>
        <label for="">Endereço</label><br>
        <input type="text" name="endereco" placeholder="Rua A"><br>
        <label for="">Número</label><br>
        <input type="text" name="numero" placeholder="123"><br>
        <label for="">Bairro</label><br>
        <input type="text" name="bairro" placeholder="Bairro"><br>
        <label for="">Cidade</label><br>
        <input type="text" name="cidade" placeholder="Cidade"><br>
        <label for="">Estado</label><br>
        <?php
            $estado = new View();
            $estado->selectEstado();
        ?><br>
        <label for="">Login</label><br>
        <input type="text" name="login" placeholder="Min. 8 dígitos"><br>
        <label for="">Senha</label><br>
        <input type="password" name="senha" placeholder="Crie sua senha"><br>
        <label for="">Confirme a senha</label><br>
        <input type="password" name="senha2" placeholder="Confirme a senha"><br>
        <input type="submit" value="Cadastrar">
    </form><br>
</body>
</html>