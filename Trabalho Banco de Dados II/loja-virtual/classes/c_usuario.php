<?php
    require_once("c_conexao.php");

    class Usuario {
        public function logar($login, $senha) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "BEGIN logar(:p_login, :p_senha, :p_idUsuario, :p_idTipoConta); END;");
			
		    OCIBindByName($select, ":p_login", $login);
		    OCIBindByName($select, ":p_senha", $senha);
            OCIBindByName($select, ":p_idUsuario", $idUsuario);
            OCIBindByName($select, ":p_idTipoConta", $idTipoConta);

            oci_execute($select);

            if($idUsuario != NULL && $idTipoConta != NULL) {
                $_SESSION['idUsuario']   = $idUsuario;
                $_SESSION['idTipoConta'] = $idTipoConta;
                $_SESSION['login']       = $login;
                $_SESSION['senha']       = $senha;
                setcookie("login", $login);
                setcookie("senha", $senha);
                setcookie("idUsuario", $idUsuario);
                setcookie("idTipoConta", $idTipoConta);
                if ($idTipoConta == 1){
                    header('location: admin/home.php');
                } else {
                    header('location: cliente/home.php');
                }
            } else {
                echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.php';</script>"; die();
            }
        }

        public function carregarDados($idUsuario) {
            $conexao = new Conexao();
            
            $select = oci_parse($conexao->conectar(), "BEGIN carregarDados(:p_idUsuario, :p_nomeUsuario, :p_dataNascimento, :p_cpf, :p_email, :p_telefone, :p_endereco, :p_numero, :p_bairro, :p_cidade, :p_idEstado, :p_sigla, :p_login, :p_senha); END;");

            OCIBindByName($select, ":p_idUsuario", $idUsuario);
            OCIBindByName($select, ":p_nomeUsuario", $nomeUsuario, 100);
            OCIBindByName($select, ":p_dataNascimento", $dataNascimento, 20);
            OCIBindByName($select, ":p_cpf", $cpf, 20);
            OCIBindByName($select, ":p_email", $email, 100);
            OCIBindByName($select, ":p_telefone", $telefone, 20);
            OCIBindByName($select, ":p_endereco", $endereco, 100);
            OCIBindByName($select, ":p_numero", $numero);
            OCIBindByName($select, ":p_bairro", $bairro, 100);
            OCIBindByName($select, ":p_cidade", $cidade, 100);
            OCIBindByName($select, ":p_idEstado", $idEstado);
            OCIBindByName($select, ":p_sigla", $sigla, 2);
            OCIBindByName($select, ":p_login", $login, 20);
            OCIBindByName($select, ":p_senha", $senha, 20);

            oci_execute($select);

            date_default_timezone_set('America/Sao_Paulo');

            $this->setIdUsuario($idUsuario);
            $this->setNomeUsuario($nomeUsuario);
            $dataNascimento = date('Y-m-d',  strtotime($dataNascimento));
            $this->setDataNascimento($dataNascimento);
            $this->setCpf($cpf);
            $this->setEmail($email);
            $this->setTelefone($telefone);
            $this->setEndereco($endereco);
            $this->setNumero($numero);
            $this->setBairro($bairro);
            $this->setCidade($cidade);
            $this->setIdEstado($idEstado);
            $this->setSigla($sigla);
            $this->setLogin($login);
            $this->setSenha($senha);
        }

        public function cadastrarUsuario($nomeUsuario, $dataNascimento, $cpf, $email, $telefone, $endereco, $numero, $bairro, $cidade, $idEstado, $login, $senha, $senha2, $id) {
            if($senha != $senha2) {
                echo "<script language='javascript' type='text/javascript'>alert('As senhas devem ser iguais!');window.location.href='cadastro.php';</script>"; die();
            } else {
                $conexao = new Conexao();

                $select = oci_parse($conexao->conectar(), "SELECT login FROM conta WHERE login = '$login'");

                oci_execute($select);

                $array = oci_fetch_array($select);
                $loginArray = $array[0];

                if($loginArray == $login) {
                    echo "<script language='javascript' type='text/javascript'>alert('Este login ja existe!');window.location.href='cadastro.php';</script>"; die();
                } else {
                    $insert = oci_parse($conexao->conectar(), "BEGIN cadastrarUsuario(:p_idEstado, :p_nomeUsuario, :p_dataNascimento, :p_email, :p_cpf, :p_cidade, :p_endereco, :p_numero, :p_bairro, :p_telefone); END;");
			
		            OCIBindByName($insert, ":p_idEstado", $idEstado);
		            OCIBindByName($insert, ":p_nomeUsuario", $nomeUsuario);
                    OCIBindByName($insert, ":p_dataNascimento", $dataNascimento);
                    OCIBindByName($insert, ":p_email", $email);
                    OCIBindByName($insert, ":p_cpf", $cpf);
                    OCIBindByName($insert, ":p_cidade", $cidade);
                    OCIBindByName($insert, ":p_endereco", $endereco);
                    OCIBindByName($insert, ":p_numero", $numero);
                    OCIBindByName($insert, ":p_bairro", $bairro);
                    OCIBindByName($insert, ":p_telefone", $telefone);

                    oci_execute($insert);

                    $select = oci_parse($conexao->conectar(), "SELECT idUsuario FROM usuario WHERE cpf = '$cpf'");

                    oci_execute($select);

                    $array = oci_fetch_array($select);
                    $idUsuario = $array[0];

                    $hoje = date("d-M-y");

                    if($id == 1) {
                        $insert = oci_parse($conexao->conectar(), "INSERT INTO conta (idConta, idUsuario, idTipoConta, login, senha, carteira, dataCadastro) VALUES (s_conta.nextval, $idUsuario, 2, '$login', '$senha', 0, '$hoje')");

                        oci_execute($insert);

                        echo "<script language='javascript' type='text/javascript'>alert('Cadastro efetuado com sucesso!');window.location.href='index.php';</script>"; die();
                    } else {
                        $insert = oci_parse($conexao->conectar(), "INSERT INTO conta (idConta, idUsuario, idTipoConta, login, senha, carteira, dataCadastro) VALUES (s_conta.nextval, $idUsuario, 1, '$login', '$senha', 0, '$hoje')");

                        oci_execute($insert);

                        echo "<script language='javascript' type='text/javascript'>alert('Administrador cadastrado com sucesso');window.location.href='admin.php';</script>"; die();
                    }
                }
            }
        }

        public function editarUsuario($idUsuario, $nomeUsuario, $dataNascimento, $cpf, $email, $telefone, $endereco, $numero, $bairro, $cidade, $idEstado, $login, $senha, $senha2, $id) {
            if($senha != $senha2) {
                echo "<script language='javascript' type='text/javascript'>alert('As senhas devem ser iguais!');window.location.href='perfil.php';</script>"; die();
            } else {
                $conexao = new Conexao();

                $select = oci_parse($conexao->conectar(), "SELECT login FROM conta WHERE login = '$login' AND idUsuario <> $idUsuario");

                oci_execute($select);

                $array = oci_fetch_array($select);
                $loginArray = $array[0];

                if($loginArray == $login) {
                    echo "<script language='javascript' type='text/javascript'>alert('Este login ja existe!');window.location.href='perfil.php';</script>"; die();
                } else {
                    $update = oci_parse($conexao->conectar(), "BEGIN editarUsuario(:p_idUsuario, :p_idEstado, :p_nomeUsuario, :p_dataNascimento, :p_email, :p_cidade, :p_endereco, :p_numero, :p_bairro, :p_telefone, :p_login, :p_senha); END;");

                    OCIBindByName($update, ":p_idUsuario", $idUsuario);
                    OCIBindByName($update, ":p_idEstado", $idEstado);
		            OCIBindByName($update, ":p_nomeUsuario", $nomeUsuario);
                    OCIBindByName($update, ":p_dataNascimento", $dataNascimento);
                    OCIBindByName($update, ":p_email", $email);
                    OCIBindByName($update, ":p_cidade", $cidade);
                    OCIBindByName($update, ":p_endereco", $endereco);
                    OCIBindByName($update, ":p_numero", $numero);
                    OCIBindByName($update, ":p_bairro", $bairro);
                    OCIBindByName($update, ":p_telefone", $telefone);
                    OCIBindByName($update, ":p_login", $login);
                    OCIBindByName($update, ":p_senha", $senha);

                    oci_execute($update);

                    if($id == 1) {
                        echo "<script language='javascript' type='text/javascript'>alert('Cadastro atualizado com sucesso!!');window.location.href='perfil.php';</script>"; die();
                    } else {
                        echo "<script language='javascript' type='text/javascript'>alert('Cadastro atualizado com sucesso!');window.location.href='admin.php';</script>"; die();
                    }
                }
            }
        }

        public function listarAdmin($idUsuario) {
            $conexao = new Conexao();

            $select = oci_parse($conexao->conectar(), "SELECT u.idUsuario, c.login, u.nomeUsuario, u.email, u.dataNascimento FROM usuario u
            JOIN conta c ON u.idUsuario = c.idUsuario
            WHERE c.idTipoConta = 1 AND u.idUsuario = $idUsuario");

            oci_execute($select);

            date_default_timezone_set('America/Sao_Paulo');

            $array = oci_fetch_array($select);
            $idUsuario      = $array[0];
            $login          = $array[1];
            $nomeUsuario    = $array[2];
            $email          = $array[3];
            $dataNascimento = $array[4];
            $dataNascimento = date('d-m-Y',  strtotime($dataNascimento));

            echo '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
                echo '<colgroup>';
                    echo '<col style="width: 5%">';
                    echo '<col style="width: 25%">';
                    echo '<col style="width: 25%">';
                    echo '<col style="width: 25%">';
                    echo '<col style="width: 10%">';
                    echo '<col style="width: 5%">';
                    echo '<col style="width: 5%">';
                echo '</colgroup>';
                echo '<tr>';
                    echo "<th class='table-list'>$idUsuario</th>";
                    echo "<th class='table-list'>$login</th>";
                    echo "<th class='table-list'>$nomeUsuario</th>";
                    echo "<th class='table-list'>$email</th>";
                    echo "<th class='table-list'>$dataNascimento</th>";
                    echo "<th class='table-list'></th>";
                    echo "<th class='table-list'></th>";
                echo '</tr>';
            echo '</table>';

            $select = oci_parse($conexao->conectar(), "SELECT u.idUsuario, c.login, u.nomeUsuario, u.email, u.dataNascimento FROM usuario u
            JOIN conta c ON u.idUsuario = c.idUsuario
            WHERE c.idTipoConta = 1 AND u.idUsuario <> $idUsuario");

            oci_execute($select);

            while($array = oci_fetch_array($select)) {
                $idUsuario      = $array[0];
                $login          = $array[1];
                $nomeUsuario    = $array[2];
                $email          = $array[3];
                $dataNascimento = $array[4];
                $dataNascimento = date('d-m-Y',  strtotime($dataNascimento));

                echo '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
                    echo '<colgroup>';
                        echo '<col style="width: 5%">';
                        echo '<col style="width: 25%">';
                        echo '<col style="width: 25%">';
                        echo '<col style="width: 25%">';
                        echo '<col style="width: 10%">';
                        echo '<col style="width: 5%">';
                        echo '<col style="width: 5%">';
                    echo '</colgroup>';
                    echo '<tr>';
                        echo "<th class='table-list'>$idUsuario</th>";
                        echo "<th class='table-list'>$login</th>";
                        echo "<th class='table-list'>$nomeUsuario</th>";
                        echo "<th class='table-list'>$email</th>";
                        echo "<th class='table-list'>$dataNascimento</th>";
                        echo "<th class='table-list'><a href='editarAdmin.php?idUsuario=$idUsuario'>Editar</a></th>";
                        echo "<th class='table-list'><a href='excluirAdmin.php?idUsuario=$idUsuario'>Excluir</a></th>";
                    echo '</tr>';
                echo '</table>';
            }
        }

        public function excluirAdmin($idUsuario) {
            $conexao = new Conexao();

            $delete = oci_parse($conexao->conectar(), "DELETE FROM conta WHERE idUsuario = $idUsuario");

            oci_execute($delete);

            $delete = oci_parse($conexao->conectar(), "DELETE FROM usuario WHERE idUsuario = $idUsuario");

            oci_execute($delete);

            echo "<script language='javascript' type='text/javascript'>alert('Administrador excluido com sucesso!');window.location.href='admin.php';</script>"; die();
        }

        // MÉTODOS ESPECIAIS
        public function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }
        public function getIdUsuario() {
            return $this->idUsuario;
        }
        public function setNomeUsuario($nomeUsuario) {
            $this->nomeUsuario = $nomeUsuario;
        }
        public function getNomeUsuario() {
            return $this->nomeUsuario;
        }
        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }
        public function getDataNascimento() {
            return $this->dataNascimento;
        }
        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }
        public function getCpf() {
            return $this->cpf;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function getEmail() {
            return $this->email;
        }
        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }
        public function getTelefone() {
            return $this->telefone;
        }
        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }
        public function getEndereco() {
            return $this->endereco;
        }
        public function setNumero($numero) {
            $this->numero = $numero;
        }
        public function getNumero() {
            return $this->numero;
        }
        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }
        public function getBairro() {
            return $this->bairro;
        }
        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }
        public function getCidade() {
            return $this->cidade;
        }
        public function setIdEstado($idEstado) {
            $this->idEstado = $idEstado;
        }
        public function getIdEstado() {
            return $this->idEstado;
        }
        public function setSigla($sigla) {
            $this->sigla = $sigla;
        }
        public function getSigla() {
            return $this->sigla;
        }
        public function setLogin($login) {
            $this->login = $login;
        }
        public function getLogin() {
            return $this->login;
        }
        public function setSenha($senha) {
            $this->senha = $senha;
        }
        public function getSenha() {
            return $this->senha;
        }
    }
?>