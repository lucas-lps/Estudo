<?php
    abstract class Animal {
        protected $peso;
        protected $idade;
        protected $membros;

        public function __construct($p, $i, $m) {
            $this->setPeso($p);
            $this->setIdade($i);
            $this->setMembros($m);
        }

        public abstract function locomover();
        public abstract function alimentar();
        public abstract function emitirSom();

        // MÉTODOS ESPECIAIS
        protected function setPeso($p) {
            $this->peso = $p;
        }
        protected function getPeso() {
            return $this->peso;
        }
        protected function setIdade($i) {
            $this->idade = $i;
        }
        protected function getIdade() {
            return $this->idade;
        }
        protected function setMembros($m) {
            $this->membros = $m;
        }
        protected function getMembros() {
            return $this->membros;
        }
    }
?>