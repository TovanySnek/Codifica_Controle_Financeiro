<?php

namespace App\Models;

use PDO;
use PDOException;
use App\SQL\ConexaoBD;

class CategoriaModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = ConexaoBD::Conexao();
    }

    public function listar()
    {
        $usuarioId = $_SESSION['user_id'];
        $sql = 'SELECT * FROM categorias WHERE usuario_id = :usuarioId OR usuario_id = 999 ORDER BY tipo ASC';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar categorias: " . $e->getMessage();
            return [];
        }
    }

    public function listarPorTipo($tipo)
    {
        $usuarioId = $_SESSION['user_id'];
        $sql = 'SELECT * FROM categorias WHERE tipo = :tipo AND usuario_id = :usuarioId OR usuario_id = 999 ORDER BY id ASC';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar categorias por tipo: " . $e->getMessage();
            return [];
        }
    }

    public function buscarPorId($id)
    {
        $sql = 'SELECT * FROM categorias WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao buscar categoria: " . $e->getMessage();
            return [];
        }
    }


    public function deletar($categoria_id)
    {
        $categoria_id = $_GET['id'];
        //$sql = 'DELETE FROM categorias WHERE id = :id';
        try {
            $sql = "DELETE FROM categorias WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $categoria_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao deletar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function salvar($nome, $tipo)
    {
        $usuarioId = $_SESSION['user_id'];
        $sql = "INSERT INTO categorias (nome, tipo, usuario_id) VALUES (:nome, :tipo, :usuarioId)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao salvar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function atualizar($id, $nome, $tipo)
    {
        $sql = 'UPDATE categorias SET nome = :nome, tipo = :tipo WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function novaContaCategorias($id)
    {
        $sql = "INSERT INTO categorias (nome, tipo, usuario_id) VALUES
            ('Alimentação', 'Despesa', ?),
            ('Saúde', 'Despesa', ?),
            ('Educação', 'Despesa', ?),
            ('Outros', 'Despesa', ?),
            ('Salário', 'Receita', ?),
            ('Investimento', 'Receita', ?),
            ('Extra', 'Receita', ?),
            ('Outros', 'Receita', ?)";
    
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id, $id, $id, $id, $id, $id, $id, $id]);
    
            return true;
        } catch (PDOException $e) {
            echo "Erro ao adicionar categorias padrão: " . $e->getMessage();
            return false;
        }}
}