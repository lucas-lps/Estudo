<?php
    require_once("../classes/c_usuario.php");

    $idUsuario = $_GET['idUsuario'];

    $usr = new Usuario();
    $usr->excluirAdmin($idUsuario);
?>