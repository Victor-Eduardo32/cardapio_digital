<?php 

$categoria = new daoMysqlCategoria($pdo);

$id = isset($_GET['id']) ? $_GET['id'] : null;

if(!$id){
    header("Location: ?url=404");
    exit();
}

$c = $categoria->setarID($id);

?>

<a href="?url=categorias" class="retornar-edit-categoria">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p>
</a><!--retornar-->

<form class="campos-dados-categoria" method="post" action='../../controller/gestor/categoria/editar.php'>
    
    <h4>Editar Categoria</h4>
    <input type="hidden" name="id" value="<?= $c->getId(); ?>">
    <div class="form-group-categoria">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-input nome-categoria" placeholder="Nome da Categoria" value="<?= $c->getNome(); ?>" require>
    </div><!--form-group-categoria-->
    <div class="form-group-categoria">
        <label for="ordem" class="form-label">Ordem</label>
        <input type="number" name="ordem" class="form-input ordem-categoria" placeholder="Ordem da Categoria" value="<?= $c->getOrdem(); ?>" require>
    </div><!--form-group-categoria-->
    <p>Deixe a opção "sempre disponível" ligada caso deseje deixar disponível durante todo o funcionamento do estabelescimento, caso contrário, defina o horário com a opção desligada.</p>
    <div class="form-group-categoria">
        <label for="hora-inicial" class="form-label">Horário Inicial</label>
        <input type="text" name="hora-inicial" class="form-input hora-inicial" placeholder="00:00" value="<?= $c->getHoraInicial(); ?>" onfocus="this.type='time'">
    </div><!--form-group-categoria-->
    <div class="form-group-categoria">
        <label for="hora-final" class="form-label">Horário Final</label>
        <input type="text" name="hora-final" class="form-input hora-final" placeholder="23:59" value="<?= $c->getHoraFinal(); ?>" onfocus="this.type='time'" onblur="this.type='text'" >
    </div><!--form-group-categoria-->
    <div class="form-group-categoria">
        <label for="sempre-disponível" class="form-label">Sempre disponível</label>
        <input type="checkbox" name="disponivel" class="form-input check-disponivel" <?= $c->getDisponivel() == 1 ? 'checked' : ''; ?>> 
    </div><!--form-group-categoria-->
    <div class="form-group-categoria upload">
        <label for="" class="form-label">Icone</label>
        <input type="url" name="imagem" accept="image/png" class="form-input" placeholder="https://" value="<?= $c->getImagem(); ?>">
    </div><!--form-group-categoria upload-->
    
    <input type="submit" value="Editar Categoria" class="editar-categoria"> 
</form>