<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php';

$id = $_GET['id'];
$quantidade = $_GET['quantidade'];
$quantidade = $quantidade + 1;
$produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);

if($quantidade){
    $pc = new produtoCarrinho();
    $pc->setId($id);
    $pc->setQuantidade($quantidade);
    $produtoCarrinhoDao->mudarQuantidade($pc);

    header('Location: ../../../view/carrinho.php');
}


?>