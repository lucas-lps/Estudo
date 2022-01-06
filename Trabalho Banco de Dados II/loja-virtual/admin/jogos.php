<?php
    require_once("../classes/c_jogo.php");

    session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 1) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login       = $_COOKIE['login'];
    $senha       = $_COOKIE['senha'];
    $idTipoConta = $_COOKIE['idTipoConta'];
    $idUsuario   = $_COOKIE['idUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Jogos</title>
</head>
<body>
    <ul class="menu">
        <li><a href="home.php">Início</a></li>
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
    <h1>Lista de jogos</h1>
	<a id="" href="cadastrarJogo.php">Cadastrar novo jogo</a>
    <table class="tg" style="undefined;table-layout: fixed; width: 100%">
        <colgroup>
            <col style="width: 25%">
            <col style="width: 25%">
            <col style="width: 20%">
            <col style="width: 10%">
            <col style="width: 10%">
            <col style="width: 5%">
            <col style="width: 5%">
        </colgroup>
    	<tr>
			<th class="table-top" id="text-center">Nome</th>
			<th class="table-top" id="text-center">Gênero</th>
			<th class="table-top" id="text-center">Plataforma</th>
            <th class="table-top" id="text-center">Preço</th>
            <th class="table-top" id="text-center">Data lanç.</th>
	        <th class="table-top"></th>
	        <th class="table-top"></th>
	    </tr>
    </table>
    <?php
    	$jogo = new Jogo(); 
		$jogo->listarJogos($idTipoConta);
	?>
</body>
</html>