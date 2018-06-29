CREATE DATABASE academia DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE academia;

CREATE TABLE usuario (
    matricula INT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    email VARCHAR(40),
    ativo TINYINT NOT NULL,
    senha VARCHAR(32) NOT NULL,
    novasenha BOOLEAN NOT NULL,
    nivel INT(1) NOT NULL,
    obs VARCHAR(100)
);

CREATE TABLE aluno (
    mtuser INT NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    sexo CHAR(1) NOT NULL,
    instrutor INT,
    FOREIGN KEY (mtuser)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (instrutor)
        REFERENCES usuario (matricula)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE telefone (
    mtuser INT NOT NULL,
    telefone CHAR(11) NOT NULL,
    FOREIGN KEY (mtuser)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE endereco (
    mtuser INT NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    numero VARCHAR(7) NOT NULL,
    cidade VARCHAR(60) NOT NULL,
    CEP CHAR(8),
    estado CHAR(2) NOT NULL,
    complemento VARCHAR(80),
    FOREIGN KEY (mtuser)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE avaliacao (
    mtuser INT NOT NULL,
    data DATE NOT NULL,
    altura DECIMAL(3,2) NOT NULL,
    ombro DECIMAL(4,1) NOT NULL,
    peito DECIMAL(4,1) NOT NULL,
    cintura DECIMAL(4,1) NOT NULL,
    bicepsD DECIMAL(4,1) NOT NULL,
    bicepsE DECIMAL(4,1) NOT NULL,
    antebracoD DECIMAL(4,1) NOT NULL,
    antebracoE DECIMAL(4,1) NOT NULL,
    coxaD DECIMAL(4,1) NOT NULL,
    coxaE DECIMAL(4,1) NOT NULL,
    panturrilhaD DECIMAL(4,1) NOT NULL,
    panturrilhaE DECIMAL(4,1) NOT NULL,
    FOREIGN KEY (mtuser)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE peso (
    mtuser INT NOT NULL,
    data DATE NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (mtuser)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE mensagem (
    destinatario INT NOT NULL,
    remetente INT NOT NULL,
    data DATE NOT NULL,
    lida CHAR(1) NOT NULL,
    mensagem VARCHAR(255) NOT NULL,
    FOREIGN KEY (destinatario)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (remetente)
        REFERENCES usuario (matricula)
        ON DELETE CASCADE ON UPDATE CASCADE
);

#ADMINISTRADOR - SENHA: 123456
INSERT INTO usuario VALUES 
(100010,'admintiroso','admin@whey.com',1,'e10adc3949ba59abbe56e057f20f883e',0,1,null);

#GERENTE - SENHA: 123456
INSERT INTO usuario VALUES 
(200020,'Cauã Nuhs','caua.n@whey.com',1,'e10adc3949ba59abbe56e057f20f883e',0,2,null);

#INSTRUTOR - SENHA: 123456
INSERT INTO usuario VALUES 
(300030,'Janice Bomba','janebomba@whey.com',1,'e10adc3949ba59abbe56e057f20f883e',0,3,'está aqui segundas e quartas o dia todo');
	INSERT INTO telefone VALUES 
    (300030,'61986164040');

#ALUNO - SENHA: 123456
INSERT INTO usuario VALUES 
(900090,'Tiogho Termogênico','fikagrandi@g1/2.com',1,'e10adc3949ba59abbe56e057f20f883e',0,9,'tem alergia a exercícios para perna');
	INSERT INTO aluno VALUES 
    (900090,'16202054500','m',300030);
    INSERT INTO telefone VALUES
	(900090,'6144880655'),
	(900090,'61996657700'),
	(900090,'61988852201');
    INSERT INTO endereco VALUES
	(900090,'quadra 6 conjunto 28','ap216','guarabireba','64800140','BA','prédio na rua dos correios');
    
#AVALIAÇÃO ALUNO
INSERT INTO avaliacao VALUES 
(900090,'2017-10-08',1.76,130,100,80,40,40,26,26,70,70,45,45);

INSERT INTO peso VALUES
(900090,'2017-10-19',96.42),
(900090,'2017-10-04',88.3),
(900090,'2017-09-18',84.0),
(900090,'2017-09-03',89.6),
(900090,'2017-08-17',82.9),
(900090,'2017-08-02',86.0),
(900090,'2017-07-16',83.7);

#ALUNO - SENHA: 123456
INSERT INTO usuario VALUES 
(900080,'Thaniel Termogênico','fikamaior@g1/2.com',1,'e10adc3949ba59abbe56e057f20f883e',0,9,'tem alergia a água');
	INSERT INTO aluno VALUES 
    (900080,'14555203010','m',300030);
    INSERT INTO telefone VALUES
	(900080,'6144855555'),
	(900080,'61996677777'),
	(900080,'61988833333');
    INSERT INTO endereco VALUES
	(900080,'quadra 6 conjunto 28','ap216','guarabireba','64800140','GO','prédio na rua dos correios');
    
#AVALIAÇÃO ALUNO
INSERT INTO avaliacao VALUES 
(900080,'2017-10-08',1.76,130,100,80,40,40,26,26,70,70,45,45);

INSERT INTO peso VALUES
(900080,'2017-10-19',73.2),
(900080,'2017-10-04',78.3),
(900080,'2017-09-18',79.0),
(900080,'2017-09-03',79.6),
(900080,'2017-08-17',77.9),
(900080,'2017-08-02',76.0),
(900080,'2017-07-16',76.7);