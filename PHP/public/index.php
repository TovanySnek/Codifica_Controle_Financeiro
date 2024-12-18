<?php


require __DIR__ . '/../vendor/autoload.php';  

session_start();

use App\Controller\Controller;


$controller = new Controller();


$caminho = rtrim(string: strtok(string: $_SERVER['REQUEST_URI'], token: '?'), characters: '/') ?: '/';

if (!isset($_SESSION['usuario_id']) && $page !== '/autenticacao/login' && $page !== '/autenticacao/registro' && $page !== '/autenticacao/registro/registrar' && $page !== '/autenticacao/login/validar') {
    header(header: 'Location: /autenticacao/login');
    exit;
}

if ($caminho == '/dashboard') {    
    return $controller->dashboard();
}
if ($caminho == '/sessao/login') {
    return $controller->login();
}
if ($caminho == '/sessao/logout') {
    return $controller->logout();
}
if ($caminho == '/sessao/autenticar') {
    return $controller->autenticarLogin(email: $_POST['email'], senha: $_POST['senha']);;
}
if ($caminho == '/sessao/registro') {
    return $controller->registro();
}
if ($caminho == '/produtos/atualizar') {
    return $controller->atualizar();
}
if ($caminho == '/sessao/registro/registrar') {
    return $controller->registrarUsuario(nome: $_POST['nome'], email: $_POST['email'], senha: $_POST['senha']);
}
if ($caminho == '/transacao/adicionar') {
    return $controller->adicionarTransacao();
}
if ($caminho == '/transacao/adicionar/salvar') {
    return $controller->salvarTransacao(tipo: $_POST['tipo'], categoriaNome: $_POST['categoriaNome'], descricao: $_POST['descricao'], valor: $_POST['valor'], data: $_POST['data']);
}
if ($caminho == '/transacao/editar') {
    return $controller->editarTransacao(transacaoId: $_GET['transacaoId']);
}
if ($caminho == '/transacao/editar/atualizar') {
    return $controller->editarTransacao(categoriaId: $_POST['categoriaId'], transacaoId: $_POST['transacaoId']);
}
if ($caminho == '/transacao/deletar') {
    return $controller->deletarTransacao(transacaoId: $_POST['transacaoId']);
}
if ($caminho == '/categorias') {
    return $controller->categorias();
}
if ($caminho == '/categoria/salvar') {
    return $controller->salvarCategoria(categoriaNome: $_POST['categoriaNome']);
}
if ($caminho == '/categoria/deletar') {
    return $controller->deletarCategoria(categoriaId: $_POST['categoriaId']);
}
if ($caminho == '/categoria/editar') {
    return $controller->editarCategoria(categoriaNome: $_POST['categoriaNome'], editarCategoriaId: $_POST['editarCategoriaId']);
}

echo "Página não encontrada :(";
header('Location: /dashboard');



?>