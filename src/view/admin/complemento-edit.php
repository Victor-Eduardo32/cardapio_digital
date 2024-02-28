<?php 

$id = isset($_GET['id']) ? $_GET['id'] : null;

$categoriaDao = new daoMysqlComplemento($pdo);
$setar = $categoriaDao->setarID($id);

$itemDao = new daoMysqlItem($pdo, $id);
$listaItem = $itemDao->listar();


?>

<a href="?url=complementos" class="retornar-add-complemento">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p> 
</a><!--retornar-->

<form class="campos-dados-complemento" action="../../controller/gestor/complemento/atualizar.php" method="post">
    
    <h4>Editar Complemento</h4>
    <input type="hidden" name="id-complemento" value="<?= $setar->getID(); ?>">
    <div class="form-group-complemento">
        <label for="nome-complemento" class="form-label">Nome</label>
        <input type="text" name="nome-complemento" class="form-input nome-produto" placeholder="Nome" value="<?= $setar->getNome(); ?>" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="descricao-complemento" class="form-label">Descricao</label>
        <input type="text" name="descricao-complemento" class="form-input descricao-produto" placeholder="Descrição" value="<?= $setar->getDescricao(); ?>" require>
    </div><!--form-group-categoria-->
    <div class="form-group-complemento">
        <label for="min-selecionavel-complemento" class="form-label">Mínimo Selecionavel</label>
        <input type="number" name="min-selecionavel-complemento" class="form-input min-selecionavel" placeholder="Mínimo Selecionavel" value="<?= $setar->getMinimoSel(); ?>" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="max-selecionavel-complemento" class="form-label">Máximo Selecionavel</label>
        <input type="number" name="max-selecionavel-complemento" class="form-input max-selecionavel" placeholder="Máximo Selecionavel" value="<?= $setar->getMaximoSel(); ?>" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="tipo-complemento" class="form-label">Tipo de Complemento</label>
        <Select class="form-input" name="tipo-complemento">
            <option value="1" <?= ($setar->getTipo() == 1) ? 'selected' : ''; ?>>Seleção Única</option>
            <option value="2" <?= ($setar->getTipo() == 2) ? 'selected' : ''; ?>>Multíplas Opções -/+</option>
        </Select>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="tipo-cobrar" class="form-label">Cobrar maior valor entre as opções selecionadas?</label>
        <Select class="form-input" name="valor-maior">
            <option value="0" <?= ($setar->getValorMaior() == 0) ? 'selected' : ''; ?>>Não</option>
            <option value="1" <?= ($setar->getValorMaior() == 1) ? 'selected' : ''; ?>>Sim</option>
        </Select>
    </div><!--form-group-produto-->
    <p>Adicione itens a esse complemento</p>
    <?php foreach($listaItem as $i): ?>
    <div class="corpo-itens">
        <div class="item">
            <div class="campo-item">
                <input type="hidden" name="id-item[]" value="<?= $i->getID(); ?>">
                <input type="hidden" name="id-item-removido[]">
                <input type="hidden" name="inativo-complemento[]">
                <input type="hidden" name="valor-ativo-complemento[]">
                <input type="hidden" name="trocar-ativo-complemento[]" value="<?= $i->getAtivo(); ?>" >
                <div class="form-group-complemento">
                    <label for="nome-item" class="form-label">Nome do Complemento</label>
                    <input type="text" name="nome-item[]" class="form-input nome-produto" placeholder="Nome do Complemento" value="<?= $i->getNome(); ?>" require>
                </div><!--form-group-produto-->
                <div class="form-group-complemento">
                    <label for="descricao-item" class="form-label">Descrição do Complemento</label>
                    <input type="text" name="descricao-item[]" class="form-input descricao-produto" placeholder="Descrição do Complemento" value="<?= $i->getDescricao(); ?>" require>
                </div><!--form-group-categoria-->
                <div class="form-group-complemento">
                    <label for="valor-item" class="form-label">Valor do Complemento</label>
                    <input type="number" name="valor-item[]" class="form-input min-selecionavel" placeholder="Valor do Complemento" value="<?= $i->getValor(); ?>" require>
                </div><!--form-group-produto-->
            </div><!--campo-item-->
            
            <div class="acoes-item">
                <input type="button" value="Remover" class="remover-complemento">
                <?php 
                    if($i->getAtivo() == 1){
                        echo '<input type="button" value="Inativar" class="inativar-ativar-complemento inativar">';
                    } else {
                        echo '<input type="button" value="Ativar" class="inativar-ativar-complemento ativar">';
                    }
                ?>
            </div><!--remover-item-->
        </div><!--item-->

        <div class="separador-complemento"></div>
    </div><!--corpo-itens-->
    <?php endforeach; ?>
    <div class="adicionar-novo-complemento">
        <input type="button" value="Adicionar Complemento" class="adiciona-complemento">
    </div>
    <input type="submit" value="Editar Complemento" class="editar-complemento"> 
</form>
