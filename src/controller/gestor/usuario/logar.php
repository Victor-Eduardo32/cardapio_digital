<?php 

    require_once '../../../../config.php';
    require_once '../../../model/DAO/gestor/usuariodao.php';

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if($nome && $senha){
        $user = new daoMysqlUsuario($pdo);
        if($user->logar($nome,$senha)){
            if(isset($_SESSION['logado'])){
                header('Location: ../../../view/admin/gestor?url=pedidos');
            } else {
                header('Location: ../../../view/login.php');
            }
        } else {
            header('Location: ../../../view/login.php');
        }
    } else {
        header('Location: ../../../view/login.php');
    }
?>