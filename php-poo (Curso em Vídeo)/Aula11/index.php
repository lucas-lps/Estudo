<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 11</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_visitante.php");
        require_once("c_aluno.php");
        require_once("c_bolsista.php");

        $v1 = new Visitante();
        $v1->setNome("Caitlyn");
        $v1->setIdade(20);
        $v1->setSexo("F");
        print_r($v1);

        $a1 = new Aluno();
        $a1->setNome("Maria");
        $a1->setIdade(17);
        $a1->setSexo("F");
        $a1->setMatricula(4848);
        $a1->setCurso("Design");
        $a1->fazerAniversario();
        print_r($a1);
        $a1->pagarMensalidade();

        $b1 = new Bolsista();
        $b1->setNome("Violet");
        $b1->setIdade(22);
        $b1->setSexo("F");
        $b1->setMatricula(1234);
        $b1->setCurso("Moda");
        $b1->setBolsa(50);
        print_r($b1);
        $b1->pagarMensalidade();
        $b1->renovarBolsa();
    ?>
    </pre>
</body>
</html>