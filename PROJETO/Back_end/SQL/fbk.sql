CREATE TABLE Fornecedor (
    fornecedor_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_fornecedor VARCHAR(100) NOT NULL,
    razao_social VARCHAR(100) NOT NULL,
    cnpj VARCHAR(20) NOT NULL
);

CREATE TABLE Tecido (
    tecido_id INT AUTO_INCREMENT PRIMARY KEY,
    nome_tecido VARCHAR(50) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    peso_metros FLOAT NOT NULL,
    composicao VARCHAR(100) NOT NULL,
    gramatura FLOAT NOT NULL,
    fornecedor_id INT,
    FOREIGN KEY (fornecedor_id) REFERENCES Fornecedor(fornecedor_id)
);

CREATE TABLE Aviamento (
    aviamento_id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_aviamento VARCHAR(50) NOT NULL,
    cor VARCHAR(20) NOT NULL,
    peso_quantidade FLOAT NOT NULL,
    composicao VARCHAR(100) NOT NULL
);

CREATE TABLE Modelagem (
    modelagem_id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_molde VARCHAR(50) NOT NULL,
    codigo_molde VARCHAR(20) NOT NULL
);

CREATE TABLE Beneficiamento (
    beneficiamento_id INT AUTO_INCREMENT PRIMARY KEY,
    digital BOOLEAN NOT NULL,
    bordado BOOLEAN NOT NULL,
    sublimacao BOOLEAN NOT NULL,
    serigrafia BOOLEAN NOT NULL
);
