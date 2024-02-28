<?php 

require __DIR__ . '/../../../class/gestor/pedido/clientePedido.php';

class daoMySqlClientePedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addCliente(ClientePedido $cp){
        $sql = $this->pdo->prepare('INSERT INTO cliente_pedido (id_pedido, nome_cliente_pedido, telefone_cliente_pedido) VALUES (:pedido, :nome, :telefone)');
        $sql->bindValue(':pedido', $cp->getIdPedido());
        $sql->bindValue(':nome', $cp->getNome());
        $sql->bindValue(':telefone', $cp->getTelefone());
        $sql->execute();

        $cp->setId($this->pdo->lastInsertId());
        return true;
    }

    public function setarIdPedido($id){
        $sql = $this->pdo->prepare('SELECT * FROM cliente_pedido WHERE id_pedido = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();

            $cliente = new ClientePedido();
            $cliente->setId($dados['id']);
            $cliente->setIdPedido($dados['id_pedido']);
            $cliente->setNome($dados['nome_cliente_pedido']);
            $cliente->setTelefone($dados['telefone_cliente_pedido']);

            return $cliente;
        } else {
            return false;
        }
    }

    public function listarCliente(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM cliente_pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $cliente = new ClientePedido();
                $cliente->setId($item['id']);
                $cliente->setIdPedido($item['id_pedido']);
                $cliente->setNome($item['nome_cliente_pedido']);
                $cliente->setTelefone($item['telefone_cliente_pedido']);

                $lista[] = $cliente;
            }

            return $lista;
        }
    }
    
}


?>