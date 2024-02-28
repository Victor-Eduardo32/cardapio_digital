<?php 

require __DIR__ . '/../../../class/gestor/pedido/itensPedido.php';

class daoMySqlItensPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addItens(ItensPedido $ip, $idProdutoCarrinho){
        $sql = $this->pdo->prepare('INSERT INTO itens_pedido (id_produto, nome_item_pedido, quantidade_item_pedido) SELECT :id_produto, nome_item_carrinho, quantidade_item_carrinho FROM itens_carrinho WHERE id_produto_carrinho = :id_produto_carrinho');
        $sql->bindValue(':id_produto', $ip->getIdProduto());
        $sql->bindValue(':id_produto_carrinho', $idProdutoCarrinho);
        $sql->execute();

        $ip->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarItensPedido(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM itens_pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $itens = new ItensPedido();
                $itens->setId($item['id']);
                $itens->setIdProduto($item['id_produto']);
                $itens->setNome($item['nome_item_pedido']);
                $itens->setQuantidade($item['quantidade_item_pedido']);
                
                $lista[] = $itens;
            }

            return $lista;
        }
    }
    
}


?>