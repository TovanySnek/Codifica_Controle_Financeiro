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
                    <li class="nav__superior"><a href="/categorias"><i class="fa-solid fa-tags"></i> &nbspCategorias</a></li>
                </ul>
            </nav>
            <nav class="nav__inferior">
                <ul>
                    <!-- <li class="nav__inferior minha-conta"><a class="minha-conta" href="#"><i class="fa-solid fa-user"></i>
                                &nbspMinha Conta</a></li> -->
                    <li class="nav__inferior logout"><a href="/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            &nbspLogout</a></li>
                </ul>
            </nav>
        </div>


    </aside>



    <main>

        <section class="corpo">

            
            <form action="/transacoes" method="GET" class="form-filtros">
                <div class="filtros">
                    <section class="filtro-data">
                        <div>
                            <label for="dataInicio">Data Início:</label>
                            <input type="date" id="dataInicio" name="dataInicio"
                                value="<?= isset($_GET['dataInicio']) ? $_GET['dataInicio'] : date('Y-m-01') ?>">
                        </div>

                        <div>
                            <label for="dataFim">Data Fim:</label>
                            <input type="date" id="dataFim" name="dataFim"
                                value="<?= isset($_GET['dataFim']) ? $_GET['dataFim'] : date('Y-m-t') ?>">
                        </div>
                    </section>


                    <section class="filtro-tipo">
                        <div class="tipo">
                            <label for="entrada">Entrada:</label>
                            <select name="entrada" id="entrada">
                                <option value="Todos" <?= !isset($_GET['entrada']) || $_GET['entrada'] == 'Todos' ? 'selected' : '' ?>>Todos</option>
                                <option value="Receita" <?= isset($_GET['entrada']) && $_GET['entrada'] == 'Receita' ? 'selected' : '' ?>>Receita</option>
                                <option value="Despesa" <?= isset($_GET['entrada']) && $_GET['entrada'] == 'Despesa' ? 'selected' : '' ?>>Despesa</option>
                            </select>
                        </div>


                        <div class="categoria">
                            <label for="categoria">Categoria:</label>
                            <select id="categoria" name="categoria">
                                <option value="Todos" <?= !isset($_GET['categoria']) || $_GET['categoria'] == 'Todos' ? 'selected' : '' ?>>Todos</option>


                                <option value="" disabled>--- Categorias despesa ---</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <?php if ($categoria['tipo'] == 'Despesa'): ?>
                                        <option value="<?= $categoria['id'] ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id'] ? 'selected' : '' ?>>
                                            <?= $categoria['nome'] ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>


                                <option value="" disabled>--- Categorias receita ---</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <?php if ($categoria['tipo'] == 'Receita'): ?>
                                        <option value="<?= $categoria['id'] ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id'] ? 'selected' : '' ?>>
                                            <?= $categoria['nome'] ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </section>

                    <section class="filtro-botoes">
                        <div class="busca">
                            <label for="busca">Busca:</label>
                            <input type="text" id="busca" name="busca"class="busca"
                                value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
                        </div>

                        <div class="botoes-filtro">
                            <button type="submit" class="filtrar">Filtrar</button>
                            <a href="/transacoes" class="reset"><i class="fa-solid fa-arrow-rotate-right"></i></a>
                        </div>
                    </section>
                </div>                        
            
            


            <div class="dados-gerais">
                <div>
                    <label for="receitas"><span class="mais">( + )</span> &nbspRECEITAS</label> 
                    <p>R$ <?= number_format($dadosGerais['receitasTotais'], 2, ',', '.') ?></p> 
                </div>
                <div>
                    <label for="despesas"><span class="menos">( - )</span> &nbspDESPESAS</label> 
                    <p>R$ <?= number_format($dadosGerais['despesasTotais'], 2, ',', '.') ?></p> 
                </div>
                <div>
                    <label for="total"><span class="igual">( = )</span> &nbspTOTAL</label> 
                    <p>R$ <?= number_format($dadosGerais['total'], 2, ',', '.') ?></p>                                
                </div>
            </div>                            

            <div class="titulo-transacoes">
                <h3>Transações</h3>
                <div class="nova-transacao-div">
                    <a href="/criar-transacao" class="nova-transacao"><i class="fa-solid fa-plus"></i> Nova Transação</a>
                </div>
                
            </div>
            </form>                            
            <div class="table-lista">
            <table>
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transacoes)): ?>
                        <?php foreach ($transacoes as $transacao): ?>
                            <tr>
                                <!-- <td><?= $transacao['id'] ?></td> -->
                                <td style="color: <?= $transacao['tipo'] == 'Receita' ? 'var(--cor-receita)' : 'red' ?>">
                                    <?= $transacao['tipo'] ?>
                                </td>
                                <td><?= $transacao['descricao'] ?></td>
                                <td>R$ <?= number_format($transacao['valor'], 2, ',', '.') ?></td>
                                <td><?= $transacao['categoria_nome'] ?></td>
                                <td><?= date('d-m-Y', strtotime($transacao['data_transacao'])) ?></td>
                                <td class="botoes-acao">
                                    <a href="/editar-transacao?id=<?= $transacao['id'] ?>"> <i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a href="/deletar-transacao?id=<?= $transacao['id'] ?>" onclick="return confirmarExclusao();"> <i class="fa-solid fa-trash-can"></i> </a>

                                    <script>
                                        function confirmarExclusao() {
                                            return confirm("Você tem certeza que deseja excluir esta transação?");
                                        }
                                    </script>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Nenhuma transação encontrada</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>

        </section>
    </main>

</body>

</html>