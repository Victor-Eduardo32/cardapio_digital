<?php
require_once '../../config.php';
require_once '../model/DAO/gestor/pedido/pedidodao.php';
require_once '../model/DAO/gestor/pedido/clientePedidodao.php';
require_once '../model/DAO/gestor/pedido/enderecoPedidodao.php';
require_once '../model/DAO/gestor/pedido/dinheiroPedidodao.php';
require_once '../model/DAO/gestor/pedido/cartaoPedidodao.php';
require_once '../model/DAO/gestor/pedido/produtoPedidodao.php';
require_once '../model/DAO/gestor/pedido/itensPedidodao.php';

$pedidoDao = new daoMySqlPedido($pdo);
$listarPedido = $pedidoDao->listarPedido();

$clienteDao = new daoMySqlClientePedido($pdo);
$listarClientePedido = $clienteDao->listarCliente();

$enderecoDao = new daoMySqlEnderecoPedido($pdo);
$listarEnderecoPedido = $enderecoDao->listarEndereco();

$dinheiroPedidoDao = new daoMySqlDinheiroPedido($pdo);
$listarDinheiroPedido = $dinheiroPedidoDao->listarTroco();

$cartaoPedidoDao = new daoMySqlCartaoPedido($pdo);
$listarCartaoPedido = $cartaoPedidoDao->listarCartao();

$produtoPedidoDao = new daoMySqlProdutoPedido($pdo);
$listarProdutoPedido = $produtoPedidoDao->listarProdutoPedido();

$itensPedidoDao = new daoMySqlItensPedido($pdo);
$listarItensPedido = $itensPedidoDao->listarItensPedido();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/pedidos-cliente.css">
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <title>Pedidos</title>
</head>

<body>
    <header>
        <div class="apresentacao-estabelecimento">
            <div class="logo"><a href="#"><img src="../../public/img/BBQLogo.png" alt="BBQ_Logo"></a></div>
            <div>
                <h1>BBQ</h1>
                <h3>A melhor hambúrgueria da cidade</h3>
            </div>
        </div>

        <nav class="desktop">
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="./contato.php">Contato</a></li>
                <li><a href="./pedidos-cliente.php">Pedidos</a></li>
            </ul>
        </nav><!--navegação desktop-->
    </header>

        <div class="pedidos-cliente">
        <?php if (!empty($listarPedido)) : ?>
            <?php foreach ($listarPedido as $lp) : ?>
                <div class="pedido">
                    <div class="dados-pedido">
                        <h3>Dados Pedido</h3>
                        <?php if ($lp->getEstado() == 1) : ?>
                            <p>Status do Pedido: <b>Aguardando</b></p>
                        <?php elseif ($lp->getEstado() == 2) : ?>
                            <p>Status do Pedido: <b>Em produção</b></p>
                        <?php elseif ($lp->getEstado() == 3) : ?>
                            <p>Status do Pedido: <b>Pronto/Saiu pra Entrega</b></p>
                        <?php elseif ($lp->getEstado() == 4) : ?>
                            <p>Status do Pedido: <b>Entregue</b></p>
                        <?php endif ?>


                        <p class="valor-compra">Valor compra: <b>R$ <?= number_format($lp->getValorCompra(), 2, '.'); ?></b></p>

                        <?php if ($lp->getEntrega() == 'Entrega') : ?>
                            <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                    <p class="valor-entrega">Valor entrega: <b>R$ <?= number_format($lep->getValorEntrega(), 2, '.'); ?></b></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <p class="valor-total">Valor total: <b></b></p>

                        <p>Metodo de pagamento: <b><?= $lp->getPagamento(); ?></b></p>

                        <?php if ($lp->getPagamento() == 'Dinheiro') : ?>
                            <?php foreach ($listarDinheiroPedido as $ldp) : ?>
                                <?php if ($lp->getId() == $ldp->getIdPedido()) : ?>
                                    <p>Deseja Troco: <b><?= $ldp->getConfirmacaoTroco(); ?></b></p>
                                    <?php if ($ldp->getConfirmacaoTroco() == 'Sim') : ?>
                                        <p>Troco para: <b>R$ <?= number_format($ldp->getTroco(), 2, '.'); ?></b></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($lp->getPagamento() == 'Cartão') : ?>
                            <?php foreach ($listarCartaoPedido as $lcp) : ?>
                                <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                    <p>Bandeira do cartão: <b><?= $lcp->getTipoCartao(); ?></b></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <p>Metodo de entrega: <b><?= $lp->getEntrega(); ?></b></p>
                    </div>
                    <div class="produtos">
                        <h3>Produtos</h3>
                        <?php foreach ($listarProdutoPedido as $lpp) : ?>
                            <?php if ($lp->getId() == $lpp->getIdPedido()) : ?>
                                <h5>[x<?= $lpp->getQuantidade(); ?>] <?= $lpp->getNome(); ?></h5>

                                <?php if (!empty($listarItensPedido)) : ?>
                                    <?php foreach ($listarItensPedido as $lip) : ?>
                                        <?php if ($lpp->getId() == $lip->getIdProduto()) : ?>
                                            <p>- x<?= $lip->getQuantidade(); ?> <?= $lip->getNome(); ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

            <?php endforeach ?>
        </div>
    <?php else : ?>
        <h4>Nenhum pedido no momento</h4>
    <?php endif; ?>

<footer>
    <h4>BBQ</h4>
    <p>Todos os direitos reservados</p>
</footer>
</body>

</html>