<?php
    require_once("c_pessoa.php");

    class Aluno extends Pessoa {
        private $matricula;
        private $curso;

        public function pagarMensalidade() {
            echo "Mensalidade de R$500,00 paga!<br>";
        }

        // MÉTODOS ESPECIAIS
        public function setMatricula($m) {
            $this->matricula = $m;
        }
        public function getMatricula() {
            return $this->matricula;
        }
        public function setCurso($c) {
            $this->curso = $c;
        }
        public function getCurso() {
            return $this->curso;
        }
    }
?>