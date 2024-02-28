<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/complemento/complementodao.php';
require_once '../../../model/DAO/gestor/complemento/itemdao.php';

// Dados do complemento
$idComplemento = $_POST['id-complemento'];
$nomeComplemento = $_POST['nome-complemento'];
$descricaoComplemento = $_POST['descricao-complemento'];
$minSelComplemento = $_POST['min-selecionavel-complemento'];
$maxSelComplemento = $_POST['max-selecionavel-complemento'];
$tipoComplemento = $_POST['tipo-complemento'];
$valorMaior = $_POST['valor-maior'] == '0' ? $_POST['valor-maior'] = [0] : $_POST['valor-maior'] = 1;

// Dados dos Itens
$idsItens = $_POST['id-item'];
$nomesItens = $_POST['nome-item'];
$descricoesItens = $_POST['descricao-item'];
$valoresItens = $_POST['valor-item'];
$ativoItem = 1;

// Dados para inativar/ativar um item
$idsAtivos = $_POST['inativo-complemento'];
$idsAtivos = explode(',', $idsAtivos[0]);
$trocarAtivo = $_POST['valor-ativo-complemento'];
$trocarAtivo = explode(',', $trocarAtivo[0]);

// Dados para remover um item
$idsRemovidos = $_POST['id-item-removido'];
$idsRemovidos = explode(',', $idsRemovidos[0]);

if($idComplemento && $nomeComplemento && $descricaoComplemento && $minSelComplemento >= 0 && $maxSelComplemento && $tipoComplemento && $valorMaior){
    $c = new Complemento();
    $complementoDao = new daoMysqlComplemento($pdo);

    $c->setID($idComplemento);
    $c->setNome($nomeComplemento);
    $c->setDescricao($descricaoComplemento);
    $c->setMinimoSel($minSelComplemento);
    $c->setMaximoSel($maxSelComplemento);
    $c->setTipo($tipoComplemento);
    $c->setValorMaior($valorMaior);
    $complementoDao->atualizar($c); 

    // Transforma cada item do array para ser trabalhado de forma individual ao invés do array
    // Adicionar ou editar um item
    foreach($nomesItens as $indice => $nomeItem){
        $descricaoItem = $descricoesItens[$indice];
        $valorItem = $valoresItens[$indice];
        $idItem = $idsItens[$indice];

        $itemDao = new daoMysqlItem($pdo, $idComplemento);
        $i = new Item();
        
        // Faz a verificação se o id veio vazio, se sim, ele adiciona no BD, se não, ele puxa o id do item e faz a alteração dele com base no id
        if(empty($idItem)){
            $i->setNome($nomeItem);
            $i->setDescricao($descricaoItem);
            $i->setValor($valorItem);
            $i->setAtivo(1);
            $itemDao->add($i);
        } else {
            $i->setID($idItem);
            $i->setNome($nomeItem);
            $i->setDescricao($descricaoItem);
            $i->setValor($valorItem);
            $i->setAtivo($i->getAtivo());
            $i->setComplemento($idComplemento);
            $itemDao->atualizar($i);
        }
    }
    
    // Inativar ou Ativar um Item
    foreach ($idsAtivos as $key => $idAtivo) {
        $item = new Item();
        $item->setId($idAtivo);
        $item->setAtivo($trocarAtivo[$key]);
        $item->setComplemento($idComplemento);
        $itemDao->inativarAtivar($item);
    }

    // Excluir um item
    foreach ($idsRemovidos as $idRemovido) {
        $itemDao->excluir($idRemovido);
    }

    header('Location: ../../../view/admin/gestor?url=complementos');
}

?>