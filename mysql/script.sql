CREATE DATABASE GYMON;
USE GYMON;
SELECT NOW();

CREATE TABLE Aluno (
    ID_Aluno INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Aluno VARCHAR(100),
    Email_Aluno VARCHAR(100),
    Senha_Aluno VARCHAR(50),
    CPF_Aluno VARCHAR(50),
    DataNasc_Aluno DATE,
    Genero_Aluno VARCHAR(100),
    Altura_Aluno FLOAT,
    Peso_Aluno FLOAT,
    Objetivo_Aluno VARCHAR(500)
);

CREATE TABLE Personal (
    ID_Personal INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Personal VARCHAR(100),
    Email_Personal VARCHAR(100),
    Senha_Personal VARCHAR(50),
    DataNasc_Personal DATE,
    Genero_Personal VARCHAR(100),
    CPF_Personal VARCHAR(50),
    CREF_Personal VARCHAR(50),
    Status_Personal BOOLEAN,
    EhAdmin BOOLEAN DEFAULT FALSE
);

CREATE TABLE Exercicios (
    ID_Exercicio INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Exercicio VARCHAR(100),
    FotoBin MEDIUMBLOB,
    Descricao_Exercicio VARCHAR(500)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE Administrador (
    ID_Adm INT AUTO_INCREMENT PRIMARY KEY,
    Email_Adm VARCHAR(100),
    Senha_Adm VARCHAR(100)
);

CREATE TABLE Treinos (
    ID_Treino INT AUTO_INCREMENT PRIMARY KEY,
    ID_Aluno INT,
    Nome_Treino VARCHAR(255),
    Data_Treino DATE,
    FOREIGN KEY (ID_Aluno) REFERENCES Aluno(ID_Aluno)
);

CREATE TABLE Exercicios_Treino (
    ID_Exercicio_Treino INT AUTO_INCREMENT PRIMARY KEY,
    ID_Treino INT,
    ID_Exercicio INT,
    Repeticoes INT,
    Series INT,
    FOREIGN KEY (ID_Treino) REFERENCES Treinos(ID_Treino),
    FOREIGN KEY (ID_Exercicio) REFERENCES Exercicios(ID_Exercicio)
);

SET SQL_SAFE_UPDATES = 0;
UPDATE Personal SET EhAdmin = TRUE WHERE Email_Personal = 'admin@gmail.com';
SET SQL_SAFE_UPDATES = 1;

SELECT * FROM Personal WHERE Email_Personal = 'admin@gmail.com';
ALTER TABLE Personal ADD COLUMN EhAdmin BOOLEAN DEFAULT FALSE;