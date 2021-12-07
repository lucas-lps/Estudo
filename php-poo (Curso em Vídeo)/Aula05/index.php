<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 05</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_conta.php");

        $num = 99;

        $num += 1;
        echo " Criando conta corrente...<br>";
        $c1 = new Conta($num, "Lucas");
        $c1->abrirConta("CC");
        print_r($c1);
        echo "Depositando R$150...<br>";
        $c1->depositar(150);
        print_r($c1);
        echo "Descontando mensalidade...<br>";
        $c1->pagarMensal();
        print_r($c1);
        echo "Tentando fechar conta...<br>";
        $c1->fecharConta();
        print_r($c1);
        echo "Sacando R$188...<br>";
        $c1->sacar(188);
        print_r($c1);
        echo "Tentando fechar conta novamente...<br>";
        $c1->fecharConta();
        print_r($c1);

        echo "**************************************************<br>";

        $num += 1;
        echo "Criando conta poupança...<br>";
        $c2 = new Conta($num, "Maria");
        $c2->abrirConta("CP");
        print_r($c2);
        echo "Sacando R$140...<br>";
        $c2->sacar(140);
        print_r($c2);
        echo "Descontando mensalidade...<br>";
        $c2->pagarMensal();
        print_r($c2);
        echo "Tentando fechar conta...<br>";
        $c2->fecharConta();
        print_r($c2);
        echo "Depositando R$10...<br>";
        $c2->depositar(10);
        print_r($c2);
        echo "Tentando fechar conta novamente...<br>";
        $c2->fecharConta();
        print_r($c2);
    ?>
    </pre>
</body>
</html>