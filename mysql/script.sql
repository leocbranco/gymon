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
    Status_Personal BOOLEAN
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
    ID_Exercicio INT NOT NULL,
    ID_Aluno INT NOT NULL,
    ID_Personal INT NOT NULL,
    Repeticoes VARCHAR(20) NOT NULL,
    CONSTRAINT FK_Exercicio FOREIGN KEY (ID_Exercicio) REFERENCES Exercicios (ID_Exercicio),
    CONSTRAINT FK_Aluno FOREIGN KEY (ID_Aluno) REFERENCES Aluno (ID_Aluno),
    CONSTRAINT FK_Personal FOREIGN KEY (ID_Personal) REFERENCES Personal (ID_Personal)
);

Select * from aluno;
Select * from personal;