<?php 
require_once 'app/model/repository/impl/HabilidadeRepository.php';

require_once 'app/model/entities/Habilidade.php';
require_once 'app/model/entities/Tipo.php';
require_once 'app/model/entities/Efeito.php';

require_once 'app/model/repository/impl/TipoRepository.php';
require_once 'app/model/repository/impl/EfeitoRepository.php';

class HabilidadeService extends AbstractService {
    private HabilidadeRepository $habilidadeRepository;
    private TipoRepository $tipoRepository;
    private EfeitoRepository $efeitoRepository;

    public function __construct(){
        $this->habilidadeRepository = new HabilidadeRepository();
        $this->tipoRepository = new TipoRepository();
        $this->efeitoRepository = new EfeitoRepository();
    }

    public function findAll(){
        $habilidades = $this->habilidadeRepository->findAll();
        echo json_encode($habilidades);
    }

    public function findById($id){
        $habilidade = $this->habilidadeRepository->findById($id);
        if ($habilidade){
            echo json_encode($habilidade);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Habilidade não encontrada'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['descricao']) && isset($input['tipo'])){
            $tipo = $this->tipoRepository->findById($input['tipo']);
            $efeito = $this->efeitoRepository->findById($input['efeito']);
            
            if($tipo && (isset($input['efeito']) ? $efeito : true)){
                $novaHabilidade = new Habilidade(0, $input['nome'], $input['descricao'], $efeito, $tipo);
                $this->habilidadeRepository->save($novaHabilidade);
                http_response_code(201);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Habilidade criada com sucesso'
                    ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tipo ou efeito não encontrado'
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

    public function update(int $id){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['descricao']) && isset($input['tipo'])){
            $tipo = $this->tipoRepository->findById($input['tipo']);
            $efeito = $this->efeitoRepository->findById($input['efeito']);
            
            if($tipo && (isset($input['efeito']) ? $efeito : true)){
                $habilidade = new Habilidade($id, $input['nome'], $input['descricao'], $efeito, $tipo);
                $habilidadeNova = $this->habilidadeRepository->update($id, $habilidade);
                if ($habilidadeNova){
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Habilidade atualizada com sucesso'
                    ]);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Habilidade não encontrada'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tipo ou efeito não encontrado'
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
        $habilidade = $this->habilidadeRepository->findById($id);
        if ($habilidade){
            $this->habilidadeRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Habilidade deletada com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Habilidade não encontrada'
            ]);
        }
    }
    
}

?>