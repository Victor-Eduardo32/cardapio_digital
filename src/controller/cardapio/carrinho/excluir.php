<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php';

$id = $_GET['id'];
$produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);

if($id){
    $produtoCarrinhoDao->excluir($id);

    header('Location: ../../../view/carrinho.php');
}



?>