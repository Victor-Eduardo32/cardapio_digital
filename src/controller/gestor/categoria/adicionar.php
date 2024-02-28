<?php 

    require_once '../../../../config.php';
    require_once '../../../model/DAO/gestor/categoriadao.php';

    $categoria = new daoMysqlCategoria($pdo);

    $nome = $_POST['nome'];
    $ordem = $_POST['ordem'];
    $hora_inicial = $_POST['hora-inicial'];
    $hora_final = $_POST['hora-final'] == '' ? $_POST['hora-final'] = '23:59' : $_POST['hora-final'];
    $disponivel = isset($_POST['disponivel']) ? $_POST['disponivel'] = 1 : $_POST['disponivel'] = [0];
    $ativo = 1;
    $icone = $_POST['icone'];

    if($nome && $ordem && $hora_inicial !== null && $hora_final !== null && $disponivel != null){
        $c = new Categoria();
        $c->setNome($nome);
        $c->setOrdem($ordem);
        $c->setHoraInicial($hora_inicial);
        $c->setHoraFinal($hora_final);
        $c->setDisponivel($disponivel);
        $c->setAtivo($ativo);
        $c->setImagem($icone);

        $categoria->add($c);
        header('Location: ../../../view/admin/gestor?url=categorias');
    } else {
        header('Location: ../../../view/admin/gestor?url=categorias');
    }

?>