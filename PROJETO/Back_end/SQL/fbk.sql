create table Tecido (
    id_tecido int primary key,
    nome_tecido varchar(50) not null,
    cor varchar(20) not null,
    peso_metros float not null,
    composicao varchar(100) not null,
    gramatura float not null,
    Fornecedor_id_fornecedor int,
    foreign key (Fornecedor_id_fornecedor) references Fornecedor(id_fornecedor)
    
);

create table Aviamento (
    id_aviamento int primary key,
    tipo_aviamento varchar(50) not null,
    cor varchar(20) not null,
    peso_quantidade float not null,
    composicao varchar(100) not null,
    fabricante varchar(50) not null
);

create table Modelagem (
    id_modelagem int primary key,
    tipo_molde varchar(50) not null,
    Codigo_molde varchar(20) not null,
);

create table Beneficiamento (
    id_beneficiamento int primary key,
    digital boolean not null,
    bordado boolean not null,
    sublimacao boolean not null,
    serigrafia boolean not null
);

create table Fornecedor (
    id_fornecedor int primary key,
    nome_fornecedor varchar(100) not null,
    razao_social varchar(100) not null,
    cnpj varchar(20) not null
);


