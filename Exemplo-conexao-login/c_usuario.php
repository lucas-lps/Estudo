<?php
    include("c_conexao.php");

    public class Usuario {
        public function fazerLogin($usuario, $senha) {
            $conexao = new Conexao;
            $select = mysqli_query($conexao->conectar(), "SELECT * FROM funcionario WHERE usuario = '$usuario' AND senha = '$senha'");
            if(mysqli_num_rows($select) > 0) {

            } else {
                
            }
        }
    }
?>