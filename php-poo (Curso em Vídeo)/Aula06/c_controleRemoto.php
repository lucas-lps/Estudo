<?php
    require_once("i_controlador.php");
    class ControleRemoto implements Controlador {
        private $volume;
        private $ligado;
        private $tocando;

        public function __construct() {
            $this->setVolume(50);
            $this->setLigado(false);
            $this->setTocando(false);
        }

        public function ligar() {
            $this->setLigado(true);
        }

        public function desligar() {
            $this->setLigado(false);
        }

        public function abrirMenu() {
            echo ($this->getLigado() ? "LIGADO" : "DESLIGADO") . "<br>";
            echo "VOLUME: " . $this->getVolume() . " ";
            for($i = 0; $i <= $this->getVolume(); $i++) {
                echo "|";
            }
            echo "<br>" . ($this->getTocando() ? "PLAY" : "PAUSE");
        }

        public function fecharMenu() {
            echo "<br>Fechando menu...";
        }

        public function maisVolume() {
            if($this->getLigado() && $this->getVolume() < 100) {
                $this->setVolume($this->getVolume() + 5);
            }
        }

        public function menosVolume() {
            if($this->getLigado() && $this->getVolume() > 0) {
                $this->setVolume($this->getVolume() - 5);
            }
        }

        public function ligarMudo() {
            if($this->getLigado() && $this->getVolume() > 0) {
                $this->setVolume(0);
            }
        }

        public function desligarMudo() {
            if($this->getLigado() && $this->getVolume == 0) {
                $this->setVolume(50);
            }
        }

        public function play() {
            if($this->getLigado() && !($this->getTocando())) {
                $this->setTocando(true);
            }
        }

        public function pause() {
            if($this->getLigado() && $this->getTocando()) {
                $this->setTocando(false);
            }
        }

        private function setVolume($volume) {
            $this->volume = $volume;
        }

        private function getVolume() {
            return $this->volume;
        }

        private function setLigado($ligado) {
            $this->ligado = $ligado;
        }

        private function getLigado() {
            return $this->ligado;
        }

        private function setTocando($tocando) {
            $this->tocando = $tocando;
        }

        private function getTocando() {
            return $this->tocando;
        }
    }
?>