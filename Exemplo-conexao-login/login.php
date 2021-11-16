<?php
    include("c_usuario");

    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    $usr = new Usuario;
    $usr->fazerLogin($usuario, $senha);
?>