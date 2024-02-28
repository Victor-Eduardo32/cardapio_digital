<?php 

require __DIR__ . '/../../../class/gestor/relatorio/produtosRelatorio.php';

class daoMySqlProdutosRelatorio{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function add(ProdutosRelatorio $pr, $idPedido){
        $lista = [];

        $sql = $this->pdo->prepare('INSERT INTO produtos_relatorio (id_pedido_relatorio, nome_produto_relatorio, quantidade_produto_relatorio) SELECT :id_pedido_relatorio, nome_produto_pedido, quantidade_produto_pedido FROM produtos_pedido WHERE id_pedido = :id_pedido');
        $sql->bindValue(':id_pedido_relatorio', $pr->getIdPedido());
        $sql->bindValue(':id_pedido', $idPedido);
        $sql->execute();

        $pr->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarProduto($dataInicial = null, $dataFinal = null){
        $lista = [];

        $sql = $this->pdo->prepare('SELECT nome_produto_relatorio, SUM(quantidade_produto_relatorio) AS quantidade_somada FROM produtos_relatorio pr INNER JOIN pedidos_relatorio pe ON pr.id_pedido_relatorio = pe.id WHERE pe.tempo_finalizado BETWEEN :data_inicial AND :data_final GROUP BY nome_produto_relatorio HAVING quantidade_somada > 0 ORDER BY quantidade_somada DESC LIMIT 5');
        $sql->bindValue(':data_inicial', $dataInicial);
        $sql->bindValue(':data_final', $dataFinal);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $produto = new ProdutosRelatorio();
                $produto->setNome($item['nome_produto_relatorio']);
                $produto->setQuantidade($item['quantidade_somada']);

                $lista[] = $produto;
            }

            return $lista;
        }
    }
    
}



?>