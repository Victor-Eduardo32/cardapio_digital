<?php 

$id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$id){
    header("Location: ?url=404");
    exit();
}

$categoriaDao = new daoMysqlCategoria($pdo);
$lista = $categoriaDao->listar();

$produtoDao = new daoMysqlProduto($pdo);
$setar = $produtoDao->setarID($id);

$complemento = new daoMysqlComplemento($pdo);
$listaComplemento = $complemento->listarPorProduto($setar->getId(), 'ORDER BY pc.selecionado DESC');

$produtoComplementoDao = new daoMysqlProdutoComplemento($pdo);
$listaProdutoComplemento = $produtoComplementoDao->listar($setar->getId());

?>

<a href="?url=produtos" class="retornar-edit-produto">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p>
</a><!--retornar-->

<form class="campos-dados-produto" action="../../controller/gestor/produto/atualizar.php" method="post">
    
    <h4 class="titulo-produto">Adicionar Produto</h4>
    <input type="hidden" name='id' value="<?= $setar->getId(); ?>">
    <div class="form-group-produto">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-input nome-produto" placeholder="Nome do Produto" value="<?= $setar->getNome(); ?>" require>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" name="descricao" class="form-input descricao-produto" placeholder="Descrição do Produto" value="<?= $setar->getDescricao(); ?>" require>
    </div><!--form-group-categoria-->
    <div class="form-group-produto">
        <label for="categoria" class="form-label">Categoria</label>
        <Select class="form-input produto-produto" name="categoria">
            <?php foreach ($lista as $c): ?>
                <option value="<?= $c->getId(); ?>" <?= ($c->getId() == $setar->getIDC()) ? 'selected="selected"' : '' ?>>
                    <?= $c->getNome(); ?>
                </option>
            <?php endforeach; ?>
        </Select>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="ordem" class="form-label">Ordem</label>
        <input type="number" name="ordem" class="form-input ordem-produto" placeholder="Ordem do Produto" value="<?= $setar->getOrdem(); ?>" require>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="valor" class="form-label">Valor</label>
        <input type="text" pattern="[0-9]+(\.[0-9]+)?" name="valor" class="form-input valor-produto" placeholder="Valor do Produto" value="<?= $setar->getValor(); ?>" require>
    </div><!--form-group-produto-->
    <p>Deixe a opção "sempre disponível" ligada caso deseje deixar disponível durante todo o funcionamento do estabelescimento, caso contrário, defina o horário com a opção desligada.</p>
    <div class="form-group-produto">
        <label for="hora-inicial" class="form-label">Horário Inicial</label>
        <input type="text" name="hora-inicial" class="form-input hora-inicial" placeholder="00:00" value="<?= $setar->getHoraInicial(); ?>" onfocus="this.type='time'" onblur="this.type='text'">
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="hora-final" class="form-label">Horário Final</label>
        <input type="text" name="hora-final" class="form-input hora-final" placeholder="23:59" value="<?= $setar->getHoraFinal(); ?>" onfocus="this.type='time'" onblur="this.type='text'">
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="sempre-disponível" class="form-label">Sempre disponível</label>
        <input type="checkbox" name="disponivel" class="form-input check-disponivel" value="1" <?php echo ($setar->getDisponivel() == 1) ? 'checked' : ''; ?>>
    </div><!--form-group-produto-->
    <div class="form-group-produto upload">
        <label for="" class="form-label">Imagem</label>
        <input type="url" name="imagem" accept="image/png" value="<?= $setar->getImagem(); ?>" class="form-input" placeholder="https://">
    </div><!--form-group-produto upload-->

    <h4 class="titulo-complemento">Complementos</h4>
    <div class="ativar-complementos">

        <?php foreach($listaProdutoComplemento as $pc): ?>
            <input type="hidden" name="id-produto-complemento[]" value="<?= $pc->getId(); ?>">
        <?php endforeach; ?>
        
        <?php foreach($listaComplemento as $com): ?>
            <div class="complemento">
                <input type="hidden" name="id-complemento[]" value="<?= $com->getId(); ?>" >
                <input type="hidden" name="complemento-ativo[]">
                <label><?= $com->getNome(); ?></label>
                <input type="checkbox" class="check-complemento" value="<?= $com->getSelecionado(); ?>" <?php echo ($com->getSelecionado() == 1) ? 'checked' : '' ?>>
            </div>
        <?php endforeach; ?>
        
    </div>
    
    <input type="submit" value="Editar Produto" class="editar-produto"> 
</form>