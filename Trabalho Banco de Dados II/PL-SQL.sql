/***** PROCEDURE 1 ****************************************************************************/

-- Esta procedure recebe o login e a senha de um determinado usuário como parâmetros de entrada e devolve seu idUsuario e idTipoConta.
-- Caso nenhum dado for encontrado, idUsuario e idTipoConta recebem NULL.
-- A procedure é usada na linha 8 da classe c_usuario.php (classes/c_usuario.php).

CREATE OR REPLACE PROCEDURE logar (p_login IN VARCHAR2, p_senha IN VARCHAR2, p_idUsuario OUT NUMBER, p_idTipoConta OUT NUMBER) IS
BEGIN
    SELECT idUsuario, idTipoConta
    INTO p_idUsuario, p_idTipoConta
    FROM conta 
    WHERE login = p_login AND senha = p_senha;
    EXCEPTION
    WHEN no_data_found 
    THEN
        p_idUsuario := null;
        p_idTipoConta := null;
END;

VARIABLE p_idUsuario NUMBER;
VARIABLE p_idTipoConta NUMBER;
EXEC logar('lucas-lopes', 'senha', :p_idUsuario, :p_idTipoConta);
PRINT p_idUsuario;
PRINT p_idTipoConta;

/**********************************************************************************************/

/***** PROCEDURE 2 ****************************************************************************/

-- Esta procedure recebe como parâmetros valores que serão usados para cadastrar um novo usuário no banco de dados, realizando um insert.
-- A procedure é usada na linha 93 da classe c_usuario.php (classes/c_usuario.php).

CREATE OR REPLACE PROCEDURE cadastrarUsuario (p_idEstado IN NUMBER, p_nomeUsuario IN VARCHAR2, p_dataNascimento IN DATE, p_email IN VARCHAR2, p_cpf IN VARCHAR2, p_cidade IN VARCHAR2, p_endereco IN VARCHAR2, p_numero IN NUMBER, p_bairro IN VARCHAR2, p_telefone IN VARCHAR2) IS
BEGIN
    INSERT INTO usuario (idUsuario, idEstado, nomeUsuario, dataNascimento, email, cpf, cidade, endereco, numero, bairro, telefone)
    VALUES (s_usuario.nextval, p_idEstado, p_nomeUsuario, p_dataNascimento, p_email, p_cpf, p_cidade, p_endereco, p_numero, p_bairro, p_telefone);
END;

/**********************************************************************************************/

/***** PROCEDURE 3 ****************************************************************************/

-- Esta procedure recebe como parâmetros valores que serão usados para editar um usuário já existente no banco de dados, realizando um update.
-- A procedure é usada na linha 150 da classe c_usuario.php (classes/c_usuario.php).

CREATE OR REPLACE PROCEDURE editarUsuario (p_idUsuario IN NUMBER, p_idEstado IN NUMBER, p_nomeUsuario IN VARCHAR2, p_dataNascimento IN DATE, p_email IN VARCHAR2, p_cidade IN VARCHAR2, p_endereco IN VARCHAR2, p_numero IN NUMBER, p_bairro IN VARCHAR2, p_telefone IN VARCHAR2, p_login IN VARCHAR2, p_senha IN VARCHAR2) IS
BEGIN
    UPDATE usuario SET idEstado = p_idEstado, nomeUsuario = p_nomeUsuario, dataNascimento = p_dataNascimento, email = p_email, cidade = p_cidade, endereco = p_endereco, numero = p_numero, bairro = p_bairro, telefone = p_telefone
    WHERE idUsuario = p_idUsuario;

    UPDATE conta SET login = p_login, senha = p_senha WHERE idUsuario = p_idUsuario;
END;

/**********************************************************************************************/

/***** PROCEDURE 4 ****************************************************************************/

-- Estado procedure recebe como parâmetro o idUsuario e devolve todos os dados da tabela usuario referentes ao mesmo, assim como o seu login e senha da tabela conta.
-- A procedure é usada na linha 39 da classe c_usuario.php (classes/c_usuario.php).

