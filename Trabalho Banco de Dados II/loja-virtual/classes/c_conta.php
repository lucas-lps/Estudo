<?php
    require_once("c_conexao.php");

    class Conta {
        public function carregarSaldo($idUsuario) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "BEGIN :saldo := retornaSaldo(:p_idUsuario); END;");

            OCIBindByName($select, ":p_idUsuario", $idUsuario);
		    OCIBindByName($select, ":saldo", $saldo, 100);

            oci_execute($select);

            $this->setCarteira($saldo);
        }

        public function adicionarFundos($idUsuario, $carteira) {
            $conexao = new Conexao();

            $update = oci_parse($conexao->conectar(), "UPDATE conta SET carteira = $carteira WHERE idUsuario = $idUsuario");

            oci_execute($update);

            echo "<script language='javascript' type='text/javascript'>alert('Saldo atualizado!');window.location.href='carteira.php';</script>"; die();
        }

        // MÉTODOS ESPECIAIS
        public function setCarteira($carteira) {
            $this->carteira = $carteira;
        }
        public function getCarteira() {
            return $this->carteira;
        }
    }
 ?>