<?php 
require __DIR__ . '/../../../class/gestor/relatorio/enderecoRelatorio.php';

class daoMySqlEnderecoRelatorio{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;   
    }

    public function add(EnderecoRelatorio $cr){
        $sql = $this->pdo->prepare('INSERT INTO endereco_cliente_relatorio (id_cliente_relatorio, rua_cliente_relatorio, numero_endereco_relatorio, bairro_cliente_relatorio) VALUES (:id_cliente_relatorio, :rua, :numero_casa, :bairro)');
        $sql->bindValue(':id_cliente_relatorio', $cr->getIdCliente());
        $sql->bindValue(':rua', $cr->getRua());
        $sql->bindValue(':numero_casa', $cr->getNumeroCasa());
        $sql->bindValue(':bairro', $cr->getBairro());
        $sql->execute();

        $cr->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarBairros($dataInicial = null, $dataFinal = null){
        $lista = [];

        $sql = $this->pdo->prepare('SELECT bairro_cliente_relatorio, COUNT(id_cliente_relatorio) as total_pedidos FROM endereco_cliente_relatorio ec INNER JOIN clientes_relatorio cl ON ec.id_cliente_relatorio = cl.id INNER JOIN pedidos_relatorio pr ON cl.id_pedido_relatorio = pr.id WHERE pr.tempo_finalizado BETWEEN :data_inicial AND :data_final GROUP BY bairro_cliente_relatorio HAVING total_pedidos > 0 ORDER BY total_pedidos DESC LIMIT 5');
        $sql->bindValue(':data_inicial', $dataInicial);
        $sql->bindValue(':data_final', $dataFinal);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $endereco = new EnderecoRelatorio();
                $endereco->setBairro($item['bairro_cliente_relatorio']);
                $endereco->setTotalPedidos($item['total_pedidos']);

                $lista[] = $endereco;
            }

            return $lista;
        }


    }
}


?>