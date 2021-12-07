<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 02 - POO</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_caneta.php");
        $c1 = new Caneta;

        $c1->modelo = "BIC";
        $c1->cor = "Vermelho";
        //$c1->ponta = 0.5; Não pode modificar um atributo privado
        //$c1->carga = 50; Não pode modificar um atributo protegido
        //$c1->tampada = true; Não pode modificar um atributo protegido
        $c1->destampar();
        print_r($c1);
        $c1->rabiscar();
    ?>
    </pre>
</body>
</html>