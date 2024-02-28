<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/entregadao.php';

$nome = $_POST['nome'];
$preco = $_POST['preco'];

$entregaDao = new daoMySqlEntrega($pdo);

if($nome && $preco){
    $e = new Entrega();
    $e->setNome($nome);
    $e->setPreco($preco);

    $entregaDao->add($e);
    header('Location: ../../../view/admin/gestor?url=entregas');
} else {
    header('Location: ../../../view/admin/gestor?url=entregas');
}

?>