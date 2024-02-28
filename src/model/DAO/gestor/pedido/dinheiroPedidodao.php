<?php 

require __DIR__ . '/../../../class/gestor/pedido/dinheiroPedido.php';

class daoMySqlDinheiroPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }
    
    public function addTroco(DinheiroPedido $ep){
        $sql = $this->pdo->prepare('INSERT INTO dinheiro_pedido (id_pedido, confirmacao_troco, troco) VALUES (:pedido, :confirmacao, :troco)');
        $sql->bindValue(':pedido', $ep->getIdPedido());
        $sql->bindValue(':confirmacao', $ep->getConfirmacaoTroco());
        $sql->bindValue(':troco', $ep->getTroco());
        $sql->execute();

        $ep->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarTroco(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM dinheiro_pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach ($dados as $item) {
                $dinheiro = new DinheiroPedido();
                $dinheiro->setId($item['id']);
                $dinheiro->setIdPedido($item['id_pedido']);
                $dinheiro->setConfirmacaoTroco($item['confirmacao_troco']);
                $dinheiro->setTroco($item['troco']);

                $lista[] = $dinheiro;
            }

            return $lista;
        }
    }
    
}


?>