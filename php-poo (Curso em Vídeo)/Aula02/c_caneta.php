<?php
    class Caneta {
        var $cor;
        var $ponta;
        var $carga;
        var $tampada;

        function rabiscar() {
            if($this->tampada == true) {
                echo "Estou tampada, não posso rabiscar!";
            } else {
                echo "Estou rabiscando...";
            }  
        }

        function tampar() {
            $this->tampada = true;
        }

        function destampar() {
            $this->tampada = false;
        }

        function toString() {
            echo "Cor: " . $this->cor . " | Ponta: " . $this->ponta . " | Carga: " . $this->carga;
        }
    }
?>