<?php
    require_once("c_conexao.php");

    class Jogo {
        public function listarJogos($idTipoConta) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT idJogo, nomeJogo, genero, plataforma, preco, dataLancamento FROM jogo ORDER BY nomeJogo");

            oci_execute($select);

            date_default_timezone_set('America/Sao_Paulo');

            while ($array = oci_fetch_array($select)) {
                $idJogo         = $array[0];
                $nomeJogo       = $array[1];
                $genero         = $array[2];
                $plataforma     = $array[3];
                $preco          = $array[4];
                $dataLancamento = $array[5];
                $dataLancamento = date('d-m-Y',  strtotime($dataLancamento));

                echo '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
                    echo '<colgroup>';
                        echo '<col style="width: 25%">';
                        echo '<col style="width: 25%">';
                        echo '<col style="width: 20%">';
                        echo '<col style="width: 10%">';
                        echo '<col style="width: 10%">';
                        echo '<col style="width: 5%">';
                        echo '<col style="width: 5%">';
                    echo '</colgroup>';
                    echo '<tr>';
                        echo "<th class='table-list'>$nomeJogo</th>";
                        echo "<th class='table-list'>$genero</th>";
                        echo "<th class='table-list'>$plataforma</th>";
                        echo "<th class='table-list'>R$ $preco</th>";
                        echo "<th class='table-list'>$dataLancamento</th>";
                        if($idTipoConta == 1) {
                            echo "<th class='table-list'><a href='jogoInfo.php?idJogo=$idJogo'>Editar</a></th>";
                            echo "<th class='table-list'><a href='excluirJogo.php?idJogo=$idJogo'>Excluir</a></th>";
                        } else {
                            echo "<th class='table-list'><a href='comprarJogo.php?idJogo=$idJogo'>Comprar</a></th>";
                            echo "<th class='table-list'><a href='adicionarDesejo.php?idJogo=$idJogo'>+ Lista</a></th>";
                        }
                    echo '</tr>';
                echo '</table>';
            }
        }

        public function cadastrarJogo($nomeJogo, $genero, $plataforma, $preco, $dataLancamento) {
            $conexao = new Conexao();

            $insert = oci_parse($conexao->conectar(), "INSERT INTO jogo (idJogo, nomeJogo, genero, plataforma, preco, dataLancamento)
            VALUES (s_jogo.nextval, '$nomeJogo', '$genero', '$plataforma', $preco, '$dataLancamento')");

            oci_execute($insert);

            echo "<script language='javascript' type='text/javascript'>alert('Jogo cadastrado com sucesso!');window.location.href='jogos.php';</script>"; die();
        }

        public function carregarDados($idJogo) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT idJogo, nomeJogo, genero, plataforma, preco, dataLancamento FROM jogo WHERE idJogo = $idJogo");

            oci_execute($select);

            date_default_timezone_set('America/Sao_Paulo');
            
            $array = oci_fetch_array($select);
            $this->setIdJogo($array[0]);
            $this->setNomeJogo($array[1]);
            $this->setGenero($array[2]);
            $this->setPlataforma($array[3]);
            $this->setPreco($array[4]);
            $array[5] = date('Y-m-d',  strtotime($array[5]));
            $this->setDataLancamento($array[5]);
        }

        public function editarJogo($idJogo, $nomeJogo, $genero, $plataforma, $preco, $dataLancamento) {
            $conexao = new Conexao();

            $update = oci_parse($conexao->conectar(), "UPDATE jogo SET nomeJogo = '$nomeJogo', genero = '$genero', plataforma = '$plataforma', preco = $preco, dataLancamento = '$dataLancamento' WHERE idJogo = $idJogo");

            oci_execute($update);

            echo "<script language='javascript' type='text/javascript'>alert('Jogo atualizado com sucesso!');window.location.href='jogos.php';</script>"; die();
        }

        public function excluirJogo($idJogo) {
            $conexao = new Conexao();

            $delete = oci_parse($conexao->conectar(), "DELETE FROM jogo WHERE idJogo = $idJogo");

            oci_execute($delete);

            echo "<script language='javascript' type='text/javascript'>alert('Jogo deletado com sucesso!');window.location.href='jogos.php';</script>"; die();
        }

        public function excluirJogoDesejos($idJogo, $idUsuario) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT idConta FROM conta WHERE idUsuario = $idUsuario");

            oci_execute($select);

            $array = oci_fetch_array($select);
            $idConta = $array[0];

            $select = oci_parse($conexao->conectar(), "SELECT nomeJogo FROM jogo WHERE idJogo = $idJogo");

            oci_execute($select);

            $array = oci_fetch_array($select);
            $nomeJogo = $array[0];

            $delete = oci_parse($conexao->conectar(), "DELETE FROM listaDesejo WHERE idJogo = $idJogo AND idConta = $idConta");

            oci_execute($delete);

            echo "<script language='javascript' type='text/javascript'>alert('$nomeJogo foi removido da sua lista de desejos.');window.location.href='listaDesejos.php';</script>"; die();
        }

        public function adicionarDesejo($idJogo, $idUsuario) {
            echo '<meta charset="UTF-8">';

            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT ld.idJogo FROM listaDesejo ld
            JOIN jogo j  ON ld.idJogo = j.idJogo
            JOIN conta c ON ld.idConta = c.idConta
            WHERE ld.idJogo = $idJogo AND c.idUsuario = $idUsuario");

            oci_execute($select);
            $array = oci_fetch_array($select);

            if(oci_num_rows($select) > 0) {
                echo "<script language='javascript' type='text/javascript'>alert('Este jogo já está na sua lista de desejos.');window.location.href='home.php';</script>"; die();
            } else {
                $select = oci_parse($conexao->conectar(), "SELECT b.idJogo FROM biblioteca b
                JOIN jogo j  ON b.idJogo = j.idJogo
                JOIN conta c ON b.idConta = c.idConta
                WHERE b.idJogo = $idJogo AND c.idUsuario = $idUsuario");

                oci_execute($select);
                $array = oci_fetch_array($select);

                if(oci_num_rows($select) > 0) {
                    echo "<script language='javascript' type='text/javascript'>alert('Este jogo já está na sua biblioteca e não pode ser adicionado à sua lista de desejos.');window.location.href='home.php';</script>"; die();
                }

                date_default_timezone_set('America/Sao_Paulo');
                $hoje = date("d-M-y");

                $select = oci_parse($conexao->conectar(), "SELECT nomeJogo FROM jogo WHERE idJogo = $idJogo");

                oci_execute($select);

                $array = oci_fetch_array($select);
                $nomeJogo = $array[0];

                $select = oci_parse($conexao->conectar(), "SELECT idConta FROM conta WHERE idUsuario = $idUsuario");

                oci_execute($select);

                $array = oci_fetch_array($select);
                $idConta = $array[0];

                $insert = oci_parse($conexao->conectar(), "INSERT INTO listaDesejo (idListaDesejo, idConta, idJogo, dataAdicao) VALUES (s_listaDesejo.nextval, $idConta, $idJogo, '$hoje')");

                oci_execute($insert);

                echo "<script language='javascript' type='text/javascript'>alert('$nomeJogo foi adicionado a sua lista de desejos.');window.location.href='home.php';</script>"; die();
            }
        }

        public function listarBibliotecaDesejos($idUsuario, $id) {
            $conexao = new Conexao();

            if($id == 1) {
                $select = oci_parse($conexao->conectar(), "SELECT j.idJogo, j.nomeJogo, j.genero, j.plataforma, j.preco, j.dataLancamento, b.dataAquisicao FROM conta c
                JOIN biblioteca b   ON c.idConta = b.idConta
                JOIN jogo j         ON b.idJogo = j.idJogo
                WHERE c.idUsuario = $idUsuario ORDER BY j.nomeJogo");
            } else {
                $select = oci_parse($conexao->conectar(), "SELECT j.idJogo, j.nomeJogo, j.genero, j.plataforma, j.preco, j.dataLancamento, ld.dataAdicao FROM conta c
                JOIN listaDesejo ld ON c.idConta = ld.idConta
                JOIN jogo j         ON ld.idJogo = j.idJogo
                WHERE c.idUsuario = $idUsuario ORDER BY j.nomeJogo");
            }

            oci_execute($select);

            date_default_timezone_set('America/Sao_Paulo');

            while ($array = oci_fetch_array($select)) {
                $idJogo         = $array[0];
                $nomeJogo       = $array[1];
                $genero         = $array[2];
                $plataforma     = $array[3];
                $preco          = $array[4];
                $dataLancamento = $array[5];
                $dataLancamento = date('d-m-Y',  strtotime($dataLancamento));
                $data           = $array[6];
                $data           = date('d-m-Y',  strtotime($data));

                if($id == 1) {
                    echo '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
                        echo '<colgroup>';
                            echo '<col style="width: 25%">';
                            echo '<col style="width: 25%">';
                            echo '<col style="width: 20%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 10%">';
                        echo '</colgroup>';
                        echo '<tr>';
                            echo "<th class='table-list'>$nomeJogo</th>";
                            echo "<th class='table-list'>$genero</th>";
                            echo "<th class='table-list'>$plataforma</th>";
                            echo "<th class='table-list'>R$ $preco</th>";
                            echo "<th class='table-list'>$dataLancamento</th>";
                            echo "<th class='table-list'>$data</th>";
                        echo '</tr>';
                    echo '</table>';
                } else {
                    echo '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
                        echo '<colgroup>';
                            echo '<col style="width: 25%">';
                            echo '<col style="width: 25%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 10%">';
                            echo '<col style="width: 5%">';
                            echo '<col style="width: 5%">';
                        echo '</colgroup>';
                        echo '<tr>';
                            echo "<th class='table-list'>$nomeJogo</th>";
                            echo "<th class='table-list'>$genero</th>";
                            echo "<th class='table-list'>$plataforma</th>";
                            echo "<th class='table-list'>R$ $preco</th>";
                            echo "<th class='table-list'>$dataLancamento</th>";
                            echo "<th class='table-list'>$data</th>";
                            echo "<th class='table-list'><a href='comprarJogo.php?idJogo=$idJogo'>Comprar</a></th>";
                            echo "<th class='table-list'><a href='excluirJogoDesejos.php?idJogo=$idJogo&idUsuario=$idUsuario'>Excluir</a></th>";
                        echo '</tr>';
                    echo '</table>';
                }
            }
        }

        public function comprarJogo($idJogo, $idUsuario, $carteira) {
            echo '<meta charset="UTF-8">';

            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT b.idJogo, j.nomeJogo FROM biblioteca b
            JOIN jogo j  ON b.idJogo = j.idJogo
            JOIN conta c ON b.idConta = c.idConta
            WHERE b.idJogo = $idJogo AND c.idUsuario = $idUsuario");

            oci_execute($select);
            $array = oci_fetch_array($select);

            if(oci_num_rows($select) > 0) {
                echo "<script language='javascript' type='text/javascript'>alert('Este jogo já está na sua biblioteca.');window.location.href='home.php';</script>"; die();
            } else {
                $select = oci_parse($conexao->conectar(), "SELECT nomeJogo, preco FROM jogo WHERE idJogo = $idJogo");

                oci_execute($select);

                $array = oci_fetch_array($select);
                $nomeJogo = $array[0];
                $preco    = $array[1];

                if($preco > $carteira) {
                    echo "<script language='javascript' type='text/javascript'>alert('Você não possui saldo suficiente para comprar este jogo.');window.location.href='home.php';</script>"; die();
                } else {
                    date_default_timezone_set('America/Sao_Paulo');
                    $hoje = date("d-M-y");

                    $select = oci_parse($conexao->conectar(), "SELECT idConta FROM conta WHERE idUsuario = $idUsuario");

                    oci_execute($select);

                    $array = oci_fetch_array($select);
                    $idConta = $array[0];

                    $select = oci_parse($conexao->conectar(), "SELECT idJogo FROM listaDesejo WHERE idJogo = $idJogo AND idConta = $idConta");

                    oci_execute($select);

                    $array = oci_fetch_array($select);
                    
                    if(oci_num_rows($select) > 0) {
                        $delete = oci_parse($conexao->conectar(), "DELETE FROM listaDesejo WHERE idJogo = $idJogo AND idConta = $idConta");

                        oci_execute($delete);
                    }

                    $insert = oci_parse($conexao->conectar(), "INSERT INTO biblioteca (idBiblioteca, idConta, idJogo, dataAquisicao) VALUES (s_biblioteca.nextval, $idConta, $idJogo, '$hoje')");

                    oci_execute($insert);

                    $novoSaldo = $carteira - $preco;

                    $update = oci_parse($conexao->conectar(), "UPDATE conta SET carteira = $novoSaldo WHERE idConta = $idConta");

                    oci_execute($update);

                    echo "<script language='javascript' type='text/javascript'>alert('$nomeJogo foi adicionado a sua biblioteca.');window.location.href='home.php';</script>"; die();
                }
            }
        }

        // MÉTODOS ESPECIAIS
        public function setIdJogo($idJogo) {
            $this->idJogo = $idJogo;
        }
        public function getIdJogo() {
            return $this->idJogo;
        }
        public function setNomeJogo($nomeJogo) {
            $this->nomeJogo = $nomeJogo;
        }
        public function getNomeJogo() {
            return $this->nomeJogo;
        }
        public function setGenero($genero) {
            $this->genero = $genero;
        }
        public function getGenero() {
            return $this->genero;
        }
        public function setPlataforma($plataforma) {
            $this->plataforma = $plataforma;
        }
        public function getPlataforma() {
            return $this->plataforma;
        }
        public function setPreco($preco) {
            $this->preco = $preco;
        }
        public function getPreco() {
            return $this->preco;
        }
        public function setDataLancamento($dataLancamento) {
            $this->dataLancamento = $dataLancamento;
        }
        public function getDataLancamento() {
            return $this->dataLancamento;
        }
    }
?>