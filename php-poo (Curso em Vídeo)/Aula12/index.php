<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 12</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_mamifero.php");
        require_once("c_reptil.php");
        require_once("c_peixe.php");
        require_once("c_ave.php");
        require_once("c_canguru.php");
        require_once("c_cao.php");
        require_once("c_cobra.php");
        require_once("c_tartaruga.php");
        require_once("c_goldfish.php");
        require_once("c_arara.php");

        $m = new Mamifero(48, 7, 4, "Marrom");
        print_r($m);
        $m->locomover();
        $m->alimentar();
        $m->emitirSom();

        echo "<br>**************************************************<br>";

        $r = new Reptil(15, 8, 4, "Verde");
        print_r($r);
        $r->locomover();
        $r->alimentar();
        $r->emitirSom();

        echo "<br>**************************************************<br>";
        
        $p = new Peixe(1.5, 4, 2, "Azul");
        print_r($p);
        $p->locomover();
        $p->alimentar();
        $p->emitirSom();
        $p->soltarBolha();

        echo "<br>**************************************************<br>";
        
        $a = new Ave(0.7, 4, 4, "Amarelo");
        print_r($a);
        $a->locomover();
        $a->alimentar();
        $a->emitirSom();
        $a->fazerNinho();

        echo "<br>**************************************************<br>";
        
        $c = new Canguru(60, 10, 4, "Bege");
        print_r($c);
        $c->locomover();
        $c->alimentar();

        echo "<br>**************************************************<br>";
        
        $cao = new Cao(30, 5, 4, "Preto");
        print_r($cao);
        $cao->enterrarOsso();
        $cao->abanarRabo();
        $cao->alimentar();
        $cao->emitirSom();

        echo "<br>**************************************************<br>";
        
        $cobra = new Cobra(0.5, 2, 0, "Verde");
        print_r($cobra);
        $cobra->locomover();
        $cobra->alimentar();
        $cobra->emitirSom();

        echo "<br>**************************************************<br>";
        
        $t = new Tartaruga(5, 20, 4, "Verde-claro");
        print_r($t);
        $t->locomover();
        $t->alimentar();
        $t->emitirSom();

        echo "<br>**************************************************<br>";
        
        $g = new Goldfish(1, 1, 2, "Amarelo");
        print_r($g);
        $g->locomover();
        $g->alimentar();
        $g->emitirSom();

        echo "<br>**************************************************<br>";
        
        $arara = new Arara(1.5, 2, 4, "Vermelho");
        print_r($arara);
        $arara->locomover();
        $arara->alimentar();
        $arara->emitirSom();
    ?>
    </pre>
</body>
</html>