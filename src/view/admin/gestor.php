<?php 
    require_once '../../../config.php'; 
    require_once '../../model/DAO/gestor/usuariodao.php';
    require_once '../../model/DAO/gestor/categoriadao.php';
    require_once '../../model/DAO/gestor/produtodao.php';
    require_once '../../model/DAO/gestor/complemento/complementodao.php';
    require_once '../../model/DAO/gestor/complemento/itemdao.php';
    require_once '../../model/DAO/gestor/produtoComplementodao.php';
    require_once '../../model/DAO/gestor/entregadao.php';
    require_once '../../model/DAO/gestor/relatorio/pedidosRelatoriodao.php';
    require_once '../../model/DAO/gestor/relatorio/clientesRelatoriodao.php';
    require_once '../../model/DAO/gestor/relatorio/enderecoRelatoriodao.php';
    require_once '../../model/DAO/gestor/relatorio/produtosRelatoriosdao.php';

    if(!isset($_SESSION['logado'])){
        header('Location: login.php');
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/gestor.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/pedidos/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/categorias/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/categorias/addEdit.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/produtos/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/produtos/addEdit.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/complementos/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/complementos/addEdit.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/entregas/principal.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/entregas/addEdit.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/gestor/relatorios/principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <title>Gestor</title>
</head>
<body>
    <div class="gestor">
        <section class="nav-gestor-container">
            <div class="logo-gestor">
                <img src="../../../public/img/BBQLogo.png" alt="BBQ_Logo">
                <p class="botao-abrir-nav"><i class="fa-solid fa-bars"></i></p>
            </div><!--logo-gestor-->
            <div class="nav-gestor">
                <nav>
                    <ul>
                        <li><a href="?url=pedidos">Pedidos</a></li>
                        <li><a href="?url=categorias">Categorias</a></li>
                        <li><a href="?url=produtos">Produtos</a></li>
                        <li><a href="?url=complementos">Complementos</a></li>
                        <li><a href="?url=entregas">Entregas</a></li>
                        <li><a href="?url=relatorios">Relatórios</a></li>
                    </ul>
                </nav>
            </div><!--nav-gestor-->
            <div class="btn-cardapio">
                <a href="../../controller/gestor/usuario/sair.php"><input type="button" value="Sair"></a>
                <a href="../../../index.php" target="_blank"><input type="button" value="cardapio"></a>
            </div>
            
        </section><!--nav-gestor-container-->
        <section class="conteudo-gestor">
            <div class="interior">
                <?php 
                
                    if(file_exists('../admin/'.$url.'.php')){
                        include('../admin/'.$url.'.php');
                    } else{
                        include('../../view/404.php');
                    }
                
                ?> 
            </div><!--interior-->
        </section><!--conteudo-gestor-->
    </div><!--gestor-->

    <script src="https://kit.fontawesome.com/ea49bb39e4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../../../public/js/gestor.js"></script>
</body>
</html>