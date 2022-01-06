<?php
    class Conexao {
        public function conectar() {
            $connect = oci_pconnect("usr257", "Hakata48", "//200.132.53.144:1521/XEPDB1");
            return $connect;
        }
    }
?>