<?php
    class Conta {
        public $numConta;
        protected $tipo;
        private $dono;
        private $saldo;
        private $status;

        public function __construct($n, $d) {
            $this->setNumConta($n);
            $this->setDono($d);
        }

        public function abrirConta($t) {
            if($this->getStatus() == true) {
                echo "A conta já está aberta<br>";
            } else if($t == "CC") {
                $this->setStatus(true);
                $this->setTipo($t);
                $this->setSaldo(50);
            } else if($t == "CP") {
                $this->setStatus(true);
                $this->setTipo($t);
                $this->setSaldo(150);
            } else {
                echo "Tipo de conta inválido!<br>";
            }
        }

        public function fecharConta() {
            if($this->getStatus() == false) {
                echo "A conta já está fechada<br>";
            } else if($this->getSaldo() > 0) {
                echo "Saque todo o dinheiro antes de fechar a conta<br>";
            } else if($this->getSaldo() < 0) {
                echo "Impossível fechar conta com saldo devedor<br>";
            } else {
                $this->setStatus(false);
            }
        }

        public function depositar($v) {
            if($this->getStatus() == true) {
                $this->setSaldo($this->getSaldo() + $v);
            } else {
                echo "Impossível depositar em uma conta fechada<br>";
            }
        }

        public function sacar($v) {
            if($this->getStatus() == false) {
                echo "Impossível sacar de uma conta fechada<br>";
            } else if($this->getSaldo() - $v < 0) {
                echo "Saldo insuficiente para saque<br>";
            } else {
                $this->setSaldo($this->getSaldo() - $v);
            }
        }

        public function pagarMensal() {
            if($this->getTipo() == "CC") {
                $this->setSaldo($this->getSaldo() - 12);
            } else {
                $this->setSaldo($this->getSaldo() - 20);
            }
            
        }

        public function setNumConta($n) {
            $this->numConta = $n;
        }

        public function getNumConta() {
            return $this->numConta;
        }

        public function setTipo($t) {
            $this->tipo = $t;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setDono($d) {
            $this->dono = $d;
        }

        public function getDono() {
            return $this->dono;
        }

        public function setSaldo($s) {
            $this->saldo = $s;
        }

        public function getSaldo() {
            return $this->saldo;
        }

        public function setStatus($s) {
            $this->status = $s;
        }

        public function getStatus() {
            return $this->status;
        }
    }
?>