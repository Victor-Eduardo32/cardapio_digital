<?php 
require __DIR__ . '/../../../class/gestor/relatorio/clientesRelatorio.php';

class daoMySqlClienteRelatorio{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;   
    }

    public function add(ClientesRelatorio $cr){
        $sql = $this->pdo->prepare('INSERT INTO clientes_relatorio (id_pedido_relatorio, nome_cliente_relatorio, telefone_cliente_relatorio) VALUES (:id_pedido_relatorio, :nome, :telefone)');
        $sql->bindValue(':id_pedido_relatorio', $cr->getIdPedido());
        $sql->bindValue(':nome', $cr->getNome());
        $sql->bindValue(':telefone', $cr->getTelefone());
        $sql->execute();

        $cr->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarCliente($dataInicial = null, $dataFinal = null){
    $lista = [];
    $sql = $this->pdo->prepare('SELECT nome_cliente_relatorio, telefone_cliente_relatorio, COUNT(id_pedido_relatorio) as total_pedidos FROM clientes_relatorio cl INNER JOIN pedidos_relatorio pr ON cl.id_pedido_relatorio = pr.id WHERE pr.tempo_finalizado BETWEEN :data_inicial AND :data_final GROUP BY nome_cliente_relatorio, telefone_cliente_relatorio HAVING total_pedidos > 0 ORDER BY total_pedidos DESC LIMIT 3
    ');
    $sql->bindValue(':data_inicial', $dataInicial);
    $sql->bindValue(':data_final', $dataFinal);
    $sql->execute();

    if($sql->rowCount() > 0){
        $dados = $sql->fetchAll();

        foreach($dados as $item){
            $cliente = new ClientesRelatorio();
            $cliente->setNome($item['nome_cliente_relatorio']);
            $cliente->setTelefone($item['telefone_cliente_relatorio']);
            $cliente->setTotalPedidos($item['total_pedidos']);
            
            $lista[] = $cliente;
        }

        return $lista;
    }
}
}


?>