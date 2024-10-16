CREATE TABLE TIPO(
Tipo_ID Serial PRIMARY KEY,
Tipo_Nome Text,
Cor Text NOT NULL
);

insert into tipo (Tipo_Nome, Cor) values ('fogo', '#FF0000');
select * from tipo;

CREATE TABLE FRAQUEZAS(
Tipo_ID Int NOT NULL PRIMARY KEY,
Fraqueza_1_ID INT NOT NULL,
Fraqueza_2_ID INT,
Fraqueza_3_ID INT,
Fraqueza_4_ID INT,
Fraqueza_5_ID INT,
CONSTRAINT FK_TIPO_ID FOREIGN KEY(Tipo_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZA_1_ID FOREIGN KEY(Fraqueza_1_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZA_2_ID FOREIGN KEY(Fraqueza_2_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZA_3_ID FOREIGN KEY(Fraqueza_3_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZA_4_ID FOREIGN KEY(Fraqueza_4_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZA_5_ID FOREIGN KEY(Fraqueza_5_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE
);

select * from fraquezas;

insert into fraquezas (Tipo_ID, Fraqueza_1_ID) values (1, 2);

select * from tipo;

CREATE TABLE EFEITO (
Efeito_ID Serial PRIMARY KEY,
Efeito_Nome Text,
Efeito_Info Text NOT NULL
);

insert into efeito (efeito_nome, efeito_info) values ('Stun', 'Deixa atordoado');
select * from efeito;

CREATE TABLE HABILIDADE(
Habilidade_ID Serial PRIMARY KEY,
Habilidade_Tipo Int, 
Habilidade_Nome Text,
Habilidade_Descricao Text NOT NULL,
Habilidade_Efeito Int, 
CONSTRAINT FK_TIPO FOREIGN KEY (Habilidade_Tipo) REFERENCES TIPO(Tipo_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_EFEITO FOREIGN KEY (Habilidade_Efeito) REFERENCES EFEITO(Efeito_ID) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO HABILIDADE (Habilidade_Tipo, Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito)
	values (1, 'Barrage', 'Objetos redondos são arremessados no alvo para atingir duas a cinco vezes seguidas.', NULL);

select * from habilidade INNER JOIN tipo ON habilidade.Habilidade_Tipo = tipo.Tipo_ID;

insert into HABILIDADE(Habilidade_Tipo, Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito) values (2, 'Choque do trovão', 'Da um choque e é do trovão', 1);
select * from habilidade;

CREATE TABLE POKEDEX(
Pokedex_Num Serial PRIMARY KEY,
Pokedex_Nome Text NOT NULL,
Pokedex_Tipo_1 Int NOT NULL,
Pokedex_Tipo_2 Int,
Pokedex_Taxa_Captura Float NOT NULL,
Pokedex_Geracao Int NOT NULL,
Pokedex_Info Text NOT NULL,
CONSTRAINT POKEMON_NOME_UNICO UNIQUE (Pokedex_Nome),
CONSTRAINT FK_TIPO_1 FOREIGN KEY (Pokedex_Tipo_1) REFERENCES TIPO (TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_TIPO_2 FOREIGN KEY (Pokedex_Tipo_2) REFERENCES TIPO (TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT CHECK_TAXA_CAPTURA CHECK (Pokedex_Taxa_Captura >=0 AND Pokedex_Taxa_Captura <=100),
CONSTRAINT CHECK_GERACAO CHECK (Pokedex_Geracao > 0 AND Pokedex_Geracao < 10)
);

insert into POKEDEX (Pokedex_Nome, Pokedex_Tipo_1, Pokedex_Tipo_2, Pokedex_Taxa_Captura, Pokedex_Geracao, Pokedex_Info) 
	values ('pokedex', 3, 2, 0.6, 1, 'info'); 

select * from pokedex;

select * from pokedex INNER JOIN tipo as t1 ON pokedex.Pokedex_Tipo_1 = t1.Tipo_ID;

CREATE TABLE EVOLUCAO(
Anterior Int,
Sucessor Int, 
PRIMARY KEY (Anterior, Sucessor),
CONSTRAINT FK_ANTERIOR FOREIGN KEY (Anterior) REFERENCES POKEDEX(Pokedex_Num) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_SUCESSOR FOREIGN KEY (SUCESSOR) REFERENCES POKEDEX(Pokedex_Num) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE POKEMON(
Pokemon_ID Int PRIMARY KEY,
Pokemon_Nome Text NOT NULL,
Pokemon_Habilidade_1 Int NOT NULL,
Pokemon_Habilidade_2 Int,
Pokemon_Habilidade_3 Int,
Pokemon_Habilidade_4 Int,
Pokemon_Level_MIN Int NOT NULL DEFAULT 1,
Pokemon_Level_MAX Int NOT NULL DEFAULT 100,
Pokemon_HP_MIN INT NOT NULL,
Pokemon_HP_MAX INT NOT NULL,
Pokemon_ATK_MIN INT NOT NULL,
Pokemon_ATK_MAX INT NOT NULL,
Pokemon_DEF_MIN INT NOT NULL,
Pokemon_DEF_MAX INT NOT NULL,
Pokemon_SP_ATK_MIN INT NOT NULL,
Pokemon_SP_ATK_MAX INT NOT NULL,
Pokemon_SP_DEF_MIN INT NOT NULL,
Pokemon_SP_DEF_MAX INT NOT NULL,
Pokemon_VELOCIDADE_MIN INT NOT NULL,
Pokemon_VELOCIDADE_MAX INT NOT NULL,
Pokemon_Sexo Char NOT NULL,
Pokemon_Altura Float NOT NULL,
Pokemon_Peso Float NOT NULL,
Pokemon_IMG Text NOT NULL,
CONSTRAINT FK_POKEMON_ID FOREIGN KEY (Pokemon_ID) REFERENCES POKEDEX(POKEDEX_NUM) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_POKEMON_HABILIDADE_1 FOREIGN KEY (Pokemon_Habilidade_1) REFERENCES HABILIDADE(HABILIDADE_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_POKEMON_HABILIDADE_2 FOREIGN KEY (Pokemon_Habilidade_2) REFERENCES HABILIDADE(HABILIDADE_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_POKEMON_HABILIDADE_3 FOREIGN KEY (Pokemon_Habilidade_3) REFERENCES HABILIDADE(HABILIDADE_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_POKEMON_HABILIDADE_4 FOREIGN KEY (Pokemon_Habilidade_4) REFERENCES HABILIDADE(HABILIDADE_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT CHECK_LEVEL CHECK(Pokemon_Level_MIN > 0 AND Pokemon_Level_MAX <= 100),
CONSTRAINT CHECK_STATS CHECK(Pokemon_HP_MIN > 0 AND Pokemon_HP_MAX > 0 AND Pokemon_ATK_MIN > 0 AND Pokemon_ATK_MAX > 0 AND Pokemon_DEF_MIN > 0 AND Pokemon_DEF_MAX > 0 
AND Pokemon_SP_ATK_MIN > 0 AND Pokemon_SP_ATK_MAX > 0 AND Pokemon_SP_DEF_MIN > 0 AND Pokemon_SP_DEF_MAX > 0 AND Pokemon_VELOCIDADE_MIN > 0 AND Pokemon_VELOCIDADE_MAX > 0),
CONSTRAINT CHECK_SEXO CHECK(Pokemon_Sexo = 'M' OR Pokemon_Sexo = 'F'),
CONSTRAINT CHECK_ALTURA CHECK(Pokemon_Altura > 0),
CONSTRAINT CHECK_PESO CHECK(Pokemon_Peso > 0)
);

insert into pokemon 
	(Pokemon_ID,
	Pokemon_Nome,
	Pokemon_Habilidade_1,
	Pokemon_Habilidade_2,
	Pokemon_Habilidade_3,
	Pokemon_Habilidade_4, 
	Pokemon_Level_MIN,
	Pokemon_Level_MAX,
	Pokemon_HP_MIN,
	Pokemon_HP_MAX,
	Pokemon_ATK_MIN,
	Pokemon_ATK_MAX,
	Pokemon_DEF_MIN,
	Pokemon_DEF_MAX,
	Pokemon_SP_ATK_MIN,
	Pokemon_SP_ATK_MAX,
	Pokemon_SP_DEF_MIN,
	Pokemon_SP_DEF_MAX,
	Pokemon_VELOCIDADE_MIN,
	Pokemon_VELOCIDADE_MAX,
	Pokemon_Sexo,
	Pokemon_Altura,
	Pokemon_Peso,
	Pokemon_IMG) values
	(1, 'bulbasaur', 2, 2, 2, 2, 30, 80, 50, 90, 50, 50, 10, 10, 10, 10, 30, 30, 40, 40, 'F', 50, 0.8, 'bulba');

select 
		*
		from pokemon as p
		inner join habilidade h1 on p.Pokemon_Habilidade_1 = h1.habilidade_id;
	
select * from pokemon;

CREATE TABLE TREINADOR(
Treinador_ID Serial PRIMARY KEY,
Treinador_Nome Text NOT NULL
);

CREATE TABLE TREINADOR(
	Treinador_ID Serial PRIMARY KELL,
	Treinador_Nome Text NOT NULL,
	Treinador_Email Text NOT NULL,
	Treinador_Senha Text UNIQUE NOT NULL,
	Treinador_Data_Nascimento Date NOT NULL
);

drop table treinador;

select * from treinador;

CREATE TABLE REGISTRO_POKEDEX(
Pokemon_ID Int PRIMARY KEY,
Treinador_ID Int NOT NULL,
Pokemon_Data_Captura Date,
Pokemon_Hp INT,
Pokemon_Atk INT,
Pokemon_Def INT,
Pokemon_SP_Atk INT,
Pokemon_SP_Def INT,
Pokemon_Velocidade INT,
Pokemon_Level INT,
CONSTRAINT FK_POKEMON_ID FOREIGN KEY(Pokemon_ID) REFERENCES POKEDEX(POKEDEX_NUM) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_TREINADOR_ID FOREIGN KEY(Treinador_ID) REFERENCES TREINADOR(TREINADOR_ID) ON DELETE RESTRICT ON UPDATE CASCADE
);

insert into REGISTRO_POKEDEX (Pokemon_ID, Treinador_ID) values (1, 1);

select * from REGISTRO_POKEDEX;

select * from REGISTRO_POKEDEX 
	INNER JOIN pokedex ON registro_pokedex.pokemon_id = pokedex.pokedex_num 
	INNER JOIN treinador ON registro_pokedex.treinador_id = treinador.treinador_id;

--Tabela para arquivo de log e arquivo PDF
CREATE TABLE CAPTURADOS_LOG(
Treinador_Nome Text,
Pokemon_Nome Text,
Data_Captura Date,
Hora_Captura Time
);

--Tabela usada como arquivo log
CREATE TABLE ADMIN_LOG (
    Id SERIAL PRIMARY KEY,
    Operacao text,
    Nome_tabela text,
    Data_Captura TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

select * from ADMIN_LOG;

select * from treinador;
