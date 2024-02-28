<?php
require_once './config.php';
require_once './src/model/DAO/gestor/categoriadao.php';
require_once './src/model/DAO/gestor/produtodao.php';
require_once './src/model/DAO/cardapio/carrinho/produtoCarrinhoDao.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

$categoriaDao = new daoMysqlCategoria($pdo);
$listarCategoria = $categoriaDao->listar($id);
$listarCategoriaSelecinada = $categoriaDao->listarPorCategoria($id);

$produtoDao = new daoMysqlProduto($pdo);
$listarProduto = $produtoDao->listar('ORDER BY ordem_produto');

$produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);
$listarProdutoCarrinho = $produtoCarrinhoDao->listar();

$valorTotalCompra = 0;

$horaAtual = date('H:i');

if (!empty($listarProdutoCarrinho)) {
    foreach ($listarProdutoCarrinho as $pc) {
        $valorTotalProduto = $pc->getValor() * $pc->getQuantidade();
        $valorTotalCompra += $valorTotalProduto;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="img/icon.png">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <title>BBQ</title>
</head>

<body>
    <header>
        <div class="apresentacao-estabelecimento">
            <div class="logo"><a href="#"><img src="./public/img/BBQLogo.png" alt="BBQ_Logo"></a></div>
            <div>
                <h1>BBQ</h1>
                <h3>A melhor hambúrgueria da cidade</h3>
            </div>
        </div>

        <nav class="desktop">
            <ul>
                <li><a href="./">Home</a></li>
                <li><a href="./src/view/contato.php">Contato</a></li>
                <li><a href="./src/view/pedidos-cliente.php">Pedidos</a></li>
            </ul>
        </nav><!--navegação desktop-->
    </header>

    <section class="banners-container">
        <div style="background-image: url('public/img/Banner.png');" class="banner-single"></div>
        <div style="background-image: url('public/img/Banner.png');" class="banner-single"></div>
        <div style="background-image: url('public/img/Banner.png');" class="banner-single"></div>
        <div class="bullets">
            <span class="active-slider"></span>
            <span></span>
            <span></span>
        </div>
    </section><!--banners-container-->

    <section class="categorias-nav-container">
        <a href="./index.php">
            <?php if ($id == null) : ?>
            <div class="categoria ativa">
            <?php else : ?>
            <div class="categoria">
            <?php endif; ?>
                <img src="https://cdn-icons-png.flaticon.com/256/1691/1691114.png" accept="image/png">
                <h4>Todos</h4>
            </div>
        </a>
        <?php foreach ($listarCategoria as $c) : ?>
            <?php if (($c->getAtivo() == 1 && $c->getDisponivel() == 1) || ($c->getAtivo() == 1 && $c->getDisponivel() == 0 && $horaAtual >= $c->getHoraInicial() && $horaAtual <= $c->getHoraFinal())) : ?>
                <a href="./index.php?id=<?= $c->getId(); ?>">
                    <?php if($id == $c->getId()): ?>
                    <div class="categoria ativa">
                    <?php else: ?>
                    <div class="categoria">
                    <?php endif; ?>
                        <img src="<?= $c->getImagem(); ?>" alt="">
                        <h4><?= $c->getNome(); ?></h4>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </section><!--categorias-nav-container-->

    <?php foreach ($listarCategoriaSelecinada as $c) : ?>
        <?php if (($c->getAtivo() == 1 && $c->getDisponivel() == 1) || ($c->getAtivo() == 1 && $c->getDisponivel() == 0 && $horaAtual >= $c->getHoraInicial() && $horaAtual <= $c->getHoraFinal())) : ?>
            <section class="categoria-container">

                <div class="categoria-nome">
                    <h2><?= $c->getNome(); ?></h2>
                </div>

                <div class="produtos-container">
                    <?php foreach ($listarProduto as $p) : ?>
                        <?php if ($c->getId() == $p->getIDC()) : ?>
                            <?php if ($p->getAtivo() == 1) : ?>
                                <div class="produto">
                                    <div class="img-produto">
                                        <img src="<?= $p->getImagem(); ?>">
                                    </div>
                                    <div class="info-produto">
                                        <h4><?= $p->getNome(); ?></h4>
                                        <p><?= $p->getDescricao(); ?></p>
                                        <p class="valor-produto">R$ <?= number_format($p->getValor(), 2, '.'); ?></p>
                                    </div><!--info-produto-->
                                    <a class="adicionar-produto" href="./src/view/adicionar-produto.php?id=<?= $p->getId(); ?>">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </div><!--produto-->
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div><!--produtos-container-->

            </section><!--categoria-container-->
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (!empty($listarProdutoCarrinho)) : ?>
        <a href="./src/view/carrinho.php">
            <div class="fechar-pedido">
                <button class="botao-fechar">
                    Fechar Pedido
                    <p>
                        <i class="fa-solid fa-bag-shopping"></i>
                        R$
                        <?php echo number_format($valorTotalCompra, 2, '.'); ?>
                    </p>
                </button>
            </div>
        </a>
    <?php endif; ?>

    <footer>
        <h4>BBQ</h4>
        <p>Todos os direitos reservados</p>
    </footer>


    <script src="https://kit.fontawesome.com/ea49bb39e4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="module" src="./public/js/cardapio.js"></script>
</body>

</html>