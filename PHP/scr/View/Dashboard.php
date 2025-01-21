<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <a href="/s"><img src="logo.png" class="logo" alt=""></a>
        </div>

        <div class="navegadores">
            <nav class="nav__superior">
                <ul>
                    <li class="nav__superior selecionado"><a href="/"><i class="fa-solid fa-chart-simple"></i>
                            &nbspDashboard</a>
                    </li>
                    <li class="nav__superior "><a href="/transacoes"><i class="fa-solid fa-arrow-right-arrow-left"></i>
                            &nbspTransações</a></li>
                    <li class="nav__superior "><a href="/categorias"><i class="fa-solid fa-tags"></i>
                            &nbspCategorias</a>
                    </li>
                    <li class="nav__superior"><a href="/relatorios"><i class="fa-solid fa-file-lines"></i>
                            &nbspRelatórios</a>
                    </li>
                    <!-- <li class="nav__superior"><a href="#"><i class="fa-solid fa-download"></i>
                            &nbspImportar/Exportar</a></li> -->
                    <li class="nav__superior premium"><a class="premium" href="/premium"><i
                                class="fa-solid fa-crown"></i>
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

        <section class="corpo dashboard">
            <div class="dash-superior">
                <div class="superior-1">
                    <div class="dash-totais">
                        <label for="receitas"><span class="mais">( + )</span> &nbspRECEITAS TOTAIS</label>
                        <p>R$ <?= number_format($receitaTotal, 2, ',', '.') ?></p>
                    </div>
                    <div class="dash-totais">
                        <label for="despesas"><span class="menos">( - )</span> &nbspDESPESAS TOTAIS</label>
                        <p>R$ <?= number_format($despesaTotal, 2, ',', '.') ?></p>
                    </div>
                    <div class="dash-totais">
                        <label for="total"><span class="igual">( = )</span> &nbspTOTAL GERAL</label>
                        <p>R$ <?= number_format($saldoTotal, 2, ',', '.') ?></p>
                    </div>


                </div>

                <div class="superior-2">
                    <h3>Últimas despesas <span class="menos">▼</span></h3>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="bloco-transacoes">
                            <?php if (!isset($ultimasDespesas[$i])): ?>
                                <div class="transacao-nome">
                                    Nenhuma transação encontrada
                                </div>
                            <?php else: ?>
                                <div class="transacao-unitaria-esquerda">
                                    <div class="transacao-nome">
                                        <?= $ultimasDespesas[$i]['descricao'] ?>
                                    </div>
                                </div>
                                <div class="transacao-unitaria-direita">
                                    <div>
                                        R$ <?= number_format($ultimasDespesas[$i]['valor'], 2, ',', '.') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <div class="superior-3">
                    <h3>Últimas receitas <span class="mais">▲</span></h3>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="bloco-transacoes">
                            <?php if (!isset($ultimasReceitas[$i])): ?>
                                <div class="transacao-nome">Nenhuma transação encontrada</div>
                            <?php else: ?>
                                <div class="transacao-unitaria-esquerda">
                                    <div class="transacao-nome">
                                        <?= $ultimasReceitas[$i]['descricao'] ?>
                                    </div>
                                </div>
                                <div class="transacao-unitaria-direita">
                                    <div>
                                        R$ <?= number_format($ultimasReceitas[$i]['valor'], 2, ',', '.') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>



            </div>

        </section>
    </main>

</body>

</html>