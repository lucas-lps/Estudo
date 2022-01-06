<?php
    require_once("../classes/c_jogo.php");

    session_start();

    $idJogo    = $_GET['idJogo'];
    $idUsuario = $_COOKIE['idUsuario'];

    $jogo = new Jogo();
    $jogo->adicionarDesejo($idJogo, $idUsuario);
?>