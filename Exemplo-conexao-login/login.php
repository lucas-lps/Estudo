<?php
    include("c_usuario.php");

    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    $usr = new Usuario;
    $usr->fazerLogin($usuario, $senha);
?>