<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/entregadao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];

$entregaDao =  new daoMySqlEntrega($pdo);

if($id && $nome && $preco){
    $e = new Entrega();
    $e->setId($id);
    $e->setNome($nome);
    $e->setPreco($preco);

    $entregaDao->editar($e);
    header('Location: ../../../view/admin/gestor?url=entregas');
} else {
    header('Location: ../../../view/admin/gestor?url=entregas');
}

?>