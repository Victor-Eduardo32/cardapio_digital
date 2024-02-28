<?php

$dataInicial = isset($_POST['data-inicial']) ? $_POST['data-inicial'] : null;
$dataFinal = isset($_POST['data-final']) ? $_POST['data-final'] : null;

if (isset($dataInicial) && isset($dataFinal)) {
    $quantidades = new daoMySqlPedidosRelatorios($pdo);
    $listarQuantidades = $quantidades->listarQuantidadePorTipoEntrega($dataInicial, $dataFinal);
    $listarFaturamento = $quantidades->listarFaturamento($dataInicial, $dataFinal);

    $clientes = new daoMySqlClienteRelatorio($pdo);
    $listarCliente = $clientes->listarCliente($dataInicial, $dataFinal);

    $endereco = new daoMySqlEnderecoRelatorio($pdo);
    $listarBairros = $endereco->listarBairros($dataInicial, $dataFinal);

    $produtos = new daoMySqlProdutosRelatorio($pdo);
    $listarProdutos = $produtos->listarProduto($dataInicial, $dataFinal);

    $quantidadeRetirada = isset($listarQuantidades['quantidadeRetirada']) ? $listarQuantidades['quantidadeRetirada'] : 0;
    $quantidadeEntrega = isset($listarQuantidades['quantidadeEntrega']) ? $listarQuantidades['quantidadeEntrega'] : 0;

    $valorPedidoEntrega = $listarFaturamento['valorCompraEntrega'];
    $valorPedidoRetirada = $listarFaturamento['valorCompraRetirada'];
    $valorEntrega = $listarFaturamento['valorEntrega'];
}


?>


<div class="conteudo-relatorios">
    <div class="relatorio-topo">
        <h3>Relatórios</h3>
        <p>Defina o tempo que deseja para exibir os dados</p>
    </div><!--relatorio-topo-->

    <form method="post" action="?url=relatorios" class="data-relatorios">
        <div>
            <h5>Data Inicial</h5>
            <input type="datetime-local" name="data-inicial">
        </div>
        <div>
            <h5>Data Final</h5>
            <input type="datetime-local" name="data-final">
        </div>
        <input type="submit" value="Enviar">
    </form><!--data-relatorios-->

    <div class="dados-relatorios">

        <div class="info-pedidos">
            <h1>Quantidade de pedidos</h1>
            <?php if (!empty($listarQuantidades)) : ?>
                <p>Total: <b><?php echo $quantidadeEntrega + $quantidadeRetirada; ?></b> pedidos</p>
                <p>Delivery: <b><?php echo $quantidadeEntrega; ?></b> pedidos</p>
                <p>Retirada: <b><?php echo $quantidadeRetirada; ?></b> pedidos</p>
            <?php endif; ?>
        </div><!--info-pedidos-->

        <div class="info-faturamento">
            <h1>Faturamento</h1>
            <?php if (!empty($listarFaturamento)) : ?>
                <p>Delivery: <b>R$ <?php echo number_format($valorPedidoEntrega, 2, ','); ?></b></p>
                <p>Retirados: <b>R$ <?php echo number_format($valorPedidoRetirada, 2, ','); ?></b></p>
                <p>Valor frete: <b>R$ <?php echo number_format($valorEntrega, 2, ','); ?></b></p>
                <p>Total sem frete: <b>R$ <?php echo number_format($valorPedidoEntrega + $valorPedidoRetirada, 2, ','); ?></b></p>
                <p>Total geral: <b>R$ <?php echo number_format($valorPedidoEntrega + $valorPedidoRetirada + $valorEntrega, 2, ','); ?></b></p>
            <?php endif; ?>
        </div><!--info-faturamento-->

        <div class="info-clientes">
            <h1>Top Clientes</h1>
            <?php if (!empty($listarCliente)) : ?>
                <?php foreach ($listarCliente as $lc) : ?>

                    <p>
                        <b><?= $lc->getNome();  ?></b>
                        <i class="fa-solid fa-plus abrir-cliente"></i>
                    </p>
                    <div class="cliente">
                        <p>Pedidos realizados: <b><?= $lc->getTotalPedidos();  ?></b></p>
                        <p>Celular: <b><?= $lc->getTelefone();  ?></b></p>
                    </div><!--cliente-->

                <?php endforeach; ?>
            <?php endif ?>
        </div><!--info-clientes-->
    </div><!--dados-relatorios-->

    <div class="dados-relatorios">

        <div class="info-categorias">
            <h1>Produtos mais vendidos</h1>
            <?php if (!empty($listarProdutos)) : ?>
                <?php foreach ($listarProdutos as $lp) : ?>
                    <p><?= $lp->getNome(); ?>: <b><?= $lp->getQuantidade(); ?></b> vendidos</p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--info-categorias-->

        <div class="info-bairros">
            <h1>Ranking bairros</h1>
            <?php if (!empty($listarBairros)) : ?>
                <?php foreach ($listarBairros as $lb) : ?>
                    <p><?= $lb->getBairro();  ?>: <b><?= $lb->getTotalPedidos();  ?> pedidos</b></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!--info-bairros-->

    </div><!--dados-relatorios-->

    <div class="separador-relatorio"></div>
</div><!--conteudo-relatorios-->