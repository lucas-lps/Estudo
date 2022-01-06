<?php
    require_once("../classes/c_jogo.php");

    $idJogo = $_GET['idJogo'];

    $jogo = new Jogo();
    $jogo->excluirJogo($idJogo);
?>