<?php
    require_once("c_animal.php");

    class Ave extends Animal {
        private $corPena;

        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m);
            $this->setCorPena($c);
        }

        public function locomover() {
            echo "Voando...<br>";
        }

        public function alimentar() {
            echo "Comendo frutas...<br>";
        }
        
        public function emitirSom() {
            echo "Som de ave...<br>";
        }

        public function fazerNinho() {
            echo "Construiu um ninho...<br>";
        }

        // MÉTODOS ESPECIAIS
        public function setCorPena($c) {
            $this->corPena = $c;
        }
        public function getCorPena() {
            return $this->corPena;
        }
    }
?>