<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 02 - POO</title>
</head>
<body>
    <?php
        require_once("c_caneta.php");
        $c1 = new Caneta;

        $c1->cor = "Vermelho";
        $c1->ponta = 0.5;
        $c1->carga = 80;
        $c1->tampada = false;

        //Mostra informações de um objeto na tela
        //var_dump($c1);
        //print_r($c1);

        $c1->destampar();
        $c1->rabiscar();
        //$c1->toString();
    ?>
</body>
</html>