<?php
    require_once("c_peixe.php");

    class Goldfish extends Peixe {
        public function __construct($p, $i, $m, $c) {
            parent::__construct($p, $i, $m, $c);
        }
    }
?>