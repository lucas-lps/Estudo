<?php
    require_once("../classes/c_jogo.php");
    require_once("../classes/c_conta.php");

    $idJogo    = $_GET['idJogo'];
    $idUsuario = $_COOKIE['idUsuario'];

    $conta = new Conta();
    $conta->carregarSaldo($idUsuario);
    $carteira = $conta->getCarteira();

    $jogo = new Jogo();
    $jogo->comprarJogo($idJogo, $idUsuario, $carteira);
?>