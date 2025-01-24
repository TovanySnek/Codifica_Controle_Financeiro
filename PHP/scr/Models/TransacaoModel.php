<?php

namespace App\Models;

use PDO;
use PDOException;
use App\SQL\ConexaoBD;

class TransacaoModel
{
    private PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = ConexaoBD::Conexao();
    }

    public function dadosGeraisComFiltro($filtros)
    {
        $despesasTotais = 0;
        $receitasTotais = 0;

        $transacoes = $this->buscarComFiltros($filtros);

        foreach($transacoes as $transacao) {
            if($transacao['tipo'] == 'Despesa') {
                $despesasTotais += $transacao['valor'];
            }

            if ($transacao['tipo'] == 'Receita') {
                $receitasTotais += $transacao['valor'];
            }
        }

        $total = $receitasTotais - $despesasTotais;

        $dadosGerais = [
            'despesasTotais' => $despesasTotais,
            'receitasTotais' => $receitasTotais,
            'total' => $total
        ];


        return $dadosGerais;
    }    

    public function buscarComFiltros($filtros) {

        $sql = $this->construirConsultaComFiltros($filtros);

        $usuarioId = $_SESSION['user_id'];

        try {
        
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':usuarioId', $usuarioId);
            
            if (isset($filtros['dataInicio']) && !empty($filtros['dataInicio']) && isset($filtros['dataFim']) && !empty($filtros['dataFim'])) {
                $stmt->bindParam(':dataInicio', $filtros['dataInicio']);
                $stmt->bindParam(':dataFim', $filtros['dataFim']);
            }
            if (isset($filtros['entrada']) && $filtros['entrada'] != 'Todos') {
                $stmt->bindParam(':tipo', $filtros['entrada']);
            }
            if (isset($filtros['categoria']) && $filtros['categoria'] != 'Todos') {
                $stmt->bindParam(':categoriaId', $filtros['categoria']);
            }
            if (isset($filtros['busca']) && !empty($filtros['busca'])) {
                $stmt->bindValue(':busca', '%' . $filtros['busca'] . '%');
            }
            // dd($stmt);
    
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar dados: " . $e->getMessage();
            return [];
        }
    }
    

    private function construirConsultaComFiltros($filtros) 
    {
        $sql = 'SELECT 
                transacoes.id,
                transacoes.tipo,
                transacoes.descricao,
                transacoes.valor,
                transacoes.data_transacao,
                transacoes.usuario_id AS usuario_id,
                categorias.id AS categoria_id,
                categorias.nome AS categoria_nome
            FROM 
                transacoes
            LEFT JOIN 
                categorias ON transacoes.categoria_id = categorias.id
            WHERE transacoes.usuario_id = :usuarioId';

        if (isset($filtros['dataInicio']) && !empty($filtros['dataInicio']) && isset($filtros['dataFim']) && !empty($filtros['dataFim'])) {
            $sql .= ' AND transacoes.data_transacao BETWEEN :dataInicio AND :dataFim';
        }

        if (isset($filtros['entrada']) && $filtros['entrada'] != 'Todos') {
            $sql .= ' AND transacoes.tipo = :tipo';
        }

        if (isset($filtros['categoria']) && $filtros['categoria'] != 'Todos') {
            $sql .= ' AND transacoes.categoria_id = :categoriaId';
        }

        if (isset($filtros['busca']) && !empty($filtros['busca'])) {
            $sql .= ' AND transacoes.descricao LIKE :busca';
        }

        $sql .= ' ORDER BY data_transacao DESC';

        return $sql;
    }  


    public function salvar($descricao, $valor, $tipo, $categoriaId, $dataTransacao)
    {
        $sql = "INSERT INTO transacoes (descricao, valor, tipo, categoria_id, data_transacao, usuario_id) VALUES (:descricao, :valor, :tipo, :categoria_id, :data_transacao, :usuario_id)";

        $usuarioId = $_SESSION['user_id'];

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':categoria_id', $categoriaId);
            $stmt->bindParam(':data_transacao', $dataTransacao);
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao salvar transação: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId($id)
    {
        $sql = 'SELECT * FROM transacoes WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar transação: " . $e->getMessage();
            return null;
        }
    }

    public function buscarPorCategoria($categoriaId) 
    {
        $sql = 'SELECT * FROM transacoes WHERE categoria_id = :categoriaId';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':categoriaId', $categoriaId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) { 
            echo "Erro ao buscar transações por categoria: " . $e->getMessage();
            return [];
        }
    }
    

    public function atualizarTransacao($id, $descricao, $valor, $tipo, $categoriaId, $dataTransacao)
    {
        $sql = 'UPDATE transacoes SET descricao = :descricao, valor = :valor, tipo = :tipo, categoria_id = :categoria_id, data_transacao = :data_transacao WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':categoria_id', $categoriaId);
            $stmt->bindParam(':data_transacao', $dataTransacao);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar transação: " . $e->getMessage();
            return false;
        }
    }

        
    public function atualizarCategoriaTransacao($transacaoId, $novaCategoriaId) {
        $sql = 'UPDATE transacoes SET categoria_id = :novaCategoriaId WHERE id = :transacaoId';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':novaCategoriaId', $novaCategoriaId);
            $stmt->bindParam(':transacaoId', $transacaoId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar transação: " . $e->getMessage();
            return false;
        }
        
    }
    

    public function deletarTransacao($id)
    {
        $sql = 'DELETE FROM transacoes WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao deletar transação: " . $e->getMessage();
            return false;
        }
    }
}