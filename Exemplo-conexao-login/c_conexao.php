<?php
    class Conexao {
        public function conectar() {
            $connect = mysqli_connect('localhost', 'root', '', 'testeCadastro');
            return $connect;
        }
    }
?>