CREATE OR REPLACE PROCEDURE carregarDados(p_idUsuario IN NUMBER, p_nomeUsuario OUT VARCHAR2, p_dataNascimento OUT VARCHAR2, p_cpf OUT VARCHAR2, p_email OUT VARCHAR2, p_telefone OUT VARCHAR2, p_endereco OUT VARCHAR2, p_numero OUT NUMBER, p_bairro OUT VARCHAR2, p_cidade OUT VARCHAR2, p_idEstado OUT NUMBER, p_sigla OUT VARCHAR2, p_login OUT VARCHAR2, p_senha OUT VARCHAR2) IS
BEGIN
    SELECT u.nomeUsuario, u.dataNascimento, u.cpf, u.email, u.telefone, u.endereco, u.numero, u.bairro, u.cidade, e.idEstado, e.sigla, c.login, c.senha
    INTO p_nomeUsuario, p_dataNascimento, p_cpf, p_email, p_telefone, p_endereco, p_numero, p_bairro, p_cidade, p_idEstado, p_sigla, p_login, p_senha
    FROM usuario u
    JOIN estado e ON u.idEstado = e.idEstado
    JOIN conta c ON u.idUsuario = c.idUsuario
    WHERE u.idUsuario = p_idUsuario;
END;

/**********************************************************************************************/

/***** TRIGGER 1 ******************************************************************************/

-- Esta trigger será disparada sempre antes de um insert ou update na tabela conta. Ela serve para impossibilitar a criação de logins com o mesmo nome. Caso o usuário tente criar ou modificar seu login com um nome já existente, o erro "Este login já existe" será exibido.

CREATE OR REPLACE TRIGGER verificaLogin
BEFORE
INSERT OR UPDATE OF login ON conta
FOR EACH ROW
DECLARE
PRAGMA AUTONOMOUS_TRANSACTION;
v_login VARCHAR2(20);
BEGIN
    SELECT login
    INTO v_login
    FROM conta
    WHERE login = :new.login AND idUsuario <> :new.idUsuario;
    IF (:new.login = v_login) THEN
        raise_application_error(-20601, 'Este login já existe');
    END IF;
    EXCEPTION
    WHEN no_data_found THEN
    NULL;
END;

/**********************************************************************************************/

/***** TRIGGER 2 ******************************************************************************/

-- Esta trigger será disparada sempre antes de um insert ou update na tabela biblioteca. Ela serve para impossibilitar a adição de um mesmo jogo na biblioteca de um usuário. Caso o usuário tente comprar um jogo que já está na sua biblioteca, o erro "Este jogo já está na sua biblioteca" será exibido.

CREATE OR REPLACE TRIGGER comprarJogo
BEFORE
INSERT OR UPDATE OF idJogo ON biblioteca
FOR EACH ROW
DECLARE
PRAGMA AUTONOMOUS_TRANSACTION;
v_idJogo NUMBER;
BEGIN
    SELECT idJogo
    INTO v_idJogo
    FROM biblioteca
    WHERE idJogo = :new.idJogo AND idConta = :new.idConta;
    IF (:new.idJogo = v_idJogo) THEN
        raise_application_error(-20601, 'Este jogo já está na sua biblioteca');
    END IF;
    EXCEPTION
    WHEN no_data_found THEN
    NULL;
END;

/**********************************************************************************************/

/***** CURSOR *********************************************************************************/

-- Esta procedure possui um cursor que pode retornar N linhas. Ela recebe os parâmetros idUsuario e id (1 = biblioteca; 2 = listaDesejo) e exibe na tela todos os jogos, com suas respectivas informações, presentes na biblioteca ou lista de desejos de um determinado usuário.

CREATE OR REPLACE PROCEDURE listarBibliotecaDesejos (p_idUsuario IN NUMBER, p_id IN NUMBER) IS
CURSOR c_biblioteca IS
    SELECT j.idJogo, j.nomeJogo, j.genero, j.plataforma, j.preco, j.dataLancamento, b.dataAquisicao
    FROM conta c
    JOIN biblioteca b   ON c.idConta = b.idConta
    JOIN jogo j         ON b.idJogo = j.idJogo
    WHERE c.idUsuario = p_idUsuario ORDER BY j.nomeJogo;
CURSOR c_listaDesejo IS
    SELECT j.idJogo, j.nomeJogo, j.genero, j.plataforma, j.preco, j.dataLancamento, ld.dataAdicao
    FROM conta c
    JOIN listaDesejo ld ON c.idConta = ld.idConta
    JOIN jogo j         ON ld.idJogo = j.idJogo
    WHERE c.idUsuario = p_idUsuario ORDER BY j.nomeJogo;
