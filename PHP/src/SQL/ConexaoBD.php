<?php

namespace App\SQL;

use PDO;

class ConexaoBD
{
    public static function Conexao(): PDO
    {
        try {
            $conexao = new PDO(
                dsn: 'mysql:host=localhost;dbname=controle_financeiro',
                username: 'root',
                password: '1234'
            );
            $conexao->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
            $conexao->setAttribute(attribute: PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC);

            return $conexao;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}