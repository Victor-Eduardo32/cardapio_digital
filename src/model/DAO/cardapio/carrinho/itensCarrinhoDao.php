<?php 
require __DIR__ . '/../../../class/cardapio/carrinho/itensCarrinho.php';

class daoMySqlItensCarrinho implements ItensCarrinhoDao{
    private $pdo;

   public function __construct(PDO $drive) {
        $this->pdo = $drive;
    }

    public function add(ItensCarrinho $ic){
        $sql = $this->pdo->prepare('INSERT INTO itens_carrinho (id_produto_carrinho, nome_item_carrinho, quantidade_item_carrinho, valor_item_carrinho) VALUES (:id_produto, :nome, :quantidade, :valor)');
        $sql->bindValue(':id_produto', $ic->getProdutoCarrinho());
        $sql->bindValue(':nome', $ic->getNome());
        $sql->bindValue(':quantidade', $ic->getQuantidade());
        $sql->bindValue(':valor', $ic->getValor());
        $sql->execute();

        $ic->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listar(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM itens_carrinho');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $ic = new ItensCarrinho();
                $ic->setId($item['id']);
                $ic->setProdutoCarrinho($item['id_produto_carrinho']);
                $ic->setNome($item['nome_item_carrinho']);
                $ic->setQuantidade($item['quantidade_item_carrinho']);
                $ic->setValor($item['valor_item_carrinho']);

                $lista[] = $ic;
            }

            return $lista;
        }
    }
}
?>