BEGIN
    IF(p_id = 1) THEN
        FOR r_listar IN c_biblioteca LOOP
            DBMS_OUTPUT.PUT_LINE('idJogo: '||r_listar.idJogo||' nomeJogo: '||r_listar.nomeJogo||' genero: '||r_listar.genero||' plataforma: '||r_listar.plataforma||' preco: '||r_listar.preco||' dataLancamento: '||r_listar.dataLancamento||' dataAquisicao: '||r_listar.dataAquisicao);
        END LOOP;
    ELSE
        FOR r_listar IN c_listaDesejo LOOP
            DBMS_OUTPUT.PUT_LINE('idJogo: '||r_listar.idJogo||' nomeJogo: '||r_listar.nomeJogo||' genero: '||r_listar.genero||' plataforma: '||r_listar.plataforma||' preco: '||r_listar.preco||' dataLancamento: '||r_listar.dataLancamento||' dataAdicao: '||r_listar.dataAdicao);
        END LOOP;
    END IF;
END;

SET SERVEROUTPUT ON;
EXEC listarbibliotecadesejos(2, 2);

/**********************************************************************************************/

/***** FUNCTION 1 *****************************************************************************/

-- Esta function recebe como parâmetro o login de um determinado usuário e retorna em dias o tempo em que a conta foi criada.
-- A function é usada na linha 24 da página estatisticas.php (admin/estatisticas.php).

CREATE OR REPLACE FUNCTION retornaTempoConta (p_login IN VARCHAR2) RETURN
NUMBER IS
v_dias NUMBER;
BEGIN
    SELECT TO_DATE(SYSDATE, 'DD-MM-YY') - TO_DATE(dataCadastro, 'DD-MM-YY') AS DateDiff
    INTO v_dias
    FROM conta
    WHERE login = p_login;
    
    RETURN v_dias;
    
    EXCEPTION
    WHEN no_data_found 
    THEN
        RETURN null;
END;

SELECT retornaTempoConta('lucas-lopes') FROM dual;

/**********************************************************************************************/

/***** FUNCTION 2 *****************************************************************************/

-- Esta function recebe como parâmetro o idUsuario de um determinado usuário e retorna o seu tipo de conta (administrador ou cliente).
-- A function é usada na linha 41 da página estatisticas.php (admin/estatisticas.php).

CREATE OR REPLACE FUNCTION retornaTipoConta (p_idUsuario IN NUMBER) RETURN
VARCHAR2 IS
v_tipoConta VARCHAR2(20);
BEGIN
    SELECT tipoConta
    INTO v_tipoConta
    FROM tipoConta tc
    JOIN conta c ON tc.idTipoConta = c.idTipoConta
    WHERE c.idUsuario = p_idUsuario;
    
    RETURN v_tipoConta;
    
    EXCEPTION
    WHEN no_data_found 
    THEN
        RETURN null;
END;

SELECT retornaTipoConta(2) FROM dual;

/**********************************************************************************************/

/***** FUNCTION 3 *****************************************************************************/

-- Esta function recebe como parâmtro o nomeJogo de um determinado jogo e retorna o número de usuários que possuem o mesmo em sua biblioteca.
-- A function é usada na linha 58 da página estatisticas.php (admin/estatisticas.php).

CREATE OR REPLACE FUNCTION retornaUsuarioJogos (p_nomeJogo IN VARCHAR2) RETURN
NUMBER IS
v_usuarios NUMBER;
v_jogo NUMBER;
BEGIN
    SELECT count(*)
    INTO v_usuarios
    FROM biblioteca b
    JOIN jogo j ON b.idJogo = j.idJogo
    WHERE j.nomeJogo = p_nomeJogo;
    
    SELECT count(*)
    INTO v_jogo
    FROM jogo
    WHERE nomeJogo = p_nomeJogo;
    
    IF (v_jogo > 0) THEN
        RETURN v_usuarios;
    ELSE
        RETURN null;
    END IF;
END;

SELECT retornaUsuarioJogos('Red Dead Redemption 2') FROM dual;

/**********************************************************************************************/

/***** FUNCTION 4 *****************************************************************************/

-- Esta function recebe como parâmetro o idUsuario de um determinado usuário e retorna seu saldo na carteira.
-- A function é usada na linha 8 da classe c_conta.php (classes/c_conta.php).

CREATE OR REPLACE FUNCTION retornaSaldo (p_idUsuario IN NUMBER) RETURN
NUMBER IS
v_saldo NUMBER;
BEGIN
    SELECT carteira
    INTO v_saldo
    FROM conta
    WHERE idUsuario = p_idUsuario;
    
    RETURN v_saldo;
END;

SELECT retornaSaldo(2) FROM dual;

/**********************************************************************************************/