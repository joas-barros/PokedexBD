CREATE TABLE Efeito (
	id SERIAL PRIMARY KEY,
	nome varchar(30),
	informacao varchar(200)
);

CREATE TABLE Tipo (
	id SERIAL PRIMARY KEY,
	nome varchar(30),
	cor varchar(8)
);

CREATE TABLE Habilidade (
	id SERIAL PRIMARY KEY,
	nome varchar(30),
	tipo_habilidade int references tipo(id),
	descricao varchar(200),
	efeito_habilidade int references efeito(id)
);
