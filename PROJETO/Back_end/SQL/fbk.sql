create table Tecido (
    id_tecido int primary key,
    nome_tecido varchar(50) not null,
    cor varchar(20) not null,
    peso_metros float not null,
    composicao varchar(100) not null,
    gramatura float not null,
    fabricante varchar(50) not null
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

);
