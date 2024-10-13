<?php 

require_once 'app/model/repository/impl/RegistroPokedexRepository.php';
require_once 'app/model/repository/impl/PokedexRepository.php';
require_once 'app/model/repository/impl/TreinadorRepository.php';

class RegistroPokedexService {

    private RegistroPokedexRepository $registroPokedexRepository;
    private PokedexRepository $pokedexRepository;
    private TreinadorRepository $treinadorRepository;

    public function __construct(){
        $this->registroPokedexRepository = new RegistroPokedexRepository();
        $this->pokedexRepository = new PokedexRepository();
        $this->treinadorRepository = new TreinadorRepository();
    }

    public function findAll(){
        $registros = $this->registroPokedexRepository->findAll();
        echo json_encode($registros);
    }

    public function findById($id){
        $registro = $this->registroPokedexRepository->findById($id);
        if ($registro){
            echo json_encode($registro);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Registro não encontrado'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['pokemon']) && isset($input['treinador'])){
            $pokemon = $this->pokedexRepository->findById($input['pokemon']);
            $treinador = $this->treinadorRepository->findById($input['treinador']);
            if ($pokemon && $treinador){
                $novoRegistro = new RegistroPokedex($pokemon, $treinador, $dataCaptura = new DateTime(), $hp = 100, $ataque = 100, $defesa = 100, $ataqueEspecial = 100, $defesaEspecial = 100, $velocidade = 100, $nivel = 1);
                if($novoRegistro){
                    $this->registroPokedexRepository->save($novoRegistro);
                    http_response_code(201);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Registro criado com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao criar registro'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Pokemon ou treinador não encontrado'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Parâmetros inválidos'
            ]);
        }
    }

    public function update($id){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['treinador']) && isset($input['hp']) && isset($input['ataque']) && isset($input['defesa']) && isset($input['ataqueEspecial']) && isset($input['defesaEspecial']) && isset($input['velocidade']) && isset($input['nivel'])){
            $pokemon = $this->pokedexRepository->findById($id);
            $treinador = $this->treinadorRepository->findById($input['treinador']);
            if ($pokemon && $treinador){
                $registroAtualizado = new RegistroPokedex($pokemon, $treinador, new DateTime(), $input['hp'], $input['ataque'], $input['defesa'], $input['ataqueEspecial'], $input['defesaEspecial'], $input['velocidade'], $input['nivel']);
                if($registroAtualizado){
                    $registroAtualizado = $this->registroPokedexRepository->update($id, $registroAtualizado);
                    if (!$registroAtualizado){
                        http_response_code(404);
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Registro não encontrado'
                        ]);
                    } else {
                        http_response_code(200);
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Registro atualizado com sucesso'
                        ]);
                    }
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao atualizar registro'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Pokemon ou treinador não encontrado'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Dados incompletos'
            ]);
        }
    }

    public function delete($id){
        $registro = $this->registroPokedexRepository->findById($id);
        if ($registro){
            $this->registroPokedexRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Registro deletado com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Registro não encontrado'
            ]);
        }
    }

    public function respondMethodNotAllowed() {
        http_response_code(405);
        echo json_encode([
            "status" => "error",
            "message" => "Método não permitido."
        ]);
    }

}


?>