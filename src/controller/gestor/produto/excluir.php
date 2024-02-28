<?php 

require '../../../../config.php';
require '../../../model/DAO/gestor/produtodao.php';

$id = $_GET['id'];

if($id){
    $produto = new daoMysqlProduto($pdo);   
    $produto->excluir($id);
    header('Location: ../../../view/admin/gestor?url=produtos');
} else {
    header('Location: ../../../view/admin/gestor?url=produtos');
}


?>