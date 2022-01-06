<?php
    require_once("../classes/c_jogo.php");

    $idJogo    = $_GET['idJogo'];
    $idUsuario = $_GET['idUsuario'];

    $jogo = new Jogo();
    $jogo->excluirJogoDesejos($idJogo, $idUsuario);
?>