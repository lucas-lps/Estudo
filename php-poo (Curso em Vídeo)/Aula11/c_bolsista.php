<?php
    require_once("c_aluno.php");

    final class Bolsista extends Aluno {
        private $bolsa;
        
        public function renovarBolsa() {
            echo "Bolsa renovada<br>";
        }
        public function pagarMensalidade() {
            echo "Mensalidade de R$250,00 paga!<br>";
        }

        // MÉTODOS ESPECIAIS
        public function setBolsa($b) {
            $this->bolsa = $b;
        }
        public function getBolsa() {
            return $this->bolsa;
        }
    }
?>