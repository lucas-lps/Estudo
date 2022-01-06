<?php
    require_once("c_animal.php");

    class Reptil extends Animal {
        private $corEscama;

        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m);
            $this->setCorEscama($c);
        }

        public function locomover() {
            echo "Rastejando...<br>";
        }

        public function alimentar() {
            echo "Comendo vegetais...<br>";
        }
        
        public function emitirSom() {
            echo "Som de réptil...<br>";
        }

        // MÉTODOS ESPECIAIS
        public function setCorEscama($c) {
            $this->corEscama = $c;
        }
        public function getCorEscama() {
            return $this->corEscama;
        }
    }
?>