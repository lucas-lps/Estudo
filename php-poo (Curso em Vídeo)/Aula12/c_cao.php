<?php
    require_once("c_mamifero.php");

    class Cao extends Mamifero {
        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m, $c);
        }

        public function emitirSom() {
            echo "Au au...<br>";
        }
        public function enterrarOsso() {
            echo "Enterrando osso...<br>";
        }

        public function abanarRabo() {
            echo "Abanando o rabo...<br>";
        }
    }
?>