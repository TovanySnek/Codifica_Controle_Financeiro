<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($path == '/editar-categoria' && $categoria['usuario_id'] != $_SESSION['user_id']) {
    header('Location: /categorias');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
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
                    <li class="nav__superior "></i><a href="/transacoes"><i
                                class="fa-solid fa-arrow-right-arrow-left"></i> &nbspTransações</a></li>
                    <li class="nav__superior selecionado"><a href="/categorias"><i class="fa-solid fa-tags"></i> &nbspCategorias</a>
                    </li>
                    <li class="nav__superior"><a href="/relatorios"><i class="fa-solid fa-file-lines"></i> &nbspRelatórios</a>
                    </li>
                    <!-- <li class="nav__superior"><a href="#"><i class="fa-solid fa-download"></i>
                            &nbspImportar/Exportar</a></li> -->
                    <li class="nav__superior premium"><a class="premium" href="/premium"><i class="fa-solid fa-crown"></i>
                            &nbsp<?= $_SESSION['user_level'] == 2 ? "Seja " : "Conta " ?>Premium</a></li>
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

        <section class="corpo form-transacao">



            <form action="<?= isset($categoria) ? 'atualizar-categoria' : 'salvar-categoria' ?>" method="POST">

                <div class="botoes-vinculadas definir-tipo">
                    <div>
                        <a class="botao-voltar" href="/categorias"><i class="fa-solid fa-arrow-left"></i></a>
                    </div>
                    <button class="botao-confirmar proximo" type="submit" value="Confirmar">Salvar <i
                            class="fa-solid fa-floppy-disk"></i></button>
                </div>

                <div class="out-form">
                    <div class="corpo-form-transacao">

                        <h1><?= isset($categoria) ? 'Editar' : 'Nova' ?> Categoria</h1><br>

                        <?php if (isset($categoria)): ?>
                            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                            <input type="hidden" name="tipo" value="<?= $categoria['tipo'] ?>">
                        <?php endif; ?>

                        <div class="tipoecategoria">
                            <div class="tipo-form">
                                <label for="tipo">Tipo</label>
                                <select id="tipo" name="tipo" required <?= isset($categoria) ? 'disabled' : '' ?>>
                                    <option value="Despesa" <?= isset($categoria) && $categoria['tipo'] == 'Despesa' ? 'selected' : '' ?>>Despesa</option>
                                    <option value="Receita" <?= isset($categoria) && $categoria['tipo'] == 'Receita' ? 'selected' : '' ?>>Receita</option>
                                </select>
                            </div>

                            <div class="categoria-form">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" value="<?= isset($categoria['nome']) ? $categoria['nome'] : '' ?>"
                                    <?= $categoria['id'] == 1 || $categoria['id'] == 2 ? 'disabled' : '' ?> required>
                            </div>

                        </div>




                    </div>
                </div>



            </form>


        </section>
    </main>

</body>

</html>