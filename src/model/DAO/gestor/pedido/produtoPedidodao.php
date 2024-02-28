<?php 

require __DIR__ . '/../../../class/gestor/pedido/produtosPedido.php';

class daoMySqlProdutoPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addProdutos(ProdutosPedido $pp){
        $sql = $this->pdo->prepare('INSERT INTO produtos_pedido (id_pedido, nome_produto_pedido, quantidade_produto_pedido) VALUES (:id_pedido, :nome, :quantidade)');
        $sql->bindValue(':id_pedido', $pp->getIdPedido());
        $sql->bindValue(':nome', $pp->getNome());
        $sql->bindValue(':quantidade', $pp->getQuantidade());
        $sql->execute();

        $pp->setId($this->pdo->lastInsertId());
        return true;
    }

    public function excluirProdutosCarrinho(){
        $sql = $this->pdo->prepare('DELETE FROM produto_carrinho');
        $sql->execute();
    }

    public function listarProdutoPedido(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM produtos_pedido');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $produto = new ProdutosPedido();
                $produto->setId($item['id']);
                $produto->setIdPedido($item['id_pedido']);
                $produto->setNome($item['nome_produto_pedido']);
                $produto->setQuantidade($item['quantidade_produto_pedido']);
                
                $lista[] = $produto;
            }

            return $lista;
        }
    }
    
}


?>