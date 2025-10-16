create table Tecido (
    id_tecido int primary key,
    largura float not null,
    metragem float not null,
    cor varchar(20) not null,
    descricao varchar(100) not null

);

create table Produto (
    id_produto int primary key,
    tipo varchar(20) not null,
    categoria varchar(20) not null,
    unidade varchar(10) not null,
    sku varchar(20) not null,
    nome varchar(50) not null,
    condicao varchar(20) not null,
    preco float not null,
    formato varchar(20) not null
);

create table Aviamento (
    id_aviamento int primary key,
    cor varchar(20) not null,
    descricao varchar(100) not null,
    quantidade int not null
);

create table Modelagem (
    id_modelagem int primary key,
    descricao varchar(100) not null,
    tamanho float not null,
    nome_modelo varchar(50) not null
);

create table Beneficiamento (
    id_beneficiamento int primary key,
    descricao varchar(100) not null,
    custo_extra float not null,
    tipo_beneficiamento varchar(50) not null
);