<?php
    require_once("../classes/c_usuario.php");
    require_once("../classes/c_view.php");
    require_once("../classes/c_conta.php");

    session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 2) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login     = $_COOKIE['login'];
    $senha     = $_COOKIE['senha'];
    $idUsuario = $_COOKIE['idUsuario'];

    $usr = new Usuario();
    $usr->carregarDados($idUsuario);

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
    <title>Meu perfil</title>
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
    <h1>Meu perfil</h1>
    <form action='<?php echo "editarCadastro.php?idUsuario=$idUsuario&id=1" ?>' method="POST">
        <label for="">Nome</label><br>
        <input type="text" name="nomeUsuario" value="<?php echo $usr->getNomeUsuario() ?>"><br>
        <label for="">Data nasc.</label><br>
        <input type="date" name="dataNascimento" value='<?php echo $usr->getDataNascimento() ?>'><br>
        <label for="">CPF</label><br>
        <input type="text" name="cpf" value="<?php echo $usr->getCpf() ?>" readonly><br>
        <label for="">Email</label><br>
        <input type="email" name="email" value="<?php echo $usr->getEmail() ?>"><br>
        <label for="">Telefone</label><br>
        <input type="text" name="telefone" value="<?php echo $usr->getTelefone() ?>"><br>
        <label for="">Endereço</label><br>
        <input type="text" name="endereco" value="<?php echo $usr->getEndereco() ?>"><br>
        <label for="">Número</label><br>
        <input type="text" name="numero" value="<?php echo $usr->getNumero() ?>"><br>
        <label for="">Bairro</label><br>
        <input type="text" name="bairro" value="<?php echo $usr->getBairro() ?>"><br>
        <label for="">Cidade</label><br>
        <input type="text" name="cidade" value="<?php echo $usr->getCidade() ?>"><br>
        <label for="">Estado</label><br>
        <?php
            $estado = new View();
            $estado->selectEditarEstado($usr->getIdEstado(), $usr->getSigla());
        ?><br>
        <label for="">Login</label><br>
        <input type="text" name="login" value="<?php echo $usr->getLogin() ?>"><br>
        <label for="">Senha</label><br>
        <input type="password" name="senha" value="<?php echo $usr->getSenha() ?>"><br>
        <label for="">Confirme a senha</label><br>
        <input type="password" name="senha2" value="<?php echo $usr->getSenha() ?>"><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>