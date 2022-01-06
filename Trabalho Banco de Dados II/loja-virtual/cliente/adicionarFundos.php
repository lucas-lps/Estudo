<?php
    require_once("../classes/c_conta.php");
    date_default_timezone_set('America/Sao_Paulo');

    $idUsuario = $_GET['idUsuario'];
    $saldo     = $_POST['saldo'];
    $valor     = $_POST['valor'];
    $carteira  = $saldo + $valor;

    $conta = new Conta();
    $conta->adicionarFundos($idUsuario, $carteira);
?>