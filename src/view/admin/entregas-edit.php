<?php 

$id = $_GET['id'];

$entregaDao = new daoMySqlEntrega($pdo);
$setar = $entregaDao->setarID($id);


?>

<a href="?url=entregas" class="retornar-add-entrega">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p>
</a><!--retornar-->

<form class="campos-dados-entrega" action="../../controller/gestor/entrega/editar.php" method="post">
    
    <h4>Adicionar Entrega</h4>
    <input type="hidden" name="id" value="<?= $setar->getId() ?>">
    <div class="form-group-entrega">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-input nome-entrega" placeholder="Nome do Bairro" value="<?= $setar->getNome() ?>" require>
    </div><!--form-group-entrega-->
    <div class="form-group-entrega">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" name="preco" class="form-input preco-entrega" placeholder="Preço da Entrega" value="<?= $setar->getPreco() ?>" require>
    </div><!--form-group-entrega-->
    
    <input type="submit" value="Criar Entrega" class="criar-entrega"> 
</form>