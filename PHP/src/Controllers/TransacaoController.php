<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\CategoriaModel;

class TransacaoController 
{
    private TransacaoModel $transacaoModel;
    private CategoriaModel $categoriaModel;

    public function __construct() {
        $this->transacaoModel = new TransacaoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function listarTransacoes() {

        $filtros = [
            'dataInicio' => isset($_GET['dataInicio']) ? $_GET['dataInicio'] : date('Y-m-01'),
            'dataFim' => isset($_GET['dataFim']) ? $_GET['dataFim'] : date('Y-m-t'),
            'entrada' => isset($_GET['entrada']) ? $_GET['entrada'] : 'Todos',
            'categoria' => isset($_GET['categoria']) ? $_GET['categoria'] : 'Todos',
            'busca' => isset($_GET['busca']) ? $_GET['busca'] : ''
        ];


        $dadosGerais = $this->transacaoModel->dadosGeraisComFiltro($filtros);
        $transacoes = $this->transacaoModel->buscarComFiltros($filtros);
        $categorias = $this->categoriaModel->listar();
        require __DIR__ . '/../View/Transacao/Listar_Transacao.php';
    }

    public function definirTipoTransacao() {
        require __DIR__ . '/../Views/Transacoes/definir_tipo_transacao.php';
    }

    public function criarTransacao() {
        //$tipo = $_POST['tipo'];

       // if ($tipo) {
       //     $categorias = $this->categoriaModel->listarPorTipo($tipo);
       //     require __DIR__ . '/../Views/Transacoes/formulario_transacao.php';
        //}
        require __DIR__ . '/../View/Transacao/Criar.php';
    }

    public function salvarTransacao() {
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $tipo = $_POST['tipo'];
        $categoriaId = $_POST['categoria_id'];
        $dataTransacao = $_POST['data_transacao'];

        if ($descricao && $valor && $tipo && $categoriaId && $dataTransacao) {
            $this->transacaoModel->salvar($descricao, $valor, $tipo, $categoriaId, $dataTransacao);
        }

        header('Location: /transacoes');
    }

    public function editarTransacao() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($id && is_numeric($id)) {
            $transacao = $this->transacaoModel->buscarPorId($id);
            $tipo = $transacao['tipo'];
            $categorias = $this->categoriaModel->listarPorTipo($tipo);
            require __DIR__ . '/../Views/Transacoes/formulario_transacao.php';
        }
    }

    public function atualizarTransacao() {
        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $tipo = $_POST['tipo'];
        $categoriaId = $_POST['categoria_id'];
        $dataTransacao = $_POST['data_transacao'];

        if ($id && is_numeric($id) && $descricao && $valor && $tipo && $categoriaId && $dataTransacao) {
            $this->transacaoModel->atualizarTransacao($id, $descricao, $valor, $tipo, $categoriaId, $dataTransacao);
        }

        header('Location: /transacoes');
    }

    public function deletarTransacao() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id && is_numeric($id)) {
            $this->transacaoModel->deletarTransacao($id);
        }

        header('Location: /transacoes');
    }
}