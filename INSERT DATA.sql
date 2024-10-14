--INSERINDO DADOS NA TABELA TIPO
INSERT INTO Tipo(Tipo_ID, Tipo_Nome, Cor) VALUES
(1, 'Normal'),
(2, 'Fogo'),
(3, 'Água'),
(4, 'Elétrico'),
(5, 'Planta'),
(6, 'Gelo'),
(7, 'Lutador'),
(8, 'Venenoso'),
(9, 'Terrestre'),
(10, 'Voador'),
(11, 'Psíquico'),
(12, 'Inseto'),
(13, 'Pedra'),
(14, 'Fantasma'),
(15, 'Dragão'),
(16, 'Sombrio'),
(17, 'Aço'),
(18, 'Fada');

--iNSERINDO DADOS NA TABELA FRAQUEZAS
INSERT INTO FRAQUEZAS(Tipo_ID, Fraqueza_1_ID, Fraqueza_2_ID, Fraqueza_3_ID,Fraqueza_4_ID, Fraqueza_5_ID) VALUES 
(1, 7, NULL, NULL, NULL, NULL),
(2, 3, 9, 12, NULL, NULL),
(3, 4, 5, NULL, NULL, NULL),
(4, 9, NULL, NULL, NULL, NULL),
(5, 2, 6, 8 ,10, 12),
(6, 2, 7, 13, 17, NULL),
(7, 10, 11, 18, NULL, NULL),
(8, 5, 9, NULL, NULL, NULL),
(9, 3, 5, 6, NULL, NULL),
(10, 4, 6, 13, NULL, NULL),
(11, 12, 14, 16, NULL, NULL),
(12, 2, 10, 13, NULL, NULL),
(13, 3, 5, 7, 9, 17),
(14, 14, 16, NULL, NULL, NULL),
(15, 6, 15, 18, NULL, NULL),
(16, 7, 12, 18, NULL, NULL),
(17, 2, 7, 9, NULL, NULL),
(18, 8, 17, NULL, NULL, NULL);

INSERT INTO Efeito (Efeito_ID, Efeito_Nome, Efeito_Info) VALUES
(1, 'Burn', ''),
(2, 'Freeze', ''),
(3, 'Frostbite', ''),
(4, 'Paralysis', ),
(5, 'Poison', ''),
(6, 'Sleep', ''),
(7, 'Ability Change', ''),
(8, 'Ability suppression', ''),
(9, 'Type change', ''),
(10, 'Mimic', ''),
(11, 'Substitute', ''),
(12, 'Transformed', ''),
(13, 'Illusion', ''),
(14, 'Bound', ''),
(15, 'Curse', ''),
(16, 'Nightmare', ''),
(17, 'Perish Song', ''),
(18, 'Seeded', ''),
(19, 'Salt Cure', ''),
(20, 'Splinters', ''),
(21, 'Identified', ''),
(22, 'Minimize', ''),
(23, 'Tar Shot', ''),
(24, 'Grounded', ''),
(25, 'Magnetic levitation', ''),
(26, 'Telekinesis', ''),
(27, 'Aqua Ring', ''),
(28, 'Rooting', ''),
(29, 'Laser Focus', ''),
(30, 'Taking Aim', ''),
(31, 'Drowsy', ''),
(32, 'Charged', ''),
(33, 'Stockpile Count', ''),
(34, 'Defense Curl', ''),
(35, 'Primed', ''),
(36, 'Can`t Escape', ),
(37, 'No Retreat', ''),
(38, 'Octolock', ''),
(39, 'Disable', ''),
(40, 'Embargo', ''), 
(41, 'Heal Block', ''),
(42, 'Imprison', ''),
(43, 'Taunt', ''),
(44, 'Throat Chop', ''),
(45, 'Torment', ''),
(46, 'Confusion', ''),
(47, 'Infatuation', ''),
(48, 'Getting Pumped', ''),
(49, 'Guard Split', ''),
(50, 'Power Slit', ''),
(51, 'Speed Swap', ''),
(52, 'Power Trick', ''),
(53, 'Power Boost', ''),
(54, 'Power Drop', ''),
(55, 'Guard Boost', ''),
(56, 'Guard Drop', ''),
(57, 'Critical Hit Boost', ''),
(58, 'Obscured', ''),
(59, 'Force Move', ''),
(60, 'Choice Lock', ''),
(61, 'Encore', ''), 
(62, 'Rampage', ''),
(63, 'Rolling', ''),
(64, 'Making an Uproar', ''),
(65, 'Fixated', ''),
(66, 'Bide', ''),
(67, 'Recharging', ''),
(68, 'Charging Turn', ''),
(69, 'Flinch', ''),
(70, 'Bracing', ''),
(71, 'Center of Attention', ''),
(72, 'Magic Coat', ''),
(73, 'Protection', '');

INSERT INTO Habilidade (Habilidade_ID, Habilidade_Tipo, Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito) VALUES
(1, )

INSERT INTO Pokedex (Pokedex_Num, Pokedex_Nome, Pokedex_Tipo_1, Pokedex_Tipo_2, Pokedex_Taxa_Captura, Pokedex_Info) VALUES 
()

INSERT INTO Evolucao (Anterior, Sucessor) VALUES
()

INSERT INTO Pokemon (Pokemon_ID, Pokedex_Nome, Pokemon_Habilidade_1, Pokemon_Habilidade_2, Pokemon_Habilidade_3, Pokemon_Habilidade_4,
Pokemon_Level_MIN, Pokemon_Level_MAX, Pokemon_HP_MIN, Pokemon_HP_MAX, Pokemon_ATK_MIN, Pokemon_ATK_MAX,
Pokemon_DEF_MIN, Pokemon_DEF_MAX, Pokemon_SP_ATK_MIN, Pokemon_SP_ATK_MAX, Pokemon_SP_DEF_MIN, Pokemon_SP_DEF_MAX,
Pokemon_VELOCIDADE_MIN, Pokemon_VELOCIDADE_MAX, Pokemon_Sexo, Pokemon_Altura, Pokemon_Peso, Pokemon_IMG) VALUES\
()

INSERT INTO Treinador (Treinador_ID, Treinador_Nome) VALUES
()

INSERT INTO Registro_Pokedex (Pokemon_ID, Treinador_ID) VALUES
()

