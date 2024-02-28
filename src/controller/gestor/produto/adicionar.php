<?php 

require '../../../../config.php';
require '../../../model/DAO/gestor/produtodao.php';
require '../../../model/DAO/gestor/produtoComplementodao.php';

$produto_dao = new daoMysqlProduto($pdo);
$produtoComplementoDao = new daoMysqlProdutoComplemento($pdo);

$categoria = $_POST['categoria'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$ordem = $_POST['ordem'];
$valor = $_POST['valor'];
$hora_inicial = $_POST['hora-inicial'];
$hora_final = $_POST['hora-final'] == '' ? $_POST['hora-final'] = '23:59' : $_POST['hora-final'];
$disponivel = isset($_POST['disponivel']) ? $_POST['disponivel'] = 1 : [0];
$ativo = 1;
$imagem = $_POST['imagem'];

$idsComplementos = $_POST['id-complemento'];
$selecionados = $_POST['complemento-ativo'];

if($nome && $descricao && $ordem && $valor && $hora_inicial !== null && $hora_final !== null && $disponivel){
    $p = new Produto();
    $p->setIDC($categoria);
    $p->setNome($nome);
    $p->setDescricao($descricao);
    $p->setOrdem($ordem);
    $p->setValor($valor);
    $p->setHoraInicial($hora_inicial);
    $p->setHoraFinal($hora_final);
    $p->setDisponivel($disponivel);
    $p->setAtivo($ativo);
    $p->setImagem($imagem);

    $produto_dao->add($p);

    foreach($idsComplementos  as $key => $idComplemento){
        $selecionado = $selecionados[$key];
        $selecionado = isset($selecionado) ? $selecionado = 1 : [0];

        $pc = new ProdutoComplemento();
        $pc->setIDProduto($p->getId());
        $pc->setIDComplemento($idComplemento);
        $pc->setSelecionado($selecionado);
        $produtoComplementoDao->add($pc);
    }

    header('Location: ../../../view/admin/gestor?url=produtos');
} else {
    header('Location: ../../../view/admin/gestor?url=produtos');
}


?>