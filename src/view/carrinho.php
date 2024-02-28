<?php 
    require_once '../../config.php';
    require_once '../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php'; 
    require_once '../model/DAO/cardapio/carrinho/itensCarrinhoDao.php'; 
    
    $produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);
    $listarProdutoCarrinho = $produtoCarrinhoDao->listar();

    $itensCarrinhoDao = new daoMySqlItensCarrinho($pdo);
    $listarItensCarrinho = $itensCarrinhoDao->listar();

    if(empty($listarProdutoCarrinho)){
        header('Location: ../../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/carrinho.css">
    <title>Carrinho</title>
</head>
<body>
<div class="carrinho-info">
    <div class="retornar">
        <a href="../../index.php" >
            <i class="fa-solid fa-arrow-left"></i>
            <p>Voltar</p>
        </a>
    </div><!--retornar-->

    <h3 class="titulo-carrinho">Carrinho</h3>
    <?php foreach($listarProdutoCarrinho as $pc): ?>
    <div class="produto-carrinho">
        <div class="produto-info">
            <div style="background-image: url('<?= $pc->getImagem(); ?>');" class="imagem-produto"></div>
            <div class="dados-produto">
                <div class="produto-base">
                    
                    <div class="info-produto-base">
                        <h4><?= $pc->getNome(); ?></h4>
                        <?php if(!empty($listarItensCarrinho)): ?>
                        <?php foreach($listarItensCarrinho as $ic): ?>
                        <?php if($pc->getId() == $ic->getProdutoCarrinho()): ?>
                        <p> - X<?= $ic->getQuantidade(); ?> <?= $ic->getNome(); ?> </p>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="info-valor-base">
                        <p>R$ <?= number_format($pc->getValor(), 2, '.'); ?></p>
                    </div>
                </div><!--produto-base-->

                <div class="produto-final">
                    <h4>Valor total</h4>
                    <p>R$ <?= number_format($pc->getValor() *  $pc->getQuantidade(), 2, '.'); ?></p>
                </div>
            </div><!--dados-produto-->
            <div class="botoes-acoes">
                <a href="../controller/cardapio/carrinho/excluir.php?id=<?= $pc->getId() ?>">
                    <input type="button" value="x" class="apagar-produto">
                </a>
                <a href="../controller/cardapio/carrinho/diminuirQuantidade.php?id=<?= $pc->getId() ?>&quantidade=<?= $pc->getQuantidade() ?>">
                    <input type="button" value="-" class="diminuir-qtd">
                </a>
                <input type="button" value="<?= $pc->getQuantidade(); ?>" class="qtd-produto">
                <a href="../controller/cardapio/carrinho/aumentarQuantidade.php?id=<?= $pc->getId() ?>&quantidade=<?= $pc->getQuantidade() ?>">
                    <input type="button" value="+" class="aumentar-qtd">
                </a>
                
            </div><!--botoes-acoes-->
        </div><!--produto-info-->
    </div><!--produto-carrinho-->
    <?php endforeach; ?>

    <div class="separador"></div>

</div><!--carrinho-info-->

<a href="./finalizar.php">
    <div class="finalizar-pedido">
        <button class="finalizar">
            Finalizar Pedido
        </button>
    </div>
</a>
    

<script src="https://kit.fontawesome.com/ea49bb39e4.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="module" src="../../public/js/cardapio.js"></script>
</body>
</html>