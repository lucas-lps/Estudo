<?php
    class Luta {
        private $desafiado;
        private $desafiante;
        private $rounds;
        private $aprovada;

        public function marcarLuta($l1, $l2) {
            if($l1->getCategoria() === $l2->getCategoria() && ($l1 != $l2)) {
                $this->aprovada = true;
                $this->desafiado = $l1;
                $this->desafiante = $l2;
            } else {
                $this->aprovada = false;
                $this->desafiado = null;
                $this->desafiante = null;
                echo "A luta não pode acontecer.";
            }
        }

        public function lutar() {
            if($this->getAprovada()) {
                $this->desafiado->apresentar();
                $this->desafiante->apresentar();
                $vencedor = rand(0,2);
                switch($vencedor) {
                    case 0:
                        echo "<p>Empate!</p>";
                        $this->desafiado->empatarLuta();
                        $this->desafiante->empatarLuta();
                        break;
                    case 1:
                        echo "<p>" . $this->desafiado->getNome() . " venceu!";
                        $this->desafiado->ganharLuta();
                        $this->desafiante->perderLuta();
                        break;
                    case 2:
                        echo "<p>" . $this->desafiante->getNome() . " vencer!";
                        $this->desafiado->perderLuta();
                        $this->desafiante->ganharLuta();
                        break;
                }
            }
        }

        // MÉTODOS ESPECIAIS
        private function setDesafiado($desafiado) {
            $this->desafiado = $desafiado;
        }
        private function getDesafiado() {
            return $this->desafiado;
        }
        private function setDesafiante($desafiante) {
            $this->desafiante = $desafiante;
        }
        private function getDesafiante() {
            return $this->desafiante;
        }
        private function setRounds($rounds) {
            $this->rounds = $rounds;
        }
        private function getRounds() {
            return $this->rounds;
        }
        private function setAprovada($aprovada) {
            $this->aprovada = $aprovada;
        }
        private function getAprovada() {
            return $this->aprovada;
        }
    }
?>