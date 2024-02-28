<?php 

require __DIR__ . '/../../../class/gestor/relatorio/pedidosRelatorio.php';

class daoMySqlPedidosRelatorios{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function add(PedidosRelatorio $pr){
        $sql = $this->pdo->prepare('INSERT INTO pedidos_relatorio (valor_compra_relatorio, tipo_entrega_relatorio, valor_entrega_relatorio) VALUES (:valor_compra, :tipo_entrega, :valor_entrega)');
        $sql->bindValue(':valor_compra', $pr->getValorCompra());
        $sql->bindValue(':tipo_entrega', $pr->getTipoEntrega());
        $sql->bindValue(':valor_entrega', $pr->getValorEntrega());
        $sql->execute();

        $pr->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarTempo(){
        $lista = [];
        $sql = $this->pdo->query('SELECT tempo_finalizado FROM pedidos_relatorio');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $pedido = new PedidosRelatorio();
                $pedido->setTempo($item['tempo_finalizado']);

                $lista[] = $pedido;
            }

            return $lista;
        }
    }


    public function listarQuantidadePorTipoEntrega($dataInicial = null, $dataFinal = null){
        $sql = $this->pdo->prepare('SELECT tipo_entrega_relatorio, COUNT(*) AS quantidade FROM pedidos_relatorio pr WHERE pr.tempo_finalizado BETWEEN :data_inicial AND :data_final GROUP BY tipo_entrega_relatorio');
        $sql->bindValue(':data_inicial', $dataInicial);
        $sql->bindValue(':data_final', $dataFinal);
        $sql->execute();

        $quantidadeRetirada = 0;
        $quantidadeEntrega = 0;
    
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
    
            foreach($dados as $item){
                if ($item['tipo_entrega_relatorio'] == 'Retirada') {
                    $quantidadeRetirada = $item['quantidade'];
                } elseif ($item['tipo_entrega_relatorio'] == 'Entrega') {
                    $quantidadeEntrega = $item['quantidade'];
                }
            }
        }
    
        return ['quantidadeRetirada' => $quantidadeRetirada, 'quantidadeEntrega' => $quantidadeEntrega];
    }

    public function listarFaturamento($dataInicial = null, $dataFinal = null){
        $sql = $this->pdo->prepare('SELECT * FROM pedidos_relatorio pr WHERE pr.tempo_finalizado BETWEEN :data_inicial AND :data_final');
        $sql->bindValue(':data_inicial', $dataInicial);
        $sql->bindValue(':data_final', $dataFinal);
        $sql->execute();

        $valorEntrega = 0;
        $valorPedidoEntrega = 0;
        $valorPedidoRetirada = 0;

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                if($item['tipo_entrega_relatorio'] == 'Entrega'){
                    $valorEntrega += $item['valor_entrega_relatorio'];
                    $valorPedidoEntrega += $item['valor_compra_relatorio'];
                } elseif ($item['tipo_entrega_relatorio'] == 'Retirada'){
                    $valorPedidoRetirada += $item['valor_compra_relatorio'];
                }
            }
        }

        return ['valorCompraRetirada' => $valorPedidoRetirada, 'valorCompraEntrega' => $valorPedidoEntrega, 'valorEntrega' => $valorEntrega];
    }
}


?>