<?php
    require_once("c_animal.php");

    class Mamifero extends Animal {
        protected $corPelo;

        public function emitirSom() {
            echo "Som de mamífero...<br>";
        }
    }
?>