<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 06</title>
</head>
<body>
    <?php
        require_once("c_controleRemoto.php");

        $c1 = new ControleRemoto();
        $c1->abrirMenu();
        $c1->ligar();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->play();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->maisVolume();
        $c1->maisVolume();
        $c1->maisVolume();
        $c1->maisVolume();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->menosVolume();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->desligar();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->pause();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->ligar();
        $c1->pause();
        echo "<br>*************************<br>";
        $c1->abrirMenu();
        $c1->fecharMenu();
    ?>
</body>
</html>