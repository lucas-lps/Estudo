<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 13</title>
</head>
<body>
    <?php
        require_once("c_mamifero.php");
        require_once("c_lobo.php");
        require_once("c_cachorro.php");

        $c = new Cachorro();
        $c->emitirSom();
        $c->reagirFrase("Olá");
        $c->reagirFrase("Vai apanhar");
        $c->reagirHora(11, 45);
        $c->reagirHora(21, 0);
        $c->reagirDono(true);
        $c->reagirDono(false);
        $c->reagirIdadePeso(2, 12.5);
        $c->reagirIdadePeso(17, 4.5);
    ?>
</body>
</html>