<?php
    require_once("c_pessoa.php");

    class Usuario extends Pessoa {
        private $login;
        private $totAssistido;

        public function __construct($n, $i, $s, $l) {
            parent::__construct($n, $i, $s);
            $this->setLogin($l);
            $this->setTotAssistido(0);
        }

        public function ganharExp() {
            $this->setExperiencia($this->getExperiencia() + rand(5,10));
        }

        public function viuMaisUm() {
            
        }

        //MÉTODOS ESPECIAIS
        public function setLogin($l) {
            $this->login = $l;
        }
        public function getLogin() {
            return $this->login;
        }
        public function setTotAssistido($t) {
            $this->totAssistido = $t;
        }
        public function getTotAssistido() {
            return $this->totAssistido;
        }
    }
?>