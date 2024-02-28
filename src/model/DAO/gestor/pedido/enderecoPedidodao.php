<?php 

require __DIR__ . '/../../../class/gestor/pedido/enderecoPedido.php';

class daoMySqlEnderecoPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addEndereco(EnderecoPedido $ep){
        $sql = $this->pdo->prepare('INSERT INTO endereco_pedido (id_pedido, bairro_endereco_pedido, valor_entrega_pedido, rua_endereco_pedido, numero_endereco_pedido, referencia_endereco_pedido) VALUES (:pedido, :bairro, :valor, :rua, :numero, :referencia)');
        $sql->bindValue(':pedido', $ep->getIdPedido());
        $sql->bindValue(':bairro', $ep->getBairro());
        $sql->bindValue(':valor', $ep->getValorEntrega());
        $sql->bindValue(':rua', $ep->getRua());
        $sql->bindValue(':numero', $ep->getNumero());
        $sql->bindValue(':referencia', $ep->getReferencia());
        $sql->execute();

        $ep->setId($this->pdo->lastInsertId());
        return true;
    }

    public function setarIdPedido($id){
        $sql = $this->pdo->prepare('SELECT * FROM endereco_pedido WHERE id_pedido = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();

            $endereco = new EnderecoPedido();
            $endereco->setId($dados['id']);
            $endereco->setIdPedido($dados['id_pedido']);
            $endereco->setBairro($dados['bairro_endereco_pedido']);
            $endereco->setValorEntrega($dados['valor_entrega_pedido']);
            $endereco->setRua($dados['rua_endereco_pedido']);
            $endereco->setNumero($dados['numero_endereco_pedido']);
            $endereco->setReferencia($dados['referencia_endereco_pedido']);

            return $endereco;
        } else {
            return false;
        }
    }

    public function listarEndereco(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM endereco_pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $endereco = new EnderecoPedido();
                $endereco->setId($item['id']);
                $endereco->setIdPedido($item['id_pedido']);
                $endereco->setBairro($item['bairro_endereco_pedido']);
                $endereco->setValorEntrega($item['valor_entrega_pedido']);
                $endereco->setRua($item['rua_endereco_pedido']);
                $endereco->setNumero($item['numero_endereco_pedido']);
                $endereco->setReferencia($item['referencia_endereco_pedido']);

                $lista[] = $endereco;
            }

            return $lista;
        }
    }
    
}


?>