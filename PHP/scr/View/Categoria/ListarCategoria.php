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
                    <li class="nav__superior"><a href="/"><i class="fa-solid fa-chart-simple"></i>
                            &nbspDashboard</a>
                    </li>
                    <li class="nav__superior"></i><a href="/transacoes"><i
                                class="fa-solid fa-arrow-right-arrow-left"></i> &nbspTransações</a></li>
                    <li class="nav__superior selecionado"><a href="/categorias"><i class="fa-solid fa-tags"></i>
                            &nbspCategorias</a>
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

        <section class="corpo categorias">


            <div class="header-categorias">
                <h2>Listagem Categorias</h2>
                <a href="/criar-categoria" class="nova-transacao"><i class="fa-solid fa-plus"></i> Nova
                    Categoria</a><br>
            </div>
            <div class="tabelas-categorias">
                <div class="lista-categorias">
                    <div>
                        <h4>Despesas</h4>
                    </div>
                    <div class="tabela-despesas table-lista">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome Categoria</th>
                                    <th colspan=>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categorias)): ?>

                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php if ($categoria['tipo'] == 'Despesa'): ?>
                                            <tr>
                                                <td><?= $categoria['nome'] ?></td>
                                                <td>
                                                    <?php if ($categoria['id'] != 1 && $categoria['id'] != 2): ?>
                                                        <a href="editar-categoria?id=<?= $categoria['id'] ?>"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="deletar-categoria?id=<?= $categoria['id'] ?>"> <i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                    <?php else: ?>
                                                        <i class="fa-solid fa-thumbtack"></i>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>


                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">Nenhuma categoria de despesa registrada</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="lista-categorias">
                    <div>
                        <h4>Receitas</h4>
                    </div>

                    <div class="tabela-receitas table-lista">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categorias)): ?>

                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php if ($categoria['tipo'] == 'Receita'): ?>
                                            <tr>
                                                <td><?= $categoria['nome'] ?></td>
                                                <td>
                                                    <?php if ($categoria['id'] != 1 && $categoria['id'] != 2): ?>
                                                        <a href="editar-categoria?id=<?= $categoria['id'] ?>"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="deletar-categoria?id=<?= $categoria['id'] ?>"> <i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                    <?php else: ?>
                                                        <i class="fa-solid fa-thumbtack"></i>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>


                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">Nenhuma categoria de receita registrada</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


        </section>
    </main>

</body>

</html>