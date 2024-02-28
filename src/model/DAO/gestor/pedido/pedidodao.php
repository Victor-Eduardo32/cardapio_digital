<?php 

require __DIR__ . '/../../../class/gestor/pedido/pedido.php';

class daoMySqlPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addPedido(Pedido $p){
        $sql = $this->pdo->prepare('INSERT INTO pedido (valor_compra_pedido, metodo_pagamento, metodo_entrega, estado_pedido) VALUES (:valor, :pagamento, :entrega, :estado)');
        $sql->bindValue(':valor', $p->getValorCompra());
        $sql->bindValue(':pagamento', $p->getPagamento());
        $sql->bindValue(':entrega', $p->getEntrega());
        $sql->bindValue(':estado', $p->getEstado());
        $sql->execute();

        $p->setId($this->pdo->lastInsertId());
        return true;
    }

    public function cancelar($id){
        $sql = $this->pdo->prepare('DELETE FROM pedido WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function atualizarStatus($id){
        $sql = $this->pdo->prepare('UPDATE pedido SET estado_pedido = estado_pedido + 1 WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function setarId($id){
        $sql = $this->pdo->prepare('SELECT * FROM pedido WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();

            $pedido = new Pedido();
            $pedido->setId($dados['id']);
            $pedido->setValorCompra($dados['valor_compra_pedido']);
            $pedido->setPagamento($dados['metodo_pagamento']);
            $pedido->setEntrega($dados['metodo_entrega']);
            $pedido->setEstado($dados['estado_pedido']);

            return $pedido;
        } else {
            return false;
        }
    }

    public function listarPedido(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $pedido = new Pedido();
                $pedido->setId($item['id']);
                $pedido->setValorCompra($item['valor_compra_pedido']);
                $pedido->setPagamento($item['metodo_pagamento']);
                $pedido->setEntrega($item['metodo_entrega']);
                $pedido->setEstado($item['estado_pedido']);

                $lista[] = $pedido;
            }

            return $lista;
        }
    }
    
}


?>