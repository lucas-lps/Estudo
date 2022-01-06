<?php
    require_once("c_animal.php");

    class Mamifero extends Animal {
        private $corPele;

        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m);
            $this->setCorPele($c);
        }

        public function locomover() {
            echo "Correndo...<br>";
        }

        public function alimentar() {
            echo "Mamando...<br>";
        }
        
        public function emitirSom() {
            echo "Som de mamífero...<br>";
        }

        // MÉTODOS ESPECIAIS
        public function setCorPele($c) {
            $this->corPele = $c;
        }
        public function getCorPele() {
            return $this->corPele;
        }
    }
?>