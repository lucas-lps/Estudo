<?php
    require_once("../classes/c_jogo.php");

	session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 1) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login = $_COOKIE['login'];
    $senha = $_COOKIE['senha'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<title>Cadastrar jogo</title>
</head>
<body>
	<ul class="menu">
        <li><a href="home.php">Loja</a></li>
        <li><a href="jogos.php">Jogos</a></li>
        <li><a href="admin.php">Administradores</a></li>
        <li><a href="info.php">Informações</a></li>
        <li><a href="">Olá, <?php echo $login ?></a>
            <ul class="submenu">
                <li><a href="perfil.php">Perfil</a></li>
                <li><?php echo '<a href="../doLogout.php?token='.md5(session_id()).'">Sair</a>';?></li>
            </ul>
        </li>
    </ul>
    <h1>Cadastrar jogo</h1>
	<form action="salvarJogo.php" method="POST">
        <label for="">Nome</label><br>
        <input type="text" name="nomeJogo" placeholder="" required><br>
        <label for="">Gênero</label><br>
        <input type="text" name="genero" placeholder="" required><br>
        <label for="">Plataforma</label><br>
        <input type="text" name="plataforma" placeholder="" required><br>
        <label for="">Preço</label><br>
        <input type="text" name="preco" placeholder="" required><br>
        <label for="">Data de Lançamento</label><br>
        <input type="date" name="dataLancamento" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>