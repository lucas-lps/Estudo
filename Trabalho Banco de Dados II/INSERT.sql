INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'AC');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'AL');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'AP');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'AM');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'BA');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'CE');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'DF');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'ES');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'GO');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'MA');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'MT');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'MS');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'MG');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'PA');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'PB');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'PR');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'PE');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'PI');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'RJ');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'RN');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'RS');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'RO');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'RR');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'SC');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'SP');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'SE');
INSERT INTO estado (idEstado, sigla) VALUES (s_estado.nextval, 'TO');

INSERT INTO usuario (idUsuario, idEstado, nomeUsuario, dataNascimento, email, cpf, cidade, endereco, numero, bairro, telefone)
VALUES (s_usuario.nextval, 21, 'Lucas Lopes', '26-01-1996', 'lucas@gmail.com', '12345678900', 'Eldorado do Sul', 'Rua Aldorindo de Oliveira Maia', 177, 'Cidade Verde', '51994476481');

INSERT INTO usuario (idUsuario, idEstado, nomeUsuario, dataNascimento, email, cpf, cidade, endereco, numero, bairro, telefone)
VALUES (s_usuario.nextval, 24, 'Maria Vieira', '25-10-2004', 'maria@gmail.com', '98765432100', 'Brusque', 'Rua A', 48, 'Santa Terezinha', '45912345678');

INSERT INTO usuario (idUsuario, idEstado, nomeUsuario, dataNascimento, email, cpf, cidade, endereco, numero, bairro, telefone)
VALUES (s_usuario.nextval, 21, 'Joao Silva', '03-02-2001', 'joao@gmail.com', '10101010101', 'Porto Alegre', 'Av. Assis Brasil', 500, 'Sao Joao', '51910101010');

INSERT INTO tipoConta (idTipoConta, tipoConta) VALUES (s_tipoConta.nextval, 'Administrador');
INSERT INTO tipoConta (idTipoConta, tipoConta) VALUES (s_tipoConta.nextval, 'Cliente');

INSERT INTO conta (idConta, idUsuario, idTipoConta, login, senha, carteira) VALUES (s_conta.nextval, 1, 1, 'lucas-lopes', 'senha', 0, '20-12-2021');
INSERT INTO conta (idConta, idUsuario, idTipoConta, login, senha, carteira) VALUES (s_conta.nextval, 2, 1, 'maria-vieira', '12345', 0, '20-12-2021');
INSERT INTO conta (idConta, idUsuario, idTipoConta, login, senha, carteira) VALUES (s_conta.nextval, 3, 2, 'joao-silva', 'abc', 0, '04-01-2022');

INSERT INTO jogo (idJogo, nomeJogo, genero, plataforma, preco, dataLancamento) VALUES (s_jogo.nextval, 'Red Dead Redemption 2', 'Acao-Aventura', 'PC', 249, '05-11-2019');
INSERT INTO jogo (idJogo, nomeJogo, genero, plataforma, preco, dataLancamento) VALUES (s_jogo.nextval, 'Resident Evil Village', 'Survival horror', 'PC', 199.90, '07-15-2021');