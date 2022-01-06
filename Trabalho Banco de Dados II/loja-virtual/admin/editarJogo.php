<?php
    require_once("../classes/c_jogo.php");
    date_default_timezone_set('America/Sao_Paulo');

    $idJogo         = $_GET['idJogo'];
    $nomeJogo       = $_POST['nomeJogo'];
    $genero         = $_POST['genero'];
    $plataforma     = $_POST['plataforma'];
    $preco          = $_POST['preco'];
    $dataLancamento = $_POST['dataLancamento'];
    $dataLancamento = date('d-M-Y',  strtotime($dataLancamento));

    $jogo = new Jogo();
    $jogo->editarJogo($idJogo, $nomeJogo, $genero, $plataforma, $preco, $dataLancamento);
?>