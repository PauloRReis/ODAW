create database site_receitas;

create table usuarios(ID_Usuario integer, nome varchar(100), email varchar(100), senha varchar(100), 
primary key(ID_Usuario));

create table receita(ID_Receita integer, nome_receita varchar(100), modo_de_preparo varchar(5000),
avaliacao double, tempo_de_preparo varchar(40), caminho_imagem varchar(100), ID_Usuario integer,
primary key(ID_Receita), foreign key(ID_Usuario) references usuarios(ID_Usuario));

create table ingredientes(ID_Ingrediente integer, nome_ingrediente varchar(200), primary key(ID_Ingrediente));

create table contem(ID_Receita integer, ID_Ingrediente integer, primary key(ID_Receita, ID_Ingrediente), 
foreign key(ID_Receita) references receitas(ID_Receita), foreign key(ID_Ingrediente) references ingredientes(ID_Ingrediente));

alter table usuarios add sobrenome varchar(100);
alter table contem add quantidade integer;