<?php

require_once '../../../config.php';
require_once '../../model/DAO/gestor/pedido/pedidodao.php';
require_once '../../model/DAO/gestor/pedido/clientePedidodao.php';
require_once '../../model/DAO/gestor/pedido/enderecoPedidodao.php';
require_once '../../model/DAO/gestor/pedido/dinheiroPedidodao.php';
require_once '../../model/DAO/gestor/pedido/cartaoPedidodao.php';
require_once '../../model/DAO/gestor/pedido/produtoPedidodao.php';
require_once '../../model/DAO/gestor/pedido/itensPedidodao.php';

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

<div class="pedidos-estados">

    <!-- Status de novo, após o cliente efetuar o pedido -->
    <div class="novos">
        <div class="nome-estado aba">
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Novos</h3>
        </div><!--nome-estado-->
        <div class="pedidos-container">
            <?php if (!empty($listarPedido)) : ?>
                <?php foreach ($listarPedido as $lp) : ?>
                    <?php if ($lp->getEstado() == 1) : ?>
                        <div class="pedido">
                            <div class="dados-cliente">
                                <h4>Dados do cliente</h4>

                                <!-- Dados do Cliente -->
                                <?php foreach ($listarClientePedido as $lcp) : ?>
                                    <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                        <p>Nome: <b><?= $lcp->getNome(); ?></b></p>
                                        <p>Telefone: <b><?= $lcp->getTelefone(); ?></b></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Endereço do Cliente caso tenha escolhido Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p>Bairro: <b><?= $lep->getBairro(); ?></b></p>
                                            <p>Endereço: <b><?= $lep->getRua(); ?></b></p>
                                            <p>Numero: <b><?= $lep->getNumero(); ?></b></p>
                                            <p>Referência: <b><?= $lep->getReferencia(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div><!--dados-cliente-->
                            <div class="dados-pedido">
                                <h4>Dados do pedido</h4>
                                <p class="valor-compra">Valor compra: <b>R$ <?= number_format($lp->getValorCompra(), 2, '.'); ?></b></p>

                                <!-- Valor da Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p class="valor-entrega">Valor entrega: <b>R$ <?= number_format($lep->getValorEntrega(), 2, '.'); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p class="valor-total">Valor total: <b></b></p>

                                <p>Metodo de pagamento: <b><?= $lp->getPagamento(); ?></b></p>

                                <!-- Verificação de Troco caso o cliente tenha escolhido Dinheiro -->
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

                                <!-- Verificação de Tipo caso o cliente tenha escolhido Cartão -->
                                <?php if ($lp->getPagamento() == 'Cartão') : ?>
                                    <?php foreach ($listarCartaoPedido as $lcp) : ?>
                                        <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                            <p>Bandeira do cartão: <b><?= $lcp->getTipoCartao(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p>Metodo de entrega: <b><?= $lp->getEntrega(); ?></b></p>

                                <!-- Produtos e Itens que o cliente escolheu no carrinho -->
                                <?php foreach ($listarProdutoPedido as $lpp) : ?>
                                    <?php if ($lp->getId() == $lpp->getIdPedido()) : ?>
                                        <div class="produto-pedido">
                                            <h5>[x<?= $lpp->getQuantidade(); ?>] <?= $lpp->getNome(); ?></h5>

                                            <?php if (!empty($listarItensPedido)) : ?>
                                                <?php foreach ($listarItensPedido as $lip) : ?>
                                                    <?php if ($lpp->getId() == $lip->getIdProduto()) : ?>
                                                        <p>- x<?= $lip->getQuantidade(); ?> <?= $lip->getNome(); ?></p>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div><!--produto-pedido-->
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div><!--dados-pedido-->
                            <div class="botoes-acoes">
                                <a href="../../controller/gestor/pedido/atualizarStatus.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Confirmar pedido" class="confirmar-pedido">
                                </a>
                                <a href="../../controller/gestor/pedido/cancelar.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Cancelar" class="cancelar-pedido">
                                </a>

                            </div>
                        </div><!--pedido-->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--pedidos-container-->
    </div><!--novos-->

    <!-- Status de produção, após aceitar o pedido -->
    <div class="producao">
        <div class="nome-estado aba">
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Em Produção</h3>
        </div><!--nome-estado-->
        <div class="pedidos-container">
            <?php if (!empty($listarPedido)) : ?>
                <?php foreach ($listarPedido as $lp) : ?>
                    <?php if ($lp->getEstado() == 2) : ?>
                        <div class="pedido">
                            <div class="dados-cliente">
                                <h4>Dados do cliente</h4>

                                <!-- Dados do Cliente -->
                                <?php foreach ($listarClientePedido as $lcp) : ?>
                                    <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                        <p>Nome: <b><?= $lcp->getNome(); ?></b></p>
                                        <p>Telefone: <b><?= $lcp->getTelefone(); ?></b></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Endereço do Cliente caso tenha escolhido Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p>Bairro: <b><?= $lep->getBairro(); ?></b></p>
                                            <p>Endereço: <b><?= $lep->getRua(); ?></b></p>
                                            <p>Numero: <b><?= $lep->getNumero(); ?></b></p>
                                            <p>Referência: <b><?= $lep->getReferencia(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div><!--dados-cliente-->
                            <div class="dados-pedido">
                                <h4>Dados do pedido</h4>
                                <p class="valor-compra">Valor compra: <b>R$ <?= number_format($lp->getValorCompra(), 2, '.'); ?></b></p>

                                <!-- Valor da Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p class="valor-entrega">Valor entrega: <b>R$ <?= number_format($lep->getValorEntrega(), 2, '.'); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p class="valor-total">Valor total: <b></b></p>

                                <p>Metodo de pagamento: <b><?= $lp->getPagamento(); ?></b></p>

                                <!-- Verificação de Troco caso o cliente tenha escolhido Dinheiro -->
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

                                <!-- Verificação de Tipo caso o cliente tenha escolhido Cartão -->
                                <?php if ($lp->getPagamento() == 'Cartão') : ?>
                                    <?php foreach ($listarCartaoPedido as $lcp) : ?>
                                        <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                            <p>Bandeira do cartão: <b><?= $lcp->getTipoCartao(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p>Metodo de entrega: <b><?= $lp->getEntrega(); ?></b></p>

                                <!-- Produtos e Itens que o cliente escolheu no carrinho -->
                                <?php foreach ($listarProdutoPedido as $lpp) : ?>
                                    <?php if ($lp->getId() == $lpp->getIdPedido()) : ?>
                                        <div class="produto-pedido">
                                            <h5>[x<?= $lpp->getQuantidade(); ?>] <?= $lpp->getNome(); ?></h5>

                                            <?php if (!empty($listarItensPedido)) : ?>
                                                <?php foreach ($listarItensPedido as $lip) : ?>
                                                    <?php if ($lpp->getId() == $lip->getIdProduto()) : ?>
                                                        <p>- x<?= $lip->getQuantidade(); ?> <?= $lip->getNome(); ?></p>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div><!--produto-pedido-->
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div><!--dados-pedido-->
                            <div class="botoes-acoes">
                                <input type="button" value="Imprimir" class="imprimir">
                                <input type="button" value="Imprimir via cozinha" class="imprimir-cozinha">
                                <a href="../../controller/gestor/pedido/cancelar.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Cancelar" class="cancelar-pedido">
                                </a>
                                <a href="../../controller/gestor/pedido/atualizarStatus.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Marcar como pronto" class="btn-pronto">
                                </a>
                            </div>

                        </div><!--pedido-->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--pedidos-container-->

    </div><!--producao-->

    <!-- Status de pronto, após o pedido terminar de ser feito -->
    <div class="pronto">
        <div class="nome-estado aba">
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Pronto/Saiu pra Entrega</h3>
        </div><!--nome-estado-->
        <div class="pedidos-container">
            <?php if (!empty($listarPedido)) : ?>
                <?php foreach ($listarPedido as $lp) : ?>
                    <?php if ($lp->getEstado() == 3) : ?>
                        <div class="pedido">
                            <div class="dados-cliente">
                                <h4>Dados do cliente</h4>

                                <!-- Dados do Cliente -->
                                <?php foreach ($listarClientePedido as $lcp) : ?>
                                    <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                        <p>Nome: <b><?= $lcp->getNome(); ?></b></p>
                                        <p>Telefone: <b><?= $lcp->getTelefone(); ?></b></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Endereço do Cliente caso tenha escolhido Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p>Bairro: <b><?= $lep->getBairro(); ?></b></p>
                                            <p>Endereço: <b><?= $lep->getRua(); ?></b></p>
                                            <p>Numero: <b><?= $lep->getNumero(); ?></b></p>
                                            <p>Referência: <b><?= $lep->getReferencia(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div><!--dados-cliente-->
                            <div class="dados-pedido">
                                <h4>Dados do pedido</h4>
                                <p class="valor-compra">Valor compra: <b>R$ <?= number_format($lp->getValorCompra(), 2, '.'); ?></b></p>

                                <!-- Valor da Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p class="valor-entrega">Valor entrega: <b>R$ <?= number_format($lep->getValorEntrega(), 2, '.'); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p class="valor-total">Valor total: <b></b></p>

                                <p>Metodo de pagamento: <b><?= $lp->getPagamento(); ?></b></p>

                                <!-- Verificação de Troco caso o cliente tenha escolhido Dinheiro -->
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

                                <!-- Verificação de Tipo caso o cliente tenha escolhido Cartão -->
                                <?php if ($lp->getPagamento() == 'Cartão') : ?>
                                    <?php foreach ($listarCartaoPedido as $lcp) : ?>
                                        <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                            <p>Bandeira do cartão: <b><?= $lcp->getTipoCartao(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p>Metodo de entrega: <b><?= $lp->getEntrega(); ?></b></p>

                                <!-- Produtos e Itens que o cliente escolheu no carrinho -->
                                <?php foreach ($listarProdutoPedido as $lpp) : ?>
                                    <?php if ($lp->getId() == $lpp->getIdPedido()) : ?>
                                        <div class="produto-pedido">
                                            <h5>[x<?= $lpp->getQuantidade(); ?>] <?= $lpp->getNome(); ?></h5>

                                            <?php if (!empty($listarItensPedido)) : ?>
                                                <?php foreach ($listarItensPedido as $lip) : ?>
                                                    <?php if ($lpp->getId() == $lip->getIdProduto()) : ?>
                                                        <p>- x<?= $lip->getQuantidade(); ?> <?= $lip->getNome(); ?></p>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div><!--produto-pedido-->
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div><!--dados-pedido-->
                            <div class="botoes-acoes">
                                <input type="button" value="Imprimir" class="imprimir">
                                <input type="button" value="Imprimir via cozinha" class="imprimir-cozinha">
                                <a href="../../controller/gestor/pedido/cancelar.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Cancelar" class="cancelar-pedido">
                                </a>
                                <a href="../../controller/gestor/pedido/atualizarStatus.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Marcar como entregue" class="entregue">
                                </a>
                            </div>

                        </div><!--pedido-->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--pedidos-container-->
    </div><!--pronto-->

    <!-- Status de entregue, após o pedido ser entregue ao cliente -->
    <div class="entregues">
        <div class="nome-estado aba">
            <i class="fa-solid fa-chevron-right"></i>
            <h3>Entregues</h3>
        </div><!--nome-estado-->
        <div class="pedidos-container">
            <?php if (!empty($listarPedido)) : ?>
                <?php foreach ($listarPedido as $lp) : ?>
                    <?php if ($lp->getEstado() == 4) : ?>
                        <div class="pedido">
                            <div class="dados-cliente">
                                <h4>Dados do cliente</h4>

                                <!-- Dados do Cliente -->
                                <?php foreach ($listarClientePedido as $lcp) : ?>
                                    <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                        <p>Nome: <b><?= $lcp->getNome(); ?></b></p>
                                        <p>Telefone: <b><?= $lcp->getTelefone(); ?></b></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- Endereço do Cliente caso tenha escolhido Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p>Bairro: <b><?= $lep->getBairro(); ?></b></p>
                                            <p>Endereço: <b><?= $lep->getRua(); ?></b></p>
                                            <p>Numero: <b><?= $lep->getNumero(); ?></b></p>
                                            <p>Referência: <b><?= $lep->getReferencia(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div><!--dados-cliente-->
                            <div class="dados-pedido">
                                <h4>Dados do pedido</h4>
                                <p class="valor-compra">Valor compra: <b>R$ <?= number_format($lp->getValorCompra(), 2, '.'); ?></b></p>

                                <!-- Valor da Entrega -->
                                <?php if ($lp->getEntrega() == 'Entrega') : ?>
                                    <?php foreach ($listarEnderecoPedido as $lep) : ?>
                                        <?php if ($lp->getId() == $lep->getIdPedido()) : ?>
                                            <p class="valor-entrega">Valor entrega: <b>R$ <?= number_format($lep->getValorEntrega(), 2, '.'); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p class="valor-total">Valor total: <b></b></p>

                                <p>Metodo de pagamento: <b><?= $lp->getPagamento(); ?></b></p>

                                <!-- Verificação de Troco caso o cliente tenha escolhido Dinheiro -->
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

                                <!-- Verificação de Tipo caso o cliente tenha escolhido Cartão -->
                                <?php if ($lp->getPagamento() == 'Cartão') : ?>
                                    <?php foreach ($listarCartaoPedido as $lcp) : ?>
                                        <?php if ($lp->getId() == $lcp->getIdPedido()) : ?>
                                            <p>Bandeira do cartão: <b><?= $lcp->getTipoCartao(); ?></b></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <p>Metodo de entrega: <b><?= $lp->getEntrega(); ?></b></p>

                                <!-- Produtos e Itens que o cliente escolheu no carrinho -->
                                <?php foreach ($listarProdutoPedido as $lpp) : ?>
                                    <?php if ($lp->getId() == $lpp->getIdPedido()) : ?>
                                        <div class="produto-pedido">
                                            <h5>[x<?= $lpp->getQuantidade(); ?>] <?= $lpp->getNome(); ?></h5>

                                            <?php if (!empty($listarItensPedido)) : ?>
                                                <?php foreach ($listarItensPedido as $lip) : ?>
                                                    <?php if ($lpp->getId() == $lip->getIdProduto()) : ?>
                                                        <p>- x<?= $lip->getQuantidade(); ?> <?= $lip->getNome(); ?></p>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div><!--produto-pedido-->
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div><!--dados-pedido-->
                            <div class="botoes-acoes">
                                <a href="../../controller/gestor/relatorio/adicionar.php?id=<?= $lp->getId(); ?>">
                                    <input type="button" value="Dar baixa" class="baixa">
                                </a>
                            </div>

                        </div><!--pedido-->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--pedidos-container-->

    </div><!--entregues-->

    <div class="separador-pedido"></div>
</div><!--pedidos-estados-->