<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/categoriadao.php';

$categoria = new daoMysqlCategoria($pdo);

$id = $_GET['id'];
$ativo = $_GET['ativo'] == 1 ? $_GET['ativo'] = [0] : $_GET['ativo'] = 1;

if($id && $ativo){
    $c = new Categoria();
    $c->setId($id);
    $c->setAtivo($ativo);
    $categoria->inativarAtivar($c);
    header('Location: ../../../view/admin/gestor?url=categorias');
} else {
    header('Location: ../../../view/admin/gestor?url=categorias');
}

?>