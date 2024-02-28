<?php 

require '../../../../config.php';
require '../../../model/DAO/gestor/produtodao.php';
require '../../../model/DAO/gestor/produtoComplementodao.php';
 
$produtoDao = new daoMysqlProduto($pdo);

$id = $_POST['id'];
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

$idsProdutoComplemento = $_POST['id-produto-complemento'];
$idsComplementos = $_POST['id-complemento'];
$selecionados = $_POST['complemento-ativo'];


if($id && $nome && $descricao && $ordem && $valor && $hora_inicial !== null && $hora_final !== null && $disponivel){
    $p = new Produto();
    $p->setId($id);
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

    $produtoDao->atualizar($p);

    foreach($idsComplementos as $key => $idComplemento){
        $idProdutoComplemento = $idsProdutoComplemento[$key];
        $selecionado = $selecionados[$key];

        $produtoComplementoDao = new daoMysqlProdutoComplemento($pdo);
        $pc = new ProdutoComplemento();

        if (isset($idProdutoComplemento)) {
            $pc->setID($idProdutoComplemento);
            $pc->setIDProduto($id);
            $pc->setIDComplemento($idComplemento);
            $pc->setSelecionado($selecionado);
            $produtoComplementoDao->atualizar($pc);
        } else {
            $pc->setIDProduto($id);
            $pc->setIDComplemento($idComplemento);
            $pc->setSelecionado($selecionado);
            $produtoComplementoDao->add($pc);
        }
    }
    
    header('Location: ../../../view/admin/gestor?url=produtos');
} else {
    header('Location: ../../../view/admin/gestor?url=produtos');
}


?>