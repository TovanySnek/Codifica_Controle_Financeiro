<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\TransacaoModel;

class CategoriaController 
{

    public function __construct(
    
        private  $categoriaModel = new CategoriaModel(),
        private  $transacaoModel = new TransacaoModel(),

    ){}


    public function listarCategorias()
    {
        $categorias = $this->categoriaModel->listar();
        require __DIR__ . '/../Views/Categorias/listar_categorias.php';
    }

    public function criarCategoria()
    {
        require __DIR__ . '/../Views/Categorias/formulario_categoria.php';
    }

    public function salvarCategoria()
    {
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];

        if ($nome && $tipo) {
            $this->categoriaModel->salvar($nome, $tipo);
        }

        header('Location: /categorias');
    }

    public function editarCategoria()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id && is_numeric($id)) {
            $categoria = $this->categoriaModel->buscarPorId($id);
            require __DIR__ . '/../Views/Categorias/formulario_categoria.php';
        }
    }

    public function atualizarCategoria()
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];

        if ($id && is_numeric($id) && $nome && $tipo) {
            $this->categoriaModel->atualizar($id, $nome, $tipo);
        }

        header('Location: /categorias');
    }


    public function deletarCategoria($id)
    {
        $this->categoriaModel   ->deletarCategoria($id);
        header(header: "location: /categorias");
    }


}