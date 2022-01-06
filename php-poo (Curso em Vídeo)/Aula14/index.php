<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - 14</title>
</head>
<body>
    <pre>
    <?php
        require_once("c_video.php");
        require_once("c_usuario.php");
        require_once("c_visualizacao.php");

        $v[0] = new Video("Curso em Vídeo - PHP POO - Aula 14");
        $v[1] = new Video("Curso em Vídeo - HTML5 - Aula 01");
        $v[2] = new Video("Curso em Vídeo - Javascript - Aula 10");

        $u[0] = new Usuario("Lucas", 25, "M", "lucas-lopes");
        $u[1] = new Usuario("Maria", 17, "F", "maria-vitoria");

        $vis[0] = new Visualizacao($u[0], $v[0]);
        $vis[0]->avaliar();
        print_r($vis[0]);
        $vis[1] = new Visualizacao($u[1], $v[0]);
        $vis[0]->avaliarNota(10);
        print_r($vis[1]);

        $vis[2] = new Visualizacao($u[0], $v[1]);
        $vis[3] = new Visualizacao($u[1], $v[2]);
        $vis[2]->avaliarPorc(90);
        $vis[3]->avaliarPorc(90);
        print_r($vis[2]);
        print_r($vis[3]);
        
    ?>
    </pre>
</body>
</html>