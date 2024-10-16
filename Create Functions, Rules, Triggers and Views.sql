CREATE OR REPLACE FUNCTION retornaNomePokemon(A int)
RETURNS TEXT AS $retornanomepokemon$
DECLARE
	Nome Text;
BEGIN
	SELECT Pokedex_Nome INTO Nome FROM Pokedex WHERE Pokedex_Num = A;
	RETURN Nome;
END;
$retornanomepokemon$
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION retornaNomeTreinador(A int)
RETURNS TEXT AS $retornaNomeTreinador$
DECLARE
	Nome Text;
BEGIN
	SELECT Treinador_Nome INTO Nome FROM Treinador WHERE Treinador_ID = A;
	RETURN Nome;
END;
$retornaNomeTreinador$
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION kgParaLbs(Peso Float)
RETURNS Float AS $kgParaLbs$
BEGIN
	RETURN peso * 2.20462;
END;
$kgParaLbs$
LANGUAGE 'plpgsql';

--Ao inserir Pokemons na tabela registro_pokedex, insere automaticamente no arquivo de log
CREATE OR REPLACE RULE R1 AS
ON INSERT TO Registro_Pokedex
DO INSERT INTO Capturados_Log VALUES
(retornaNomeTreinador(New.Treinador_Id), retornaNomePokemon(New.Pokemon_Id), now(), now());

CREATE OR REPLACE RULE R2 AS
ON INSERT TO Registro_Pokedex
DO UPDATE Pokedex SET Pokedex_Capturado = TRUE WHERE Pokedex_Num = New.Pokemon_ID;

--Função para popular tabela de log
CREATE OR REPLACE FUNCTION FUNC_LOG()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        INSERT INTO admin_log (operacao, nome_tabela)
        VALUES ('INSERT', TG_TABLE_NAME);
        RETURN NEW;
    ELSIF TG_OP = 'UPDATE' THEN
        INSERT INTO admin_log (operacao, nome_tabela)
        VALUES ('UPDATE', TG_TABLE_NAME);
        RETURN NEW;
    ELSIF TG_OP = 'DELETE' THEN
        INSERT INTO admin_log (operacao, nome_tabela)
        VALUES ('DELETE', TG_TABLE_NAME);
        RETURN OLD;
    END IF;
END;
$$ LANGUAGE plpgsql;

--Trigger para tabela EFEITO
CREATE TRIGGER log_efeito
AFTER INSERT OR UPDATE OR DELETE ON EFEITO
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA TIPO
CREATE TRIGGER log_tipo
AFTER INSERT OR UPDATE OR DELETE ON TIPO
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA EVOLUCAO
CREATE TRIGGER log_evolucao
AFTER INSERT OR UPDATE OR DELETE ON EVOLUCAO
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA FRAQUEZAS
CREATE TRIGGER log_fraquezas
AFTER INSERT OR UPDATE OR DELETE ON FRAQUEZAS
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA HABILIDADE
CREATE TRIGGER log_habilidade
AFTER INSERT OR UPDATE OR DELETE ON HABILIDADE_PASSIVA
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA POKEDEX
CREATE TRIGGER log_pokedex
AFTER INSERT OR UPDATE OR DELETE ON POKEDEX
FOR EACH ROW EXECUTE FUNCTION func_log();

--TRIGGER PARA TABELA POKEMON
CREATE TRIGGER log_pokedmon
AFTER INSERT OR UPDATE OR DELETE ON POKEDEX
FOR EACH ROW EXECUTE FUNCTION func_log();

--FUNÇÃO PARA SORTEAR HP RANDOM
CREATE OR REPLACE FUNCTION gerar_HP (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_HP_Min, Pokemon_HP_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR ATAQUE RANDOM
CREATE OR REPLACE FUNCTION gerar_Ataque (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_Atk_Min, Pokemon_Atk_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR DEFESA RANDOM
CREATE OR REPLACE FUNCTION gerar_Defesa (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_Def_Min, Pokemon_Def_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR SP_ATK RANDOM
CREATE OR REPLACE FUNCTION gerar_Sp_Atk (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_SP_Atk_Min, Pokemon_SP_Atk_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR SP_Def RANDOM
CREATE OR REPLACE FUNCTION gerar_Sp_Def (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_SP_Def_Min, Pokemon_SP_Def_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR Velocidade RANDOM
CREATE OR REPLACE FUNCTION gerar_Velocidade (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_Velocidade_Min, Pokemon_Velocidade_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO PARA SORTEAR Level RANDOM
CREATE OR REPLACE FUNCTION gerar_Level (Num Int)
RETURNS Int AS $$
DECLARE 
Val_Min Int;
Val_Max Int;
BEGIN
SELECT Pokemon_Level_Min, Pokemon_Level_Max INTO Val_Min, Val_Max FROM Pokemon WHERE Pokemon_ID = Num;
RETURN (RANDOM() * (Val_Max - Val_Min)) + Val_Min;
END;
$$ LANGUAGE 'plpgsql';

--FUNÇÃO DO GATILHO PARA PREENCHER A TABELA REGISTRO_POKEDEX
CREATE OR REPLACE FUNCTION PREENCHER_REGISTRO_POKEDEX()
RETURNS TRIGGER AS $$
BEGIN

    -- Preenche os campos na nova linha
    NEW.Pokemon_Data_Captura := CURRENT_DATE;
    NEW.Pokemon_Hp := gerar_hp(NEW.Pokemon_ID);
    NEW.Pokemon_Atk := gerar_ataque(NEW.Pokemon_ID);
    NEW.Pokemon_Def := gerar_defesa(NEW.Pokemon_ID);
    NEW.Pokemon_SP_Atk := gerar_sp_atk(NEW.Pokemon_ID);
    NEW.Pokemon_SP_Def := gerar_sp_def(NEW.Pokemon_ID);
    NEW.Pokemon_Velocidade := gerar_velocidade(NEW.Pokemon_ID);
    NEW.Pokemon_Level := gerar_level(NEW.Pokemon_ID);

    RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

--TRIGGER PARA PREENCHER A TABELA REGISTRO_POKEDEX
CREATE TRIGGER TRIGGER_REGISTRO_POKEDEX
BEFORE INSERT ON REGISTRO_POKEDEX
FOR EACH ROW EXECUTE FUNCTION PREENCHER_REGISTRO_POKEDEX();

--Criando VIEW Para Ver os Pokemons Instanciados
CREATE VIEW Capturados AS (
    SELECT 
        A.Pokemon_ID AS Numero,
        E.Pokemon_Nome AS Nome,
        E.Pokemon_Habilidade_1 AS Passiva1,
        E.Pokemon_Habilidade_2 AS Passiva2,
        E.Pokemon_Habilidade_3 AS Passiva3,
        E.Pokemon_Habilidade_4 AS Passiva4,
        A.Pokemon_Hp AS HP,
        A.Pokemon_Atk AS Ataque,
        A.Pokemon_Def AS Defesa,
        A.Pokemon_Sp_Atk AS SP_Ataque,
        A.Pokemon_Sp_Def AS SP_Defesa,
        A.Pokemon_Velocidade AS VELOCIDADE,
        A.Pokemon_Level AS Nivel,
        E.Pokemon_Sexo AS Sexo,
        E.Pokemon_Altura AS Altura,
        E.Pokemon_Peso AS Peso_em_KG,
        KGPARALBS(E.Pokemon_Peso) AS Peso_em_Libras,
        A.Pokemon_Data_Captura AS Data_Captura
    FROM 
        Registro_Pokedex AS A 
    JOIN 
        Pokemon AS E
    ON 
        A.Pokemon_ID = E.Pokemon_ID
    WHERE 
        A.Pokemon_ID = E.Pokemon_ID
);