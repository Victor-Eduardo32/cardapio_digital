<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/pedido/pedidodao.php';

$id = $_GET['id'];
$pedidoDao = new daoMySqlPedido($pdo);

if($id){
    $pedidoDao->atualizarStatus($id);
    Header('Location: ../../../view/admin/gestor?url=pedidos');
}

?>