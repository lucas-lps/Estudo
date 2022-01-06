<?php
    require_once("c_reptil.php");

    class Tartaruga extends Reptil {
        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m, $c);
        }

        public function locomover() {
            echo "Andando beeeeem devagar...<br>";
        }
    }
?>