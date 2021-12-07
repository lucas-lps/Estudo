<?php
    require_once("c_pessoa.php");

    class Funcionario extends Pessoa {
        private $setor;
        private $trabalhando;

        public function mudarTrabalho() {
            if($this->getTrabalhando()) {
                $this->setTrabalhando(false);
            } else {
                $this->setTrabalhando(true);
            }
        }

        // MÉTODOS ESPECIAIS
        public function setSetor($s) {
            $this->setor = $s;
        }
        public function getSetor() {
            return $this->setor;
        }
        public function setTrabalhando($t) {
            $this->trabalhando = $t;
        }
        public function getTrabalhando() {
            return $this->trabalhando;
        }
    }
?>