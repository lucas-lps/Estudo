<?php
    require_once("c_mamifero.php");

    class Canguru extends Mamifero {
        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m, $c);
        }

        public function locomover() {
            echo "Saltando...<br>";
        }

        public function usarBolsa() {
            echo "Usando bolsa...<br>";
        }
    }
?>