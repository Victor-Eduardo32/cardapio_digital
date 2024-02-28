<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/complemento/complementodao.php';
require_once '../../../model/DAO/gestor/complemento/itemdao.php';

$id = $_GET['id'];

$complementoDAO = new daoMysqlComplemento($pdo);
$c = new Complemento();

$itemDao = new daoMysqlItem($pdo);
$i = new Item();

if($id){
    $c->setID($id);
    $complementoDAO->duplicar($c);

    $novoIdComplemento = $c->getID();

    $i->setComplemento($id);
    $itemDao->duplicar($i, $novoIdComplemento);

    header('Location: ../../../view/admin/gestor?url=complementos');
}


?>