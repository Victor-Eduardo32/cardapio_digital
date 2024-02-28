<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php';
require_once '../../../model/DAO/cardapio/carrinho/itensCarrinhoDao.php';

$imagemProduto = $_POST['imagem-produto-armazenado'];
$nomeProduto = $_POST['nome-produto-armazenado'];
$quantidadeProduto = $_POST['quantidade-produto-armazenado'];
$valorProduto = $_POST['valor-produto-armazenado'];

$idProduto = 0;

$nomeItemMO = $_POST['nome-item-MO'];
$quantidadeItemMO = $_POST['quantidade-item-MO'];
$quantidadeItemMO = explode(',', $quantidadeItemMO[0]);
$valorItemMO = $_POST['valor-item-MO'];

$nomeItemSU = $_POST['nome-item-SU'];
$quantidadeItemSU = $_POST['quantidade-item-SU'];
$quantidadeItemSU = explode(',', $quantidadeItemSU[0]);
$valorItemSU = $_POST['valor-item-SU'];

$produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);
$itensCarrinhoDao = new daoMySqlItensCarrinho($pdo);

if($imagemProduto && $nomeProduto && $quantidadeProduto && $valorProduto){
    $pc = new produtoCarrinho();
    $pc->setImagem($imagemProduto);
    $pc->setNome($nomeProduto);
    $pc->setQuantidade($quantidadeProduto);
    $pc->setValor($valorProduto);
    $produtoCarrinhoDao->add($pc);

    foreach($nomeItemSU as $key => $nomeSU){
        $nomeSU = $nomeItemSU[$key];
        $quantidadeSU = $quantidadeItemSU[$key];
        $valorSU = $valorItemSU[$key];

        if($quantidadeSU == 1){
            $ic = new ItensCarrinho();
            $ic->setProdutoCarrinho($pc->getId());
            $ic->setNome($nomeSU);
            $ic->setQuantidade($quantidadeSU);
            $ic->setValor($valorSU);
            $itensCarrinhoDao->add($ic);
        }
    }

    foreach($nomeItemMO as $key => $nomeMO){
        $nomeMO = $nomeItemMO[$key];
        $quantidadeMO = $quantidadeItemMO[$key];
        $valorMO = $valorItemMO[$key];

        if($quantidadeMO > 0){
            $ic = new ItensCarrinho();
            $ic->setProdutoCarrinho($pc->getId());
            $ic->setNome($nomeMO);
            $ic->setQuantidade($quantidadeMO);
            $ic->setValor($valorMO);
            $itensCarrinhoDao->add($ic);
        }
    }

    header('Location: ../../../../index.php');
}

?>