<?php
    abstract class Pessoa {
        protected $nome;
        protected $idade;
        protected $sexo;
        protected $experiencia;

        public function __construct($n, $i, $s) {
            $this->setNome($n);
            $this->setIdade($i);
            $this->setSexo($s);
            $this->setExperiencia(0);
        }

        protected abstract function ganharExp();

        public function setNome($n) {
            $this->nome = $n;
        }
        public function getNome() {
            return $this->nome;
        }
        public function setIdade($i) {
            $this->idade = $i;
        }
        public function getIdade() {
            return $this->idade;
        }
        public function setSexo($s) {
            $this->sexo = $s;
        }
        public function getSexo() {
            return $this->sexo;
        }
        public function setExperiencia($e) {
            $this->experiencia = $e;
        }
        public function getExperiencia() {
            return $this->experiencia;
        }
    }
?>