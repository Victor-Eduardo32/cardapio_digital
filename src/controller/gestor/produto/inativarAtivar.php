<?php 

require '../../../../config.php';
require '../../../model/DAO/gestor/produtodao.php';

$produtoDao = new daoMysqlProduto($pdo);

$id = $_GET['id'];
$ativo = $_GET['ativo'] == 1 ? [0] : 1;

if($id && $ativo){
    $p = new Produto();
    $p->setId($id);
    $p->setAtivo($ativo);
    
    $produtoDao->inativarAtivar($p);
    header('Location: ../../../view/admin/gestor?url=produtos');
} else {
    header('Location: ../../../view/admin/gestor?url=produtos');
}

?>