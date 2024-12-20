<?php

namespace App\Controller;

use App\Repository\{TransacoesRepository, CategoriasRepository, UsuarioRepository};

class Controller
{
    public function __construct(
        private $categoriasRepository = new CategoriasRepository(),
        private $transacoesRepository = new TransacoesRepository(),
        private $usuarioRepository = new UsuarioRepository(),
    ) {}

    public function paginaLogin(): void
    {
        require __DIR__ . "/../view/autenticacao/login.php";
    }

    public function paginaRegistro(): void
    {
        require __DIR__ . "/../view/autenticacao/registro.php";
    }

    public function dashboard(): void
    {
        $transacoes = $this->transacoesRepository->encontrarTodasTransacoesDoMesAtual();

        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'] === 'todos' ?
                null : $_GET['tipo'];
            $mes = $_GET['periodo'] === 'todos' ?
                null : date(format: 'd', timestamp: strtotime(datetime: '01/' . $_GET['periodo']));
            $ano =  $_GET['periodo'] === 'todos' ?
                null : date(format: 'Y', timestamp: strtotime(datetime: '01/' . $_GET['periodo']));
            $categoriaId = $_GET['categoriaNome'] === 'todos' ?
                null : $this->categoriasRepository->encontrarCategoriaPorNome(categoriaNome: $_GET['categoriaNome'])->getId();

            $transacoes = $this->transacoesRepository->encontrarTransacoesFiltradas(mes: $mes, ano: $ano, tipo: $tipo, categoriaId: $categoriaId);
        }
        if (isset($_GET['descricao'])) {
            $transacoes = $this->transacoesRepository->encontrarTransacoesPorDescricao(descricao: $_GET['descricao']);
        }

        $transacoesValoresResumo = $this->transacoesRepository->transacoesValoresResumo(transacoes: $transacoes);
        $periodos = $this->transacoesRepository->buscarPeriodosTransacoes();
        $categorias = $this->categoriasRepository->encontrarTodasCategorias();
        require __DIR__ . "/../view/dashboard.php";
    }

    public function paginaCategorias(): void
    {
        $categorias = $this->categoriasRepository->encontrarTodasCategorias();
        require __DIR__ . "/../view/categorias.php";
    }

    public function paginaAdicionarTransacao(): void
    {
        $categorias = $this->categoriasRepository->encontrarTodasCategorias();
        require __DIR__ . "/../view/transacao/adicionar.php";
    }

    public function paginaEditarTransacao(int $transacaoId): void
    {
        $transacao = $this->transacoesRepository->encontrarTransacaoPorId(transacaoId: $transacaoId);
        $categorias = $this->categoriasRepository->encontrarTodasCategorias();
        require __DIR__ . "/../view/transacao/editar.php";
    }

    public function validarLogin(string $email, string $senha): void
    {
        $dadosUsuario = [
            'id' => null,
            'nome' => null,
            'email' => $email,
            'senha' => $senha
        ];
        $this->usuarioRepository->validarLogin(dadosUsuario: $dadosUsuario);
    }

    public function logout(): void
    {
        session_destroy();
        header(header: "location: /autenticacao/login");
    }

    public function registrarUsuario(string $nome, string $email, string $senha): void
    {
        $dadosUsuario = [
            'id' => null,
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash(password: $senha, algo: PASSWORD_DEFAULT)
        ];
        $this->usuarioRepository->registrarUsuario(dadosUsuario: $dadosUsuario);
        header(header: "location: /autenticacao/login");
    }

    public function deletarTransacao(int $transacaoId): void
    {
        $this->transacoesRepository->deletarTransacao(transacaoId: $transacaoId);
        header(header: "location: /dashboard");
    }

    public function deletarCategoria(int $categoriaId): void
    {
        $this->categoriasRepository->deletarCategoria(categoriaId: $categoriaId);
        header(header: "location: /categorias");
    }

    public function salvarTransacao(string $tipo, string $categoriaNome, string $descricao, float $valor, string $data): void
    {
        $dadosTransacao = [
            'id' => null,
            'tipo' => $tipo,
            'descricao' => $descricao,
            'valor' => $valor,
            'data' => $data,
            'categoria' => $this->categoriasRepository->encontrarCategoriaPorNome(categoriaNome: $categoriaNome)
        ];
        $this->transacoesRepository->salvarTransacao(dadosTransacao: $dadosTransacao);
        header(header: "location: /dashboard");
    }

    public function editarTransacao(int $categoriaId, int $transacaoId): void
    {
        $categoriaId = $categoriaId == 0 ? NULL : $categoriaId;
        $this->transacoesRepository->editarTransacao(categoriaId: $categoriaId, transacaoId: $transacaoId);
        header(header: "location: /dashboard");
    }

    public function salvarCategoria(string $categoriaNome): void
    {
        $this->categoriasRepository->salvarCategoria(categoriaNome: $categoriaNome);
        header(header: "location: /categorias");
    }

    public function editarCategoria(string $categoriaNome, int $editarCategoriaId): void
    {
        $this->categoriasRepository->editarCategoria(categoriaNome: $categoriaNome, editarCategoriaId: $editarCategoriaId);
        header(header: "location: /categorias");
    }
}