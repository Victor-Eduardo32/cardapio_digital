<?php 

require __DIR__ . '/../../class/gestor/produtoComplemento.php';

class daoMysqlProdutoComplemento {
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function add(ProdutoComplemento $pc){
        $sql = $this->pdo->prepare('INSERT INTO produto_complemento (produto, complemento, selecionado) VALUES (:produto, :complemento, :selecionado)');
        $sql->bindValue(':produto', $pc->getIDProduto());
        $sql->bindValue(':complemento', $pc->getIDComplemento());
        $sql->bindValue(':selecionado', $pc->getSelecionado());
        $sql->execute();
    
        $pc->setID($this->pdo->lastInsertId());
        return true;
    }

    public function atualizar(ProdutoComplemento $pc){
        $sql = $this->pdo->prepare('UPDATE produto_complemento SET produto = :produto, complemento = :complemento, selecionado = :selecionado WHERE id_pc = :id');
        $sql->bindValue(':produto', $pc->getIDProduto());
        $sql->bindValue(':complemento', $pc->getIDComplemento());
        $sql->bindValue(':selecionado', $pc->getSelecionado());
        $sql->bindValue(':id', $pc->getID());
        $sql->execute();

        return true;
    }

    public function listar($produtoId){
        $lista = [];
        $sql = $this->pdo->prepare('SELECT pc.*, p.id 
        FROM produto_complemento pc 
        INNER JOIN produto p ON p.id = pc.produto
        WHERE pc.produto = :produtoId');

        $sql->bindValue(':produtoId', $produtoId);
        $sql->execute();


        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $pc = new ProdutoComplemento();
                $pc->setID($item['id_pc']);
                $pc->setIDProduto($item['produto']);
                $pc->setIDComplemento($item['complemento']);
                $pc->setSelecionado($item['selecionado']);

                $lista[] = $pc;
            }
        }
        
        return $lista;
    }
}

?>