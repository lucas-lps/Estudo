<?php
    require_once("../classes/c_conta.php");

	session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 2) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login     = $_COOKIE['login'];
    $idUsuario = $_COOKIE['idUsuario'];

    $conta = new Conta();
    $conta->carregarSaldo($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Carteira</title>
</head>
<body>
    <ul class="menu">
        <li><a href="home.php">Loja</a></li>
        <li><a href="biblioteca.php">Biblioteca</a></li>
        <li><a href="listaDesejos.php">Lista de desejos</a></li>
        <li><a href="">Seu saldo: R$ <?php echo $conta->getCarteira() ?></a>
            <ul class="submenu">
                <li><a href="carteira.php">Adicionar fundos</a></li>
            </ul>
        </li>
        <li><a href="">Olá, <?php echo $login ?></a>
            <ul class="submenu">
                <li><a href="perfil.php">Perfil</a></li>
                <li><?php echo '<a href="../doLogout.php?token='.md5(session_id()).'">Sair</a>';?></li>
            </ul>
        </li>
    </ul>
    <h1>Minha carteira</h1>
    <form action='<?php echo "adicionarFundos.php?idUsuario=$idUsuario" ?>' method="POST">
        <label for="">Saldo atual</label><br>
        <input type="text" name="saldo" value="<?php echo $conta->getCarteira() ?>" readonly><br>
        <label for="">Adicionar fundos</label><br>
        <input type="text" name="valor" placeholder="Insira um valor"><br>
        <input type="submit" value="Pagar">
    </form>
</body>
</html>