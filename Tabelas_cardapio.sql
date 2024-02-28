Create Schema cardapio;
Use cardapio;

Create table usuario(
id int primary key auto_increment,
nome varchar(45),
senha varchar(45));

INSERT INTO usuario (id, nome, senha) VALUES (null, 'admin', '123456');

Create table categoria(
id int primary key auto_increment,
nome_categoria varchar(45),
ordem_categoria int(11),
hi_categoria time,
hf_categoria time,
disponivel_categoria boolean,
ativo_categoria boolean,
imagem_categoria text);

Create table produto(
id int primary key auto_increment,
categoria int,
nome_produto varchar(45),
descricao_produto text,
ordem_produto int(11),
valor_produto float,
hi_produto time,
hf_produto time,
disponivel_produto boolean,
ativo_produto boolean,
imagem_produto text,
foreign key (categoria) references categoria(id) 
ON DELETE CASCADE);

Create table complemento(
id int primary key auto_increment,
nome_complemento varchar(45),
descricao_complemento text,
mins_complemento int,
maxs_complemento int,
tipo_complemento int,
vm_complemento boolean,
data_complemento timestamp);

Create table item(
id int primary key auto_increment,
complemento int,
nome_item varchar(45),
descricao_item text,
valor_item float,
ativo_item boolean,
foreign key (complemento) references complemento(id)
ON DELETE CASCADE);

CREATE TABLE produto_complemento (
id_pc int primary key auto_increment,
produto int,
complemento int,
selecionado boolean,
foreign key (produto) references produto(id) ON DELETE CASCADE,
foreign key (complemento) references complemento(id) ON DELETE CASCADE
);

CREATE TABLE entrega(
id int primary key auto_increment,
nome_entrega varchar(45),
preco_entrega float);

create table produto_carrinho (
id int primary key auto_increment,
imagem_produto_carrinho text,
nome_produto_carrinho varchar(45),
valor_produto_carrinho float,
quantidade_produto_carrinho int);

create table itens_carrinho(
id int primary key auto_increment,
id_produto_carrinho int,
nome_item_carrinho varchar(45),
quantidade_item_carrinho int,
valor_item_carrinho float,
foreign key (id_produto_carrinho) references produto_carrinho(id)
ON DELETE CASCADE);

create table pedido(
id int primary key auto_increment,
valor_compra_pedido float,
metodo_pagamento varchar(45),
metodo_entrega varchar(45),
estado_pedido int);

create table cliente_pedido(
id int primary key auto_increment,
id_pedido int,
nome_cliente_pedido varchar(45),
telefone_cliente_pedido varchar (45),
foreign key (id_pedido) references pedido (id)
ON DELETE CASCADE);

create table endereco_pedido(
id int primary key auto_increment,
id_pedido int,
bairro_endereco_pedido varchar(45),
valor_entrega_pedido float,
rua_endereco_pedido varchar(45),
numero_endereco_pedido int,
referencia_endereco_pedido text,
foreign key (id_pedido) references pedido (id)
ON DELETE CASCADE);

create table cartao_pedido(
id int primary key auto_increment,
id_pedido int, 
tipo_cartao varchar(45),
foreign key (id_pedido) references pedido (id)
ON DELETE CASCADE);

create table dinheiro_pedido(
id int primary key auto_increment,
id_pedido int,
confirmacao_troco varchar(11),
troco float,
foreign key (id_pedido) references pedido (id)
ON DELETE CASCADE);

create table produtos_pedido(
id int primary key auto_increment,
id_pedido int,
nome_produto_pedido varchar(45),
quantidade_produto_pedido int,
foreign key (id_pedido) references pedido (id)
ON DELETE CASCADE);

create table itens_pedido(
id int primary key auto_increment,
id_produto int,
nome_item_pedido varchar(45),
quantidade_item_pedido int,
foreign key (id_produto) references produtos_pedido (id)
ON DELETE CASCADE);

create table pedidos_relatorio(
id int primary key auto_increment,
valor_compra_relatorio float,
tipo_entrega_relatorio varchar(11),
valor_entrega_relatorio float,
tempo_finalizado timestamp);

create table clientes_relatorio(
id int primary key auto_increment,
id_pedido_relatorio int,
nome_cliente_relatorio varchar(45),
telefone_cliente_relatorio varchar(45),
foreign key (id_pedido_relatorio) references pedidos_relatorio (id));

create table endereco_cliente_relatorio(
id int primary key auto_increment,
id_cliente_relatorio int,
rua_cliente_relatorio varchar(45),
numero_endereco_relatorio int,
bairro_cliente_relatorio varchar(45),
foreign key (id_cliente_relatorio) references clientes_relatorio (id));

create table produtos_relatorio(
id int primary key auto_increment,
id_pedido_relatorio int,
nome_produto_relatorio varchar(45),
quantidade_produto_relatorio int,
foreign key (id_pedido_relatorio) references pedidos_relatorio (id));









