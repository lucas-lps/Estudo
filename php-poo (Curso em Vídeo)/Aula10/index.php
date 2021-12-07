<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 10</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_aluno.php");
        require_once("c_professor.php");
        require_once("c_funcionario.php");

        $p1 = new Aluno();
        $p1->setNome("Maria");
        $p1->setIdade(17);
        $p1->setSexo("F");
        $p1->setMatricula(4848);
        $p1->setCurso("Design");
        $p1->fazerAniversario();
        print_r($p1);

        $p2 = new Professor();
        $p2->setNome("Lucas");
        $p2->setIdade(25);
        $p2->setSexo("M");
        $p2->setEspecialidade("Linguagem PHP");
        $p2->setSalario(4000);
        $p2->receberAumento(500);
        print_r($p2);

        $p3 = new Funcionario();
        $p3->setNome("Vitória");
        $p3->setIdade(34);
        $p3->setSexo("F");
        $p3->setSetor("Diretora");
        $p3->setTrabalhando(false);
        $p3->mudarTrabalho();
        print_r($p3);
    ?>
    </pre>
</body>
</html>