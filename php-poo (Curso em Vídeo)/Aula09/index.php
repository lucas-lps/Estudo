<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 09</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_pessoa.php");
        require_once("c_livro.php");
        $p1 = new Pessoa("Lucas", 25, "M");
        $p1->fazerAniversario();
        print_r($p1);
        $l1 = new Livro("Livro A", "Machado de Assis", 200, $p1);
        $l1->detalhes();
        $l1->abrir();
        $l1->detalhes();

        $p2 = new Pessoa("Maria", 17, "F");
        $p2->fazerAniversario();
        print_r($p2);
        $l2 = new Livro("Livro B", "Érico Veríssimo", 250, $p2);
        $l2->detalhes();
        $l2->abrir();
        $l2->folhear();
        $l2->detalhes();
    ?>
    </pre>
</body>
</html>