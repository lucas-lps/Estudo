<?php
    require_once("c_video.php");
    require_once("c_usuario.php");

    class Visualizacao {
        private $espectador;
        private $filme;

        public function __construct($e, $f) {
            $this->setEspectador($e);
            $this->setFilme($f);
            $this->filme->setViews($this->filme->getViews() + 1);
            $this->espectador->setTotAssistido($this->espectador->getTotAssistido() + 1);
        }

        public function avaliar() {
            $this->filme->setAvaliacao(5);
        }
        public function avaliarNota($n) {
            $this->filme->setAvaliacao($n);
        }
        public function avaliarPorc($p) {
            if($p <=  20) {
                $this->filme->setAvaliacao(3);
            } else if($p <= 50) {
                $this->filme->setAvaliacao(5);
            } else if($p <= 90) {
                $this->filme->setAvaliacao(8);
            } else {
                $this->filme->setAvaliacao(10);
            }
        }

        // MÉTODOS ESPECIAIS
        public function setEspectador($e) {
            $this->espectador = $e;
        }
        public function getEspectador() {
            return $this->espectador;
        }
        public function setFilme($f) {
            $this->filme = $f;
        }
        public function getFilme() {
            return $this->filme;
        }
    }
?>