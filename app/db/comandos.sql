CREATE TABLE Efeito (
	id_efeito SERIAL PRIMARY KEY,
	nome_efeito varchar(30),
	informacao_efeito varchar(200)
);

CREATE TABLE Tipo (
	id_tipo SERIAL PRIMARY KEY,
	nome_tipo varchar(30),
	cor_tipo varchar(8)
);

CREATE TABLE Habilidade (
	id_habilidade SERIAL PRIMARY KEY,
	nome_habilidade varchar(30),
	tipo_habilidade int references tipo(id_tipo),
	descricao_habilidade varchar(200),
	efeito_habilidade int references efeito(id_efeito)
);

INSERT INTO Efeito (nome_efeito, informacao_efeito) 
	values ('Stun', 'Deixa paralizado');

INSERT INTO Tipo (nome_tipo, cor_tipo)
	values ('Eletrico', '#00FFFF');

INSERT INTO Habilidade (nome_habilidade, tipo_habilidade, descricao_habilidade, efeito_habilidade)
	values('Choque', 1, 'Da choque', 1);

SELECT * FROM habilidade INNER JOIN tipo ON habilidade.tipo_habilidade = tipo.id_tipo INNER JOIN efeito ON habilidade.efeito_habilidade = efeito.id_efeito; 

