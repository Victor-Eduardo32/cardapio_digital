<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/complemento/complementodao.php';
require_once '../../../model/DAO/gestor/complemento/itemdao.php';

$id = $_GET['id'];

if($id){
    $complementoDao = new daoMysqlComplemento($pdo);
    $complementoDao->excluir($id);
    header('Location: ../../../view/admin/gestor?url=complementos');
}

?>