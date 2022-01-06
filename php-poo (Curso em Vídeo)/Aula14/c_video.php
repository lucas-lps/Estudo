<?php
    require_once("i_interface.php");

    class Video implements AcoesVideo {
        private $titulo;
        private $avaliacao;
        private $views;
        private $curtidas;
        private $reproduzindo;

        public function __construct($t) {
            $this->setTitulo($t);
            $this->setAvaliacao(1);
            $this->setViews(0);
            $this->setCurtidas(0);
            $this->setReproduzindo(false);
        }

        // IMPLEMENTAÇÃO DOS MÉTODOS DA INTERFACE
        public function play() {
            if($this->getReproduzindo() == false) {
                $this->setReproduzindo(true);
                echo "Reproduzindo vídeo.<br>";
            }
        }
        public function pause() {
            if($this->getReproduzindo() == true) {
                $this->setReproduzindo(false);
                echo "Vídeo pausado.<br>";
            }
        }
        public function like() {
            $this->setCurtidas($this->getCurtidas() + 1);
        }

        // MÉTODOS ESPECIAIS
        public function setTitulo($t) {
            $this->titulo = $t;
        }
        public function getTitulo() {
            return $this->titulo;
        }
        public function setAvaliacao($a) {
            if($this->getViews() != 0) {
                $media = ($this->getAvaliacao() + $a) / $this->getViews();
                $this->avaliacao = $media;
            }
        }
        public function getAvaliacao() {
            return $this->avaliacao;
        }
        public function setViews($v) {
            $this->views = $v;
        }
        public function getViews() {
            return $this->views;
        }
        public function setCurtidas($c) {
            $this->curtidas = $c;
        }
        public function getCurtidas() {
            return $this->curtidas;
        }
        public function setReproduzindo($r) {
            $this->reproduzindo = $r;
        }
        public function getReproduzindo() {
            return $this->reproduzindo;
        }
    }
?>