<?php
    require_once("classes/c_usuario.php");
    date_default_timezone_set('America/Sao_Paulo');
    
    $nomeUsuario    = $_POST['nomeUsuario'];
    $dataNascimento = $_POST['dataNascimento'];
    $dataNascimento = date('d-M-Y',  strtotime($dataNascimento));
    $cpf            = $_POST['cpf'];
    $email          = $_POST['email'];
    $telefone       = $_POST['telefone'];
    $endereco       = $_POST['endereco'];
    $numero         = $_POST['numero'];
    $bairro         = $_POST['bairro'];
    $cidade         = $_POST['cidade'];
    $idEstado       = $_POST['idEstado'];
    $login          = $_POST['login'];
    $senha          = $_POST['senha'];
    $senha2         = $_POST['senha2'];
    $id             = $_GET['id'];
    
    $usr = new Usuario();
    $usr->cadastrarUsuario($nomeUsuario, $dataNascimento, $cpf, $email, $telefone, $endereco, $numero, $bairro, $cidade, $idEstado, $login, $senha, $senha2, $id);
?>