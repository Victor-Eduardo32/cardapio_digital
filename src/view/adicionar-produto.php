<?php 
    require_once '../../config.php'; 
    require_once '../model/DAO/gestor/categoriadao.php';
    require_once '../model/DAO/gestor/produtodao.php';
    require_once '../model/DAO/gestor/complemento/complementodao.php';
    require_once '../model/DAO/gestor/complemento/itemdao.php';  
    require_once '../model/DAO/gestor/produtoComplementodao.php';

    $id = $_GET['id'];

    $produtoDao = new daoMysqlProduto($pdo);
    $setarProduto = $produtoDao->setarID($id);

    $complementoDao = new daoMysqlComplemento($pdo);
    $listarComplemento = $complementoDao->listar();

    $itemDao = new daoMysqlItem($pdo);
    $listarItem = $itemDao->listar();

    $produtoComplementoDao = new daoMysqlProdutoComplemento($pdo);
    $listaProdutoComplemento = $produtoComplementoDao->listar($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/addPedidos.css">
    <title><?= $setarProduto->getNome(); ?></title>
</head>
<body>
<div class="produto-info">
    <a href="../../index.php" class="retornar">
        <i class="fa-solid fa-arrow-left"></i>
        <p>Voltar</p>
    </a><!--retornar-->
    <form action="../controller/cardapio/carrinho/adicionar.php" method="post">
        <!-- Inputs apenas para puxar os armazenas valores do produto -->
        <input type="hidden" name="imagem-produto-armazenado" value="<?= $setarProduto->getImagem(); ?>">
        <input type="hidden" name="nome-produto-armazenado" value="<?= $setarProduto->getNome(); ?>">
        <input type="hidden" name="quantidade-produto-armazenado">
        <input type="hidden" name="valor-produto-armazenado">
        <!-- Fim dos inputs de armazenar valores do produto -->

        <div class="imagem-produto" style="background-image: url('<?= $setarProduto->getImagem(); ?>');"></div>
        <div class="produtos-detalhes">
            <div class="dados-produto">
                <div class="identificacao-produto">
                    <h4><?= $setarProduto->getNome(); ?></h4>
                    <p><?= $setarProduto->getDescricao(); ?></p>
                </div>
                
                <div class="definir-quantidade">
                    <input type="button" value="-" id="diminuir-qtd">
                    <p id="qtd-produto" name="quantidade-produto">1</p>
                    <input type="button" value="+" id="aumentar-qtd">
                </div>
            </div>
        </div><!--produto-detalhes-->
    
        <?php foreach($listaProdutoComplemento as $pc): ?>
            <?php foreach($listarComplemento as $c): ?>
                <?php if($pc->getIDComplemento() == $c->getId() && $pc->getSelecionado() == 1): ?>
                    <div class="complemento-produtos">
                        <input type="hidden" value="<?= $c->getMinimoSel(); ?>" class="min-selecinado">
                        <input type="hidden" value="<?= $c->getMaximoSel(); ?>" class="max-selecinado">
                        <h4 class="nome-complemento"><?= $c->getNome(); ?></h4>
                        <p class="descricao-complemento"><?= $c->getDescricao(); ?></p>
                        <p class="descricao-complemento-minimo">Mínimo Selecionavel: <?= $c->getMinimoSel(); ?></p>
                        <p class="descricao-complemento-maximo">Máximo Selecionavel: <?= $c->getMaximoSel(); ?></p>
                        <?php  
                            $itemDao = new daoMysqlItem($pdo, $c->getId());
                            $listarItem = $itemDao->listar();

                            foreach($listarItem as $i): 
                        ?>
                        <div class="opcoes-complemento">
                            <div class="item-complemento">
                                <h5><?= $i->getNome(); ?></h5>
                                <p class="descricao-item"><?= $i->getDescricao(); ?></p>
                                <p class="valor-item">+ <?= $i->getValor(); ?></p>
                            </div>
                            <?php if($c->getTipo() == 1): ?>
                            <input type="hidden" name="nome-item-SU[]" value="<?= $i->getNome(); ?>">
                            <input type="hidden" name="valor-item-SU[]" value="<?= $i->getValor(); ?>">
                            <input type="hidden" name="quantidade-item-SU[]">
                            <div class="item-check">
                                
                                <input type="checkbox" class="item-marcado">
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="nome-item-MO[]" value="<?= $i->getNome(); ?>">
                            <input type="hidden" name="valor-item-MO[]" value="<?= $i->getValor(); ?>">
                            <input type="hidden" name="quantidade-item-MO[]">
                            <div class="item-qtd">
                                <p class="diminuir-qtd-item"><i class="fa-solid fa-minus"></i></p>
                                <p class="qtd-atual-item">0</p>
                                <p class="aumentar-qtd-item"><i class="fa-solid fa-plus"></i></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div><!--complemento-produto-->
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <div class="separador"></div>
        
        <div class="adicionar-produto">
            <h4>Adicionar</h4>
            <p>R$ <?= number_format($setarProduto->getValor(), 2, '.'); ?></p>
        </div><!--adicionar-->
    </form>
    
</div><!--produto-info-->

    <script src="https://kit.fontawesome.com/ea49bb39e4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="module" src="../../public/js/cardapio.js"></script>
</body>
</html>