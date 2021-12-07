<?php
    require_once("i_publicacao.php");
    
    class Livro implements Publicacao {
        private $titulo;
        private $autor;
        private $totPaginas;
        private $pagAtual;
        private $aberto;
        private $leitor;

        public function __construct($t, $a, $tp, $l) {
            $this->setTitulo($t);
            $this->setAutor($a);
            $this->setTotPaginas($tp);
            $this->setPagAtual(0);
            $this->setAberto(false);
            $this->setLeitor($l);
        }

        public function detalhes() {
            echo "========== " . $this->getTitulo() . " ==========<br>";
            echo "<p>Autor: " . $this->getAutor() . "<br>";
            echo "Total de paginas: " . $this->getTotPaginas() . "<br>";
            echo "Página atual: " . $this->getPagAtual() . "<br>";
            echo "Estado: " . ($this->getAberto() ? "Aberto" : "Fechado") . "<br>";
            echo "Leitor: " . $this->leitor->getNome() . "</p>";
        }

        public function abrir() {
            if($this->getAberto() == false) {
                $this->setAberto(true);
                $this->setPagAtual(1);
            }
        }
        public function fechar() {
            if($this->getAberto() == true) {
                $this->setAberto(false);
                $this->setPagAtual(null);
            }
        }
        public function folhear() {
            if($this->getAberto() == true) {
                $this->setPagAtual(rand(1,$this->getTotPaginas()));
            }
        }
        public function avancarPag() {
            if($this->getAberto() == true) {
                $this->setPagAtual($this->getPagAtual() + 1);
            }
        }
        public function voltarPag() {
            if($this->getAberto() == true) {
                $this->setPagAtual($this->getPagAtual() - 1);
            }
        }

        // MÉTODOS ESPECIAIS
        private function setTitulo($t) {
            $this->titulo = $t;
        }
        private function getTitulo() {
            return $this->titulo;
        }
        private function setAutor($a) {
            $this->autor = $a;
        }
        private function getAutor() {
            return $this->autor;
        }
        private function setTotPaginas($tp) {
            $this->totPaginas = $tp;
        }
        private function getTotPaginas() {
            return $this->totPaginas;
        }
        private function setPagAtual($pa) {
            $this->pagAtual = $pa;
        }
        private function getPagAtual() {
            return $this->pagAtual;
        }
        private function setAberto($ab) {
            $this->aberto = $ab;
        }
        private function getAberto() {
            return $this->aberto;
        }
        private function setLeitor($l) {
            $this->leitor = $l;
        }
        private function getLeitor() {
            return $this->leitor;
        }
    }
?>