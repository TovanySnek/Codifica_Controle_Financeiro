<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($path == '/editar-transacao' && $transacao['usuario_id'] != $_SESSION['user_id']) {
    header('Location: /transacoes');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transações</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>


    <aside>
        <div class="logo">
            <a href="/"><img src="logo.png" class="logo" alt=""></a>
        </div>

        <div class="navegadores">
            <nav class="nav__superior">
                <ul>
                    <li class="nav__superior"><a href="/"><i class="fa-solid fa-chart-simple"></i> &nbspDashboard</a>
                    </li>
                    <li class="nav__superior selecionado"></i><a href="/transacoes"><i
                                class="fa-solid fa-arrow-right-arrow-left"></i> &nbspTransações</a></li>
                    <li class="nav__superior"><a href="/categorias"><i class="fa-solid fa-tags"></i> &nbspCategorias</a>
                    </li>       
                </ul>
            </nav>
            <nav class="nav__inferior">
                <ul>
                    <!-- <li class="nav__inferior minha-conta"><a class="minha-conta" href="#"><i
                                class="fa-solid fa-user"></i>
                            &nbspMinha Conta</a></li> -->
                    <li class="nav__inferior logout"><a href="/logout"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i>
                            &nbspLogout</a></li>
                </ul>
            </nav>
        </div>


    </aside>



    <main>

    <section class="corpo tipo">
            <form action="/salvar-transacao" method="POST">

            <div class="botoes-vinculadas definir-tipo">
                    <div>
                        <a class="botao-voltar" href="/transacoes"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <button class="botao-confirmar proximo" type="submit" value="Confirmar">Salvar <i
                            class="fa-solid fa-floppy-disk"></i></button>
            </div>

            <h1> Nova Transação</h1><br>


                <div class="corpo-tipo">

                    <div class="content__formulario__grupo">
                        <label for="tipo">Tipo</label>
                        <select id="tipo" name="tipo">
                            <option value="Despesa">Despesa</option>
                            <option value="Receita">Receita</option>
                        </select>
                    </div>
                </div>
        


                <div class="out-form">
                    <div class="corpo-form-transacao">

                        <div class="tipoecategoria">

                            <div class="categoria-form">
                                <label for="categoria_id">Categoria</label>
                                <select id="categoria_id" name="categoria_id" required>
                                <option value="nenhuma">Nenhuma</option>
                                <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria->getNome() ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] === $categoria->getNome() ? 'selected' : '' ?>><?= $categoria->getNome() ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>

                        </div>

                        <div class="descricao">
                            <label for="descricao">Descrição</label><br>
                            <input type="text" id="descricao" name="descricao" value="<?= isset($transacao['descricao']) ? $transacao['descricao'] : '' ?>"
                                required>
                        </div>

                        <div class="valoredata">
                            <div class="valor-form">
                                <label for="valor">Valor</label>
                                <input type="number" id="valor" name="valor" step="0.01" value="<?= isset($transacao['valor']) ? $transacao['valor'] : '' ?>"
                                    required>
                            </div>

                            <div class="data-form">
                                <label for="data_transacao">Data</label>
                                <input type="date" id="data_transacao" name="data_transacao"
                                    value="<?= isset($transacao) ? date('Y-m-d', strtotime($transacao['data_transacao'])) : date('Y-m-d') ?>"
                                    required>
                            </div>




                        </div>

                    </div>
                </div>



            </form>


        </section>
    </main>

</body>

</html> 