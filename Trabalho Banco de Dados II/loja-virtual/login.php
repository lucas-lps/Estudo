<?php
    require_once("classes/c_usuario.php");

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $usr = new Usuario();
    $usr->logar($login, $senha);
?>