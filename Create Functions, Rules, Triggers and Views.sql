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

--Ao inserir Pokemons na tabela registro_pokedex, insere automaticamente no arquivo de pokemons capturados
CREATE OR REPLACE RULE R1 AS
ON INSERT TO Registro_Pokedex
DO INSERT INTO Capturados VALUES
(retornaNomeTreinador(New.Treinador_Id), retornaNomePokemon(New.Pokemon_Id), now(), now());

--Função para popular tabela de log
CREATE FUNCTION func_log() RETURNS trigger AS $$
BEGIN
INSERT INTO criando_um_log(data, usuario, modificacao)
VALUES (now(), user, TG_OP);
RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

--Trigger para popular tabela de log
CREATE TRIGGER teste_log
AFTER INSERT OR UPDATE OR DELETE ON pokedex
FOR EACH ROW EXECUTE PROCEDURE func_log();