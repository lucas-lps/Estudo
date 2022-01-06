<?php
    require_once("c_conexao.php");

    class View {
        public function selectEstado() {   
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT idEstado, sigla FROM estado ORDER BY sigla");
            oci_execute($select);
            
            echo "<select name=\"idEstado\">";
            while ($array = oci_fetch_array($select)) {
                echo "<option value=\"" . $array[0] . "\">". $array[1] . "</option>";
            }
            echo "</select>";  
        }

        public function selectEditarEstado($idEstado, $sigla) {
            $conexao = new Conexao();
            
            $select = oci_parse($conexao->conectar(), "SELECT idEstado, sigla FROM estado WHERE idEstado <> $idEstado ORDER BY sigla");
            oci_execute($select);
            
            echo "<select name=\"idEstado\">";
            echo "<option value=\"" . $idEstado . "\">".  $sigla . "</option>";
            while ($array = oci_fetch_array($select)) {
                echo "<option value=\"" . $array[0] . "\">" . $array[1] . "</option>";
            }
            echo "</select>";    
        }
    }
?>