<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/categoriadao.php';

$categoria = new daoMysqlCategoria($pdo);

$id = $_POST['id'];
$nome = $_POST['nome'];
$ordem = $_POST['ordem'];
$hora_inicial = $_POST['hora-inicial'];
$hora_final = $_POST['hora-final'] == '' ? $_POST['hora-final'] = '23:59' : $_POST['hora-final'];
$disponivel = isset($_POST['disponivel']) ? $_POST['disponivel'] = 1 : $_POST['disponivel'] = [0];
$imagem = $_POST['imagem'];

if($id && $nome && $ordem && $hora_inicial !== null && $hora_final !== null && $disponivel != null){
    $c = new Categoria();
    $c->setId($id);
    $c->setNome($nome);
    $c->setOrdem($ordem);
    $c->setHoraInicial($hora_inicial);
    $c->setHoraFinal($hora_final);
    $c->setDisponivel($disponivel);
    $c->setImagem($imagem);

    $categoria->atualizar($c);
    header('Location: ../../../view/admin/gestor?url=categorias'); 
} else {
    header('Location: ../../../view/admin/gestor?url=categorias'); 
}

?>