<?php
    echo '<meta charset="UTF-8">';

    require_once("../classes/c_usuario.php");

	session_start();

    if (!isset($_COOKIE['login']) || !isset($_COOKIE['senha'])) {
		header("Location: ../index.php"); exit;
	}

	if ($_COOKIE['idTipoConta'] <> 1) {
		echo "<script language='javascript' type='text/javascript'>alert('Acesso negado!');window.location.href=\"javascript:history.go(-1)\";</script>"; die(); exit;
	}

	$login = $_COOKIE['login'];
    $senha = $_COOKIE['senha'];

    if(isset($_POST['p_login'])) {
        $conexao = new Conexao();

        $p_login = $_POST['p_login'];

        $select = oci_parse($conexao->conectar(), "BEGIN :dias := retornaTempoConta(:p_login); END;");

        OCIBindByName($select, ":p_login", $p_login);
		OCIBindByName($select, ":dias", $dias, 100);

        oci_execute($select);

        if($dias != NULL) {
			echo "<script language='javascript' type='text/javascript'>alert('A conta referente ao login $p_login foi criada há $dias dias.');window.location.href='info.php';</script>"; die();
		} else {
			echo "<script language='javascript' type='text/javascript'>alert('Usuário não encontrado!');window.location.href='info.php';</script>"; die();
		}
    } else if(isset($_POST['p_idUsuario'])) {
        $conexao = new Conexao();

        $p_idUsuario = $_POST['p_idUsuario'];

        $select = oci_parse($conexao->conectar(), "BEGIN :tipoConta := retornaTipoConta(:p_idUsuario); END;");

        OCIBindByName($select, ":p_idUsuario", $p_idUsuario);
		OCIBindByName($select, ":tipoConta", $tipoConta, 100);

        oci_execute($select);

        if($tipoConta != NULL) {
			echo "<script language='javascript' type='text/javascript'>alert('A conta referente ao ID $p_idUsuario é do tipo $tipoConta.');window.location.href='info.php';</script>"; die();
		} else {
			echo "<script language='javascript' type='text/javascript'>alert('Usuário não encontrado!');window.location.href='info.php';</script>"; die();
		}
    } else if(isset($_POST['p_nomeJogo'])) {
        $conexao = new Conexao();

        $p_nomeJogo = $_POST['p_nomeJogo'];

        $select = oci_parse($conexao->conectar(), "BEGIN :usuarios := retornaUsuarioJogos(:p_nomeJogo); END;");

        OCIBindByName($select, ":p_nomeJogo", $p_nomeJogo);
		OCIBindByName($select, ":usuarios", $usuarios, 100);

        oci_execute($select);

        if($usuarios != NULL) {
            if($usuarios == 0) {  
			    echo "<script language='javascript' type='text/javascript'>alert('Nenhum usuário possui o jogo $p_nomeJogo.');window.location.href='info.php';</script>"; die();
            } else if($usuarios == 1) {
                echo "<script language='javascript' type='text/javascript'>alert('$usuarios usuário possui o jogo $p_nomeJogo.');window.location.href='info.php';</script>"; die();
            } else {
                echo "<script language='javascript' type='text/javascript'>alert('$usuarios usuários possuem o jogo $p_nomeJogo.');window.location.href='info.php';</script>"; die();
            }
		} else {
			echo "<script language='javascript' type='text/javascript'>alert('Jogo não encontrado!');window.location.href='info.php';</script>"; die();
		}
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Informações</title>
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
    <h1>Informações</h1>
    <form action="<?php $PHP_SELF ?>" method="POST">
        <label for="">Tempo de conta</label><br>
        <input type="text" name="p_login" placeholder="Login do usuário">
        <input type="submit" value="Enviar">
    </form><br>
    <form action="<?php $PHP_SELF ?>" method="POST">
        <label for="">Tipo de conta</label><br>
        <input type="text" name="p_idUsuario" placeholder="ID do usuário">
        <input type="submit" value="Enviar">
    </form><br>
    <form action="<?php $PHP_SELF ?>" method="POST">
        <label for="">Total de usuários p/ jogo</label><br>
        <input type="text" name="p_nomeJogo" placeholder="Nome do jogo">
        <input type="submit" value="Enviar">
    </form><br>
</body>
</html>