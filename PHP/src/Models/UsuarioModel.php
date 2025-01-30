<?php

namespace App\Models;

use PDO;
use PDOException;
use App\SQL\ConexaoBD;


class UsuarioModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = ConexaoBD::Conexao();
    }

    public function realizarLogin($usuario, $senha)
    {
        $usuarioValidado = $this->validarUsuario($usuario);
        $senhaValidada = $this->validarSenha($usuarioValidado, $senha);

        if ($usuarioValidado && $senhaValidada) {
            return $usuarioValidado;
        }

        return false;

    }

    private function validarUsuario($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $usuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar usuário: " . $e->getMessage();
            return null;
        }
    }

    private function validarSenha($usuarioValidado, $senha) 
    {
        $senhaValidada = password_verify($senha, $usuarioValidado['senha']);
        return $senhaValidada;

        //$sql = "SELECT * FROM usuarios WHERE senha = :senha";

        //try {
        //    $stmt = $this->pdo->prepare($sql);
        //    $stmt->bindValue(':email', $senha);
        //    $stmt->execute();

        //    return $stmt->fetch(PDO::FETCH_ASSOC);
        //} catch (PDOException $e) {
        //    echo "Erro ao buscar usuário: " . $e->getMessage();
        //    return null;
        //}
        //$senhaValidada = $senha;
        //return $senhaValidada;
    }

    public function salvar($nome, $email, $senha)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "Erro ao salvar categoria: " . $e->getMessage();
            return false;
        }

    }

    public function retornaId($email)
    {
        $sql = 'SELECT * FROM usuarios WHERE email = :email';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erro ao buscar categoria: " . $e->getMessage();
            return null;
        }
    }

    public function emailExiste($email)
    {
        $sql = "SELECT email FROM usuarios WHERE email = :email";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
        
            return $stmt->fetchColumn();
            
        } catch (PDOException $e) {
            echo "Erro ao validar e-mail: " . $e->getMessage();
            return false;
        }
         

    }

}