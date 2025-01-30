<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/SQL/ConexaoBD.php';  

use App\Controllers\CategoriaController;
use App\Controllers\TransacaoController;
use App\Controllers\DashboardController;
use App\Controllers\UsuarioController;

$caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!isset($_SESSION['user_id']) && $caminho !== '/login' && $caminho !== '/validar-login' && $caminho !== '/cadastro' && $caminho !== '/criar-conta') {
   header(header: 'Location: /login');
   exit;
}

if ($caminho == '/') {    
    $dashboardController = new DashboardController();
    $dashboardController->exibirDashboard();
}
if ($caminho == '/login') {
    $usuarioController = new UsuarioController();
    $usuarioController->paginaLogin();
}
if ($caminho == '/validar-login') {
    $usuarioController = new UsuarioController();
    $usuarioController->validarLogin();
}
if ($caminho == '/logout') {
    $usuarioController = new UsuarioController();
    $usuarioController->logout();
}
if ($caminho == '/cadastro') {
    $usuarioController = new UsuarioController();
    $usuarioController->paginaCadastro();
}
if ($caminho == '/criar-conta') {
    $usuarioController = new UsuarioController();
    $usuarioController->salvarConta();
}
if ($caminho == '/transacoes') {
    $transacaoController = new TransacaoController();
    $transacaoController->listarTransacoes();
}
if ($caminho == '/criar-transacao') {
    $transacaoController = new TransacaoController();
    $transacaoController->criarTransacao();
}
if ($caminho == '/salvar-transacao') {
    $transacaoController = new TransacaoController();
    $transacaoController->salvarTransacao();
}
if ($caminho == '/editar-transacao') {
    $transacaoController = new TransacaoController();
    $transacaoController->editarTransacao();
}
if ($caminho == '/atualizar-transacao') {
    $transacaoController = new TransacaoController();
    $transacaoController->atualizarTransacao();
}
if ($caminho == '/deletar-transacao') {
    $transacaoController = new TransacaoController();
    $transacaoController->deletarTransacao();   
}
if ($caminho == '/categorias') {
    $categoriaController = new CategoriaController();
    $categoriaController->listarCategorias();
}
if ($caminho == '/criar-categoria') {
    $categoriaController = new CategoriaController();
    $categoriaController->criarCategoria();
}
if ($caminho == '/salvar-categoria') {
    $categoriaController = new CategoriaController();
    $categoriaController->salvarCategoria();
}
if ($caminho == '/atualizar-categoria') {
    $categoriaController = new CategoriaController();
    $categoriaController->atualizarCategoria();
}
if ($caminho == '/deletar-categoria') {
    $categoriaController = new CategoriaController();
    $categoriaController->deletarCategoria($categoria_id);
}
if ($caminho == '/editar-categoria') {
    $categoriaController = new CategoriaController();
    $categoriaController->editarCategoria();
}


