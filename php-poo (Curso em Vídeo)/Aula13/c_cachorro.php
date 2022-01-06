<?php
    require_once("c_lobo.php");

    class Cachorro extends Lobo {
        public function emitirSom() {
            echo "Au! Au! Au!...<br>";
        }

        public function reagirFrase($frase) {
            if($frase == "Toma comida" || $frase == "Olá") {
                echo "Abanar e latir!<br>";
            } else {
                echo "Rosnar!<br>";
            }
        }
        public function reagirHora($hora, $min) {
            if($hora < 12) {
                echo "Abanar!<br>";
            } else if($hora >= 18) {
                echo "Ignorar<br>";
            } else {
                echo "Abanar e latir!<br>";
            }
        }
        public function reagirDono($dono) {
            if($dono == true) {
                echo "Abanar!<br>";
            } else {
                echo "Rosnar e latir!<br>";
            }
        }
        public function reagirIdadePeso($idade, $peso) {
            if($idade < 5) {
                if($peso < 10) {
                    echo "Abanar!<br>";
                } else {
                    echo "Latir!<br>";
                }
            } else {
                if($peso < 10) {
                    echo "Rosnar!<br>";
                } else {
                    echo "Ignorar<br>";
                }
            }
        }
    }
?>