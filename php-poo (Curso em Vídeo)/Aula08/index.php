<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 08</title>
</head>
<body>
    <pre>
        <?php
            require_once("c_lutador.php");
            require_once("c_luta.php");

            $l = array();
            $l[0] = new Lutador("Pretty Boy", "França", 31, 1.75, 68.9, 11, 2, 1);
            $l[1] = new Lutador("Putscript", "Brasil", 29, 1.68, 57.8, 14, 2, 3);
            $l[2] = new Lutador("SnapShadow", "EUA", 35, 1.65, 80.9, 12, 2, 1);
            $l[3] = new Lutador("Dead Code", "Austrália", 28, 1.93, 81.6, 13, 0, 2);
            $l[4] = new Lutador("UFOCobol", "Brasil", 37, 1.70, 119.3, 5, 4, 3);
            $l[5] = new Lutador("Nerdaart", "EUA", 30, 1.81, 105.7, 12, 2, 4);

            // for($i = 0; $i <= 5; $i++) {
            //     $l[$i]->status();
            // }

            echo "<br>";

            $UEC01 = new Luta();
            $UEC01->marcarLuta($l[0], $l[5]);
            $UEC01->lutar();
            $l[0]->status();
        ?>
    </pre>
</body>
</html>