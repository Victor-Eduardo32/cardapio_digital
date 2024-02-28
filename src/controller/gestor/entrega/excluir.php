<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/entregadao.php';

$id = $_GET['id'];

$entregaDao = new daoMySqlEntrega($pdo);

if($id){
    $entregaDao->excluir($id);
    header('Location: ../../../view/admin/gestor?url=entregas');
}


?>