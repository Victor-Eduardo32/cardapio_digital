<?php 
require __DIR__ . '/../../../class/cardapio/carrinho/produtoCarrinho.php';

class daoMySqlProdutoCarrinho implements ProdutoCarrinhoDao{
    private $pdo;

    public function __construct(PDO $drive) {
        $this->pdo = $drive;
    }

    public function add(ProdutoCarrinho $pc){
        $sql = $this->pdo->prepare('INSERT INTO produto_carrinho (imagem_produto_carrinho, nome_produto_carrinho, quantidade_produto_carrinho, valor_produto_carrinho) VALUES (:imagem, :nome, :quantidade, :valor)');
        $sql->bindValue(':imagem', $pc->getImagem());
        $sql->bindValue(':nome', $pc->getNome());
        $sql->bindValue(':quantidade', $pc->getQuantidade());
        $sql->bindValue(':valor', $pc->getValor());
        $sql->execute();

        $pc->setId($this->pdo->lastInsertId());
        return true;
    }

    public function excluir($id){
        $sql = $this->pdo->prepare('DELETE FROM produto_carrinho WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function listar(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM produto_carrinho');

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $pc = new produtoCarrinho();
                $pc->setId($item['id']);
                $pc->setImagem($item['imagem_produto_carrinho']);
                $pc->setNome($item['nome_produto_carrinho']);
                $pc->setQuantidade($item['quantidade_produto_carrinho']);
                $pc->setValor($item['valor_produto_carrinho']);

                $lista[] = $pc;
            }

            return $lista;
        }
    }

    public function mudarQuantidade(ProdutoCarrinho $pc){
        $sql = $this->pdo->prepare('UPDATE produto_carrinho SET quantidade_produto_carrinho = :quantidade WHERE id = :id');
        $sql->bindValue(':quantidade', $pc->getQuantidade());
        $sql->bindValue(':id', $pc->getId());
        $sql->execute();
    }
}


?>