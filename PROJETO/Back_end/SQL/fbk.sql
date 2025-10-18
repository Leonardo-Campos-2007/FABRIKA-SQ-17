create table Tecido (
    tecido_id int primary key,
    nome_tecido varchar(50) not null,
    cor varchar(20) not null,
    peso_metros float not null,
    composicao varchar(100) not null,
    gramatura float not null,
    fornecedor_id int,
    foreign key (fornecedor_id) references Fornecedor(fornecedor_id)
);

create table Aviamento (
    aviamento_id int primary key,
    tipo_aviamento varchar(50) not null,
    cor varchar(20) not null,
    peso_quantidade float not null,
    composicao varchar(100) not null
);

create table Modelagem (
    modelagem_id int primary key,
    tipo_molde varchar(50) not null,
    codigo_molde varchar(20) not null
);

create table Beneficiamento (
    beneficiamento_id int primary key,
    digital boolean not null,
    bordado boolean not null,
    sublimacao boolean not null,
    serigrafia boolean not null
);

create table Fornecedor (
    fornecedor_id int primary key,
    nome_fornecedor varchar(100) not null,
    razao_social varchar(100) not null,
    cnpj varchar(20) not null
);


