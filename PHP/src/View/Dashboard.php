<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
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