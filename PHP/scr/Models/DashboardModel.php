<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Config\ConexaoBD;

class DashboardModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = ConexaoBD::criarConexao();
    }

    public function calcularReceitas() {
        $usuarioId = $_SESSION['user_id'];

        $sql = "SELECT SUM(valor) AS total FROM transacoes WHERE tipo = 'Receita' AND usuario_id = :usuarioId";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($resultado['total']) ? $resultado['total'] : 0;
        } catch (PDOException $e) {
            echo "Erro ao calcular receitas: " . $e->getMessage();
            return 0;
        }
    }

    public function calcularDespesas() {
        $usuarioId = $_SESSION['user_id'];
        
        $sql = "SELECT SUM(valor) AS total FROM transacoes WHERE tipo = 'Despesa' AND usuario_id = :usuarioId";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($resultado['total']) ? $resultado['total'] : 0;
        } catch (PDOException $e) {
            echo "Erro ao calcular despesas: " . $e->getMessage();
            return 0;
        }
    }

    public function maiorReceita() 
    {
        $usuarioId = $_SESSION['user_id'];
        
        $sql = "SELECT valor, descricao FROM transacoes WHERE tipo = 'Receita' AND usuario_id = :usuarioId ORDER BY valor DESC LIMIT 1";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao buscar maior receita: " . $e->getMessage();
            return [];
        }
    }

    public function maiorDespesa() 
    {
        $usuarioId = $_SESSION['user_id'];
        
        $sql = "SELECT valor, descricao FROM transacoes WHERE tipo = 'Despesa' AND usuario_id = :usuarioId ORDER BY valor DESC LIMIT 1";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao buscar maior despesa: " . $e->getMessage();
            return [];
        }
    }

    public function ultimasDespesas()
    {
        $usuarioId = $_SESSION['user_id'];

        $sql = "SELECT transacoes.valor, transacoes.descricao, transacoes.data_transacao, categorias.id AS categoria_id, categorias.nome AS categoria_nome FROM transacoes LEFT JOIN categorias ON transacoes.categoria_id = categorias.id WHERE transacoes.tipo = 'Despesa' AND transacoes.usuario_id = :usuarioId ORDER BY transacoes.data_transacao DESC LIMIT 3";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao buscar ultimas despesas: " . $e->getMessage();
            return [];
        }
    }

    public function ultimasReceitas()
    {
        $usuarioId = $_SESSION['user_id'];

        $sql = "SELECT transacoes.valor, transacoes.descricao, transacoes.data_transacao, categorias.id AS categoria_id, categorias.nome AS categoria_nome FROM transacoes LEFT JOIN categorias ON transacoes.categoria_id = categorias.id WHERE transacoes.tipo = 'Receita' AND transacoes.usuario_id = :usuarioId ORDER BY transacoes.data_transacao DESC LIMIT 3";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
        } catch (PDOException $e) {
            echo "Erro ao buscar ultimas receitas: " . $e->getMessage();
            return [];
        }
    }
}