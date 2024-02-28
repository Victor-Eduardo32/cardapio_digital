<?php 
    require_once '../../../../config.php';
    require_once '../../../model/DAO/gestor/categoriadao.php';

    $id = $_GET['id'];

    if($id){
        $categoria = new daoMysqlCategoria($pdo);
        $categoria->deletar($id);
        header('Location: ../../../view/admin/gestor?url=categorias');
    } else {
        header('Location: ../../../view/admin/gestor?url=categorias');
    }
?>