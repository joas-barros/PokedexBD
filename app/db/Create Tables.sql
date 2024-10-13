CREATE TABLE TIPO(
Tipo_ID Serial PRIMARY KEY,
Tipo_Nome Text,
Cor Text NOT NULL
);

insert into tipo (Tipo_Nome, Cor) values ('fogo', '#FF0000');
select * from tipo;

CREATE TABLE FRAQUEZAS(
Fraquezas_ID Int NOT NULL,
Fraquezas_A_TIPO_ID INT NOT NULL,
CONSTRAINT FK_FRAQUEZAS_ID FOREIGN KEY(Fraquezas_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
CONSTRAINT FK_FRAQUEZAS_A_TIPO_ID FOREIGN KEY(FRAQUEZAS_A_TIPO_ID) REFERENCES TIPO(TIPO_ID) ON DELETE RESTRICT ON UPDATE CASCADE,
PRIMARY KEY(Fraquezas_ID,Fraquezas_A_TIPO_ID)
);

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

select * from pokedex INNER JOIN tipo as t1 ON pokedex.Pokedex_Tipo_1 = t1.Tipo_ID INNER JOIN tipo as t2 ON pokedex.Pokedex_Tipo_2 = t2.Tipo_ID;

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
		p.pokemon_id,
        p.pokemon_nome,
        h1.habilidade_id as habilidade1_id,
        h1.habilidade_nome as habilidade1_nome,
        h1.habilidade_descricao as habilidade1_descricao,
        h1.habilidade_efeito as habilidade1_efeito,
        h1.habilidade_tipo as habilidade1_tipo,
        h2.habilidade_id as habilidade2_id,
        h2.habilidade_nome as habilidade2_nome,
        h2.habilidade_descricao as habilidade2_descricao,
        h2.habilidade_efeito as habilidade2_efeito,
        h2.habilidade_tipo as habilidade2_tipo,
        h3.habilidade_id as habilidade3_id,
        h3.habilidade_nome as habilidade3_nome,
        h3.habilidade_descricao as habilidade3_descricao,
        h3.habilidade_efeito as habilidade3_efeito,
        h3.habilidade_tipo as habilidade3_tipo,
        h4.habilidade_id as habilidade4_id,
        h4.habilidade_nome as habilidade4_nome,
        h4.habilidade_descricao as habilidade4_descricao,
        h4.habilidade_efeito as habilidade4_efeito,
        h4.habilidade_tipo as habilidade4_tipo,
        p.Pokemon_level_min,
        p.Pokemon_level_max,
        p.Pokemon_hp_min,
        p.Pokemon_hp_max,
        p.Pokemon_atk_min,
        p.Pokemon_atk_max,
        p.Pokemon_def_min,
        p.Pokemon_def_max,
        p.Pokemon_sp_atk_min,
        p.Pokemon_sp_atk_max,
        p.Pokemon_sp_def_min,
        p.Pokemon_sp_def_max,
        p.Pokemon_velocidade_min,
        p.Pokemon_velocidade_max,
        p.Pokemon_sexo,
        p.Pokemon_altura,
        p.Pokemon_peso,
        p.pokemon_img from pokemon as p
		inner join habilidade h1 on p.Pokemon_Habilidade_1 = h1.habilidade_id 
        inner join habilidade h2 on p.Pokemon_Habilidade_2 = h2.habilidade_id 
        inner join habilidade h3 on p.Pokemon_Habilidade_3 = h3.habilidade_id 
        inner join habilidade h4 on p.Pokemon_Habilidade_4 = h4.habilidade_id;
	

drop table POKEMON;

CREATE TABLE TREINADOR(
Treinador_ID Serial PRIMARY KEY,
Treinador_Nome Text NOT NULL
);

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

drop table REGISTRO_POKEDEX;

--Tabela para arquivo de log e arquivo PDF
CREATE TABLE CAPTURADOS(
Treinador_Nome Text,
Pokemon_Nome Text,
Data_Captura Date,
Hora_Captura Time
);
