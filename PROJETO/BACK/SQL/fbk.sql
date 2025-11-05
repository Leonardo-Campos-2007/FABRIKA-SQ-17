create schema fabrika17;
use fabrika17; 
drop schema fabrika17; 

create table fornecedor (
    id_fornecedor int auto_increment primary key,
    nome varchar(100) not null,
    razao_social varchar(100) not null,
    cnpj varchar(20) not null
);
insert into fornecedor (nome, razao_social, cnpj) values ("teste", "teste", 123456798);
select * from fornecedor; 

create table tecido (
    id_tecido int auto_increment primary key,
    nome_tecido varchar(50) not null,
    cor varchar(20) not null,
    peso_metros float not null,
    composicao varchar(100) not null,
    gramatura float not null,
    id_fornecedor int,
    foreign key (id_fornecedor) references fornecedor(id_fornecedor)
);

create table aviamento (
    id_aviamento int auto_increment primary key,
    nome varchar(40) not null, 
	tamanho float not null, 
    cor varchar(20) not null,
    peso_quantidade float not null,
    composicao varchar(100) not null,
    id_fornecedor int not null, 
    foreign key (id_fornecedor) references fornecedor(id_fornecedor)
);

drop table aviamento; 
select *  from aviamento;
insert into aviamento (nome, cor, peso_quantidade, composicao, tamanho, id_fornecedor) values ("nome", "cor", 3.5, "composicao", 7.2, 1); 

alter table aviamento add column id_fornecedor int not null;
alter table aviamento add constraint foreign key (id_fornecedor) references fornecedor(id_fornecedor); 
alter table aviamento drop column tipo_aviamento; 

create table modelagem (
    id_modelagem int auto_increment primary key,
    tipo_molde varchar(50) not null,
    codigo_molde varchar(20) not null
);
alter table modelagem add column tamanho varchar(8); 

create table beneficiamento (
    id_beneficiamento int auto_increment primary key,
	id_categoria int,
    foreign key (id_categoria) references categoria(id_categoria),    
    descricao varchar(100)
);

create table categoria(
	id_categoria int auto_increment primary key,
    nome varchar(100)
);

select * from categoria; 
insert into aviamento (nome, cor, peso_quantidade, composicao, tamanho, id_fornecedor) values ("nome", "cor", 3.5, "composicao", 7.2, 1); 
insert into categoria (nome) values("Bordado");
drop table beneficiamento; 