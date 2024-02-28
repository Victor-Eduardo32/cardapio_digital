<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/complemento/complementodao.php';
require_once '../../../model/DAO/gestor/complemento/itemdao.php';

$nomeComplemento = $_POST['nome-complemento'];
$descricaoComplemento = $_POST['descricao-complemento'];
$minSelComplemento = $_POST['min-selecionavel-complemento'];
$maxSelComplemento = $_POST['max-selecionavel-complemento'];
$tipoComplemento = $_POST['tipo-complemento'];
$valorMaior = $_POST['valor-maior'] == '0' ? $_POST['valor-maior'] = [0] : $_POST['valor-maior'] = 1;
$data = date('Y-m-d  H:i:s', time());

$nomesItens = $_POST['nome-item'];
$descricoesItens = $_POST['descricao-item'];
$valoresItens = $_POST['valor-item'];
$ativoItem = 1;

if($nomeComplemento && $descricaoComplemento && $minSelComplemento >= 0 && $maxSelComplemento && $tipoComplemento && $valorMaior){
    $c = new Complemento();
    $complementoDao = new daoMysqlComplemento($pdo);

    $c->setNome($nomeComplemento);
    $c->setDescricao($descricaoComplemento);
    $c->setMinimoSel($minSelComplemento);
    $c->setMaximoSel($maxSelComplemento);
    $c->setTipo($tipoComplemento);
    $c->setValorMaior($valorMaior);
    $c->setDate($data);
    $complementoDao->add($c);

    foreach($nomesItens as $indice => $nomeItem){
        $descricaoItem = $descricoesItens[$indice];
        $valorItem = $valoresItens[$indice];

        $itemDao = new daoMysqlItem($pdo, $c->getId());
        $i = new Item();

        $i->setNome($nomeItem);
        $i->setDescricao($descricaoItem);
        $i->setValor($valorItem);
        $i->setAtivo($ativoItem);
        $itemDao->add($i);
    }

    header('Location: ../../../view/admin/gestor?url=complementos');
} else {
    header('Location: ../../../view/admin/gestor?url=complementos');
}

?>