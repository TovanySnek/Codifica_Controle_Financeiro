<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\CategoriaModel;

class UsuarioController
{
    private UsuarioModel $usuarioModel;
    private CategoriaModel $categoriaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();    
        $this->categoriaModel = new CategoriaModel();
    }

    public function paginaLogin()
    {
        require __DIR__ . '/../Views/Usuarios/login.php';
        exit;
    }
    public function validarLogin()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuarioValidado = $this->usuarioModel->realizarLogin($email, $senha);

        if($usuarioValidado) {
            unset($_SESSION['loginError']);

            $_SESSION['user_id'] = $usuarioValidado['id'];
            $_SESSION['user_nome'] = $usuarioValidado['nome'];
            $_SESSION['user_email'] = $usuarioValidado['email'];
            $_SESSION['user_level'] = $usuarioValidado['user_level'];
            $_SESSION['login'] = true;


            header('Location: /');
            exit;

        }

        $_SESSION['loginError'] = "** Falha ao logar, verifique suas credenciais";

        $this->paginaLogin();
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function paginaCadastro()
    {
        require __DIR__ . '/../Views/Usuarios/cadastro.php';
        exit;
    }

    public function salvarConta()
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senha2 = $_POST['senha2'];
    
        if (!$this->senhasIguais($senha, $senha2)) {
            $_SESSION['cadastroError'] = "** As senhas não são iguais";
            header('Location: /cadastro');
            exit;
        }
    
        if ($this->usuarioModel->emailExiste($email)) {
            $_SESSION['cadastroError'] = "** O e-mail já está em uso";
            header('Location: /cadastro');
            exit;
        }
    
        unset($_SESSION['cadastroError']);
    
        $senhaComHash = password_hash($senha, PASSWORD_DEFAULT);
    
        $this->usuarioModel->salvar($nome, $email, $senhaComHash);
    
        $usuario = $this->usuarioModel->retornaId($email);
    
        $this->categoriaModel->novaContaCategorias($usuario['id']);

        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_level'] = $usuario['user_level'];
        $_SESSION['login'] = true;

        header('Location: /');
        exit;
    }

    
    private function senhasIguais($senha1, $senha2)
    {
        return $senha1 === $senha2;
    }
}