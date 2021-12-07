<?php
    require_once("c_pessoa.php");

    class Professor extends Pessoa {
        private $especialidade;
        private $salario;

        public function receberAumento($v) {
            $this->setSalario($this->getSalario() + $v);
        }

        // MÉTODOS ESPECIAIS
        public function setEspecialidade($e) {
            $this->especialidade = $e;
        }
        public function getEspecialidade() {
            return $this->especialidade;
        }
        public function setSalario($s) {
            $this->salario = $s;
        }
        public function getSalario() {
            return $this->salario;
        }
    }
?>