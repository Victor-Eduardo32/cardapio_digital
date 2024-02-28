<?php 
require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/pedido/pedidodao.php';
require_once '../../../model/DAO/gestor/pedido/clientePedidodao.php';
require_once '../../../model/DAO/gestor/pedido/enderecoPedidodao.php';
require_once '../../../model/DAO/gestor/pedido/dinheiroPedidodao.php';
require_once '../../../model/DAO/gestor/pedido/cartaoPedidodao.php';
require_once '../../../model/DAO/gestor/pedido/produtoPedidodao.php';
require_once '../../../model/DAO/gestor/pedido/itensPedidodao.php';

require_once '../../../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php';
require_once '../../../model/DAO/cardapio/carrinho/itensCarrinhoDao.php';

$valorCompra = $_POST['valor-compra'];
$entregaSelecionado = $_POST['entrega-selecionado'];
$retirarSelecionado = $_POST['retirar-selecionado'];
$dinheiroSelecionado = $_POST['dinheiro-selecionado'];
$cartaoSelecionado = $_POST['cartao-selecionado'];

$nomeCliente = $_POST['nome-cliente'];
$telefoneCliente = $_POST['telefone-cliente'];

$nomeBairroSelecionado = $_POST['nome-bairro-selecionado'];
$valorBairroSelecionado = $_POST['valor-bairro-selecionado'];
$rua = $_POST['rua'];
$numeroCasa = $_POST['numero-casa'];
$referencia = $_POST['referencia'];

$tipoCartao = $_POST['tipo-cartao-selecionado'];

$semTroco = isset($_POST['sem-troco']) ? 1 : 0;
$comTroco = isset($_POST['com-troco']) ? 1 : 0;
$troco = ($comTroco == 1) ? $_POST['valor-troco'] : 0;

$pedidoDao = new daoMySqlPedido($pdo);
$clienteDao = new daoMySqlClientePedido($pdo);
$enderecoDao = new daoMySqlEnderecoPedido($pdo);
$dinheiroDao = new daoMySqlDinheiroPedido($pdo);
$cartaoDao = new daoMySqlCartaoPedido($pdo);
$produtoDao = new daoMySqlProdutoPedido($pdo);
$itensDao = new daoMySqlItensPedido($pdo);

$produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);
$itensCarrinhoDao = new daoMySqlItensCarrinho($pdo);

if($valorCompra && $dinheiroSelecionado || $cartaoSelecionado && $entregaSelecionado || $retirarSelecionado){
    $pedido = new Pedido();
    $pedido->setValorCompra($valorCompra);

    if($dinheiroSelecionado == 1){
        $pedido->setPagamento('Dinheiro');
    } else if($cartaoSelecionado == 1){
        $pedido->setPagamento('Cartão');
    }

    if($retirarSelecionado == 1){
        $pedido->setEntrega('Retirada');
    } else if($entregaSelecionado == 1){
        $pedido->setEntrega('Entrega');
    }
    
    $pedido->setEstado(1);

    // Verificar se o dados do cliente vieram
    if($nomeCliente && $telefoneCliente){
        // Verificar se o cliente colocou todos os dados de pagamento corretamente
        if((($dinheiroSelecionado == 1 && $comTroco == 1 && $troco > 0) || ($dinheiroSelecionado == 1 && $semTroco == 1)) || ($cartaoSelecionado == 1 && $tipoCartao)){
            
            // Verificar se o cliente colocou todos os dados de entrega corretamente
            if(($entregaSelecionado == 1 && $nomeBairroSelecionado && $valorBairroSelecionado && $rua && $numeroCasa && $referencia) || $retirarSelecionado == 1){
                $operacaoBemSucedida = false;

                try {
                    $pedidoDao->addPedido($pedido);

                    // Adicionar Cliente
                    $cliente = new ClientePedido();
                    $cliente->setIdPedido($pedido->getId());
                    $cliente->setNome($nomeCliente);
                    $cliente->setTelefone($telefoneCliente);

                    $clienteDao->addCliente($cliente);
        
                    // Caso o cliente optar por entrega, adicionar endereço
                    if($entregaSelecionado == 1){
                        $endereco = new EnderecoPedido();
                        $endereco->setIdPedido($pedido->getId());
                        $endereco->setBairro($nomeBairroSelecionado);
                        $endereco->setValorEntrega($valorBairroSelecionado);
                        $endereco->setRua($rua);
                        $endereco->setNumero($numeroCasa);
                        $endereco->setReferencia($referencia);
                        $enderecoDao->addEndereco($endereco);
                    }

                    // Caso o cliente optar por pagar em cartao
                    if($cartaoSelecionado == 1){
                        $cartao = new CartaoPedido();
                        $cartao->setIdPedido($pedido->getId());
                        $cartao->setTipoCartao($tipoCartao);
            
                        $cartaoDao->addCartao($cartao);
                    }
            
                    // Caso o cliente optar por pagar em dinheiro
                    if($dinheiroSelecionado == 1){
                        $dinheiro = new DinheiroPedido();
                        $dinheiro->setIdPedido($pedido->getId());
            
                        if($comTroco == 1){
                            $dinheiro->setConfirmacaoTroco('Sim');
                            $dinheiro->setTroco($troco);
                        } else if($semTroco == 1){
                            $dinheiro->setConfirmacaoTroco('Não');
                            $dinheiro->setTroco($troco);
                        }
                        
                        $dinheiroDao->addTroco($dinheiro);
                    }

                    // Armazenar todos os produtos do carrinho em array para adiciona-los no pedido
                    $listarProdutoCarrinho = $produtoCarrinhoDao->listar();

                    foreach($listarProdutoCarrinho as $lpc){
                        $nomeProdutoCarrinho[] = $lpc->getNome();
                        $quantidadeProdutoCarrinho[] = $lpc->getQuantidade();
                        $idsProdutoCarrinho[] = $lpc->getId();
                    }
                    
                    foreach($nomeProdutoCarrinho as $key => $nomeProduto){
                        $quantidadeProduto = $quantidadeProdutoCarrinho[$key];
                        $idProduto = $idsProdutoCarrinho[$key];

                        // Mover todos os produtos do carrinho para o pedido
                        $produto = new ProdutosPedido();
                        $produto->setIdPedido($pedido->getId());
                        $produto->setNome($nomeProduto);
                        $produto->setQuantidade($quantidadeProduto);

                        $produtoDao->addProdutos($produto);

                        // Mover todos os itens dos produtos do carrinho para o pedido
                        $itens = new ItensPedido();
                        $itens->setIdProduto($produto->getId());

                        $itensDao->addItens($itens, $idProduto);
                    }
                    
                    // Se chegou até aqui, ambas as funções foram executadas corretamente
                    $operacaoBemSucedida = true;

                } catch (Exception $e) {
                    echo "Erro ao executar o pedido: " . $e->getMessage();
                }

                if ($operacaoBemSucedida) {
                    // Limpar todo o carrinho caso os produtos e itens tenham sido adicionados ao pedido corretamente
                    $produtoDao->excluirProdutosCarrinho();
                }

                header('Location: ../../../../index.php');

            } else {
                header('Location: ../../../view/finalizar.php');
            }
        } else {
            header('Location: ../../../view/finalizar.php');
        }
    } else {
        header('Location: ../../../view/finalizar.php');
    }
} else {
    header('Location: ../../../view/finalizar.php');
}

?>