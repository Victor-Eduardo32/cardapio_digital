<?php 

    require '../../../../config.php';
    require '../../../model/DAO/gestor/usuariodao.php';

    $dao = new daoMysqlUsuario($pdo);
    $dao->logout();


?>