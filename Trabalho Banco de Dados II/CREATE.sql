CREATE TABLE estado (
    idEstado INTEGER NOT NULL PRIMARY KEY,
    sigla VARCHAR2(2) NOT NULL
);

CREATE TABLE usuario (
    idUsuario INTEGER NOT NULL PRIMARY KEY,
    idEstado INTEGER NOT NULL,
    nomeUsuario VARCHAR2(100) NOT NULL,
    dataNascimento DATE NOT NULL,
    email VARCHAR2(100) NOT NULL,
    cpf VARCHAR2(20) NOT NULL,
    cidade VARCHAR2(100) NOT NULL,
    endereco VARCHAR2(100) NOT NULL,
    numero INTEGER NOT NULL,
    bairro VARCHAR2(100) NOT NULL,
    telefone VARCHAR2(20) NOT NULL,
    FOREIGN KEY (idEstado) REFERENCES estado (idEstado)
);

CREATE TABLE tipoConta (
    idTipoConta INTEGER NOT NULL PRIMARY KEY,
    tipoConta VARCHAR2(20) NOT NULL
);

CREATE TABLE conta (
    idConta INTEGER NOT NULL PRIMARY KEY,
    idUsuario INTEGER NOT NULL,
    idTipoConta INTEGER NOT NULL,
    login VARCHAR2(20) NOT NULL,
    senha VARCHAR2(20) NOT NULL,
    carteira DECIMAL(10,2) NOT NULL,
    dataCadastro DATE NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario),
    FOREIGN KEY (idTipoConta) REFERENCES tipoConta (idTipoConta)
);

CREATE TABLE jogo (
    idJogo INTEGER NOT NULL PRIMARY KEY,
    nomeJogo VARCHAR2(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    plataforma VARCHAR2(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    dataLancamento DATE NOT NULL
);

CREATE TABLE biblioteca (
    idBiblioteca INTEGER NOT NULL PRIMARY KEY,
    idConta INTEGER NOT NULL,
    idJogo INTEGER NOT NULL,
    dataAquisicao DATE NOT NULL,
    FOREIGN KEY (idConta) REFERENCES conta (idConta),
    FOREIGN KEY (idJogo) REFERENCES jogo (idJogo)
);

CREATE TABLE listaDesejo (
    idListaDesejo INTEGER NOT NULL PRIMARY KEY,
    idConta INTEGER NOT NULL,
    idJogo INTEGER NOT NULL,
    dataAdicao DATE NOT NULL,
    FOREIGN KEY (idConta) REFERENCES conta (idConta),
    FOREIGN KEY (idJogo) REFERENCES jogo (idJogo)
);

CREATE SEQUENCE s_estado START WITH 1 NOCACHE;
CREATE SEQUENCE s_usuario START WITH 1 NOCACHE;
CREATE SEQUENCE s_tipoConta START WITH 1 NOCACHE;
CREATE SEQUENCE s_conta START WITH 100 NOCACHE;
CREATE SEQUENCE s_jogo START WITH 1000 NOCACHE;
CREATE SEQUENCE s_biblioteca START WITH 1 NOCACHE;
CREATE SEQUENCE s_listaDesejo START WITH 1 NOCACHE;