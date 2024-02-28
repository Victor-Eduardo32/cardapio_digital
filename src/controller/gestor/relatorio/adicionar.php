<?php 

require_once '../../../../config.php';
require_once '../../../model/DAO/gestor/pedido/pedidodao.php';
require_once '../../../model/DAO/gestor/pedido/clientePedidodao.php';
require_once '../../../model/DAO/gestor/pedido/enderecoPedidodao.php';

require_once '../../../model/DAO/gestor/relatorio/pedidosRelatoriodao.php';
require_once '../../../model/DAO/gestor/relatorio/clientesRelatoriodao.php';
require_once '../../../model/DAO/gestor/relatorio/enderecoRelatoriodao.php';
require_once '../../../model/DAO/gestor/relatorio/produtosRelatoriosdao.php';

$id = $_GET['id'];

$pedidoDao = new daoMySqlPedido($pdo);
$setarPedido = $pedidoDao->setarId($id);
$enderecoDao = new daoMySqlEnderecoPedido($pdo);
$setarEndereco = $enderecoDao->setarIdPedido($id);
$clienteDao = new daoMySqlClientePedido($pdo);
$setarCliente = $clienteDao->setarIdPedido($id);

// Dados para a tebela de Pedidos Relatório
$valorCompra = $setarPedido->getValorCompra();
$tipoEntrega = $setarPedido->getEntrega();
$valorEntrega = ($setarEndereco !== false) ? $setarEndereco->getValorEntrega() : 0;

// Dados para a tabela de Clientes Relatório
$nomeCliente = $setarCliente->getNome();
$telefoneCliente = $setarCliente->getTelefone();

// Dados para a tabela de Enderço Relatório
$rua = ($setarEndereco !== false) ? $setarEndereco->getRua() : 0;
$numeroCasa = ($setarEndereco !== false) ? $setarEndereco->getNumero() : 0;
$bairro = ($setarEndereco !== false) ? $setarEndereco->getBairro() : 0;

$pedidoRelatorioDao = new daoMySqlPedidosRelatorios($pdo);
$clienteRelatorioDao = new daoMySqlClienteRelatorio($pdo);
$enderecoRelatorioDao = new daoMySqlEnderecoRelatorio($pdo);
$produtoRelatorioDao = new daoMySqlProdutosRelatorio($pdo);

if($valorCompra && $tipoEntrega){
    if($nomeCliente && $telefoneCliente){
        $pedido = new PedidosRelatorio();
        $pedido->setValorCompra($valorCompra);
        $pedido->setTipoEntrega($tipoEntrega);
        $pedido->setValorEntrega($valorEntrega);
        $pedidoRelatorioDao->add($pedido);

        $cliente = new ClientesRelatorio();
        $cliente->setIdPedido($pedido->getId());
        $cliente->setNome($nomeCliente);
        $cliente->setTelefone($telefoneCliente);
        $clienteRelatorioDao->add($cliente);

        if($pedido->getTipoEntrega() == 'Entrega' && $setarEndereco !== false){
            $endereco = new EnderecoRelatorio();
            $endereco->setIdCliente($cliente->getId());
            $endereco->setRua($rua);
            $endereco->setNumeroCasa($numeroCasa);
            $endereco->setBairro($bairro);

            $enderecoRelatorioDao->add($endereco);
        }

        $produto = new ProdutosRelatorio();
        $produto->setIdPedido($pedido->getId());
        $produtoRelatorioDao->add($produto, $id);

        $pedidoDao->cancelar($id);

        Header('Location: ../../../view/admin/gestor?url=pedidos');
    
    }
}


?>