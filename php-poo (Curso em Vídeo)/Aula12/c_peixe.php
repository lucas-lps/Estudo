<?php
    require_once("c_animal.php");

    class Peixe extends Animal {
        private $corEscama;

        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m);
            $this->setCorEscama($c);
        }

        public function locomover() {
            echo "Nadando...<br>";
        }

        public function alimentar() {
            echo "Comendo substâncias...<br>";
        }
        
        public function emitirSom() {
            echo "Peixe não faz som...<br>";
        }

        public function soltarBolha() {
            echo "Soltou uma bolha...<br>";
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