<?php 

$categoria = new daoMysqlCategoria($pdo);
$listaCategoria = $categoria->listar();

$complemento = new daoMysqlComplemento($pdo);
$listaComplemento = $complemento->listar();
?>

<a href="?url=produtos" class="retornar-add-produto">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p> 
</a><!--retornar-->

<form class="campos-dados-produto" action="../../controller/gestor/produto/adicionar.php" method="post">
    
    <h4 class="titulo-produto">Adicionar Produto</h4>
    <div class="form-group-produto">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-input nome-produto" placeholder="Nome do Produto" require>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="descricao" class="form-label">Descricao</label>
        <input type="text" name="descricao" class="form-input descricao-produto" placeholder="Descrição do Produto" require>
    </div><!--form-group-categoria-->
    <div class="form-group-produto">
        <label for="categoria" class="form-label">Categoria</label>
        <Select class="form-input" name="categoria">
            <?php foreach ($listaCategoria  as $c): ?>
                <option value="<?= $c->getId(); ?>"><?= $c->getNome(); ?></option>
            <?php endforeach; ?>
        </Select>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="ordem" class="form-label">Ordem</label>
        <input type="number" name="ordem" class="form-input ordem-produto" placeholder="Ordem do Produto" require>
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="valor" class="form-label">Valor</label>
        <input type="text" pattern="[0-9]+(\.[0-9]+)?" name="valor" class="form-input valor-produto" placeholder="Valor do Produto" require>
    </div><!--form-group-produto-->
    <p>Deixe a opção "sempre disponível" ligada caso deseje deixar disponível durante todo o funcionamento do estabelescimento, caso contrário, defina o horário com a opção desligada.</p>
    <div class="form-group-produto">
        <label for="hora-inicial" class="form-label">Horário Inicial</label>
        <input type="text" name="hora-inicial" class="form-input hora-inicial" placeholder="00:00" onfocus="this.type='time'" onblur="this.type='text'">
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="hora-final" class="form-label">Horário Final</label>
        <input type="text" name="hora-final" class="form-input hora-final" placeholder="23:59" onfocus="this.type='time'" onblur="this.type='text'">
    </div><!--form-group-produto-->
    <div class="form-group-produto">
        <label for="sempre-disponível" class="form-label">Sempre disponível</label>
        <input type="checkbox" name="disponivel" class="form-input check-disponivel" checked>
    </div><!--form-group-produto-->
    <div class="form-group-produto upload">
        <label for="" class="form-label">Imagem</label>
        <input type="url" name="imagem" accept="image/png" class="form-input" placeholder="https://">
    </div><!--form-group-produto upload-->

    <h4 class="titulo-complemento">Complementos</h4>
    <div class="ativar-complementos">
        <?php foreach($listaComplemento as $com): ?>
            <div class="complemento">
                <input type="hidden" name="id-complemento[]" value="<?= $com->getId(); ?>" >
                <label><?= $com->getNome(); ?></label>
                <input type="checkbox" class="check-complemento" name="complemento-ativo[]">
            </div>
        <?php endforeach; ?>
    </div>
    
    <input type="submit" value="Criar Produto" class="criar-produto"> 
</form>