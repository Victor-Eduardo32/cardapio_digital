<?php 

require __DIR__ . '/../../../class/gestor/complemento/item.php';

class daoMysqlItem implements itemDAO{
    private $pdo;
    private $complementoID;

    public function __construct(PDO $drive, $complementoID = null){
        $this->pdo = $drive;
        $this->complementoID = $complementoID;
    }

    public function add(Item $i){
        $sql = $this->pdo->prepare('INSERT INTO item (complemento, nome_item, descricao_item, valor_item, ativo_item) VALUES (:complemento, :nome, :descricao, :valor, :ativo)');
        $sql->bindValue(':complemento', $this->complementoID);
        $sql->bindValue(':nome', $i->getNome());
        $sql->bindValue(':descricao', $i->getDescricao());
        $sql->bindValue(':valor', $i->getValor());
        $sql->bindValue(':ativo', $i->getAtivo());
        $sql->execute();

        $i->setID($this->pdo->lastInsertId());
        return true;
    }

    public function atualizar(Item $i){
        $sql = $this->pdo->prepare('UPDATE item SET nome_item = :nome, descricao_item = :descricao, valor_item = :valor WHERE id = :id AND complemento = :complemento');
        $sql->bindValue(':nome', $i->getNome());
        $sql->bindValue(':descricao', $i->getDescricao());
        $sql->bindValue(':valor', $i->getValor());
        $sql->bindValue(':id', $i->getID());
        $sql->bindValue(':complemento', $i->getComplemento());
        $sql->execute();

        return true;
    }

    public function excluir($id){
        $sql = $this->pdo->prepare('DELETE FROM item WHERE id = :id AND complemento = :complemento');
        $sql->bindValue(':complemento', $this->complementoID);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function setarID($id){
        $sql = $this->pdo->prepare('SELECT * FROM item WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $item = $sql->fetch();
            $i = new Item();
            $i->setID($item['id']);
            $i->setComplemento($item['complemento']);
            $i->setNome($item['nome_item']);
            $i->setDescricao($item['descricao_item']);
            $i->setValor($item['valor_item']);

            return $i;
        } else {
            return false;
        }
    }

    public function listar(){
        $lista = [];
        $sql = $this->pdo->prepare('SELECT * FROM item WHERE complemento = :complementoID');
        $sql->bindValue(':complementoID', $this->complementoID);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $i = new Item();
                $i->setID($item['id']);
                $i->setComplemento($item['complemento']);
                $i->setNome($item['nome_item']);
                $i->setDescricao($item['descricao_item']);
                $i->setValor($item['valor_item']);
                $i->setAtivo($item['ativo_item']);

                $lista[] = $i;
            }
        }

        return $lista;
    }

    public function inativarAtivar(Item $i){
        $sql = $this->pdo->prepare('UPDATE item SET ativo_item = :ativo WHERE id = :id AND complemento = :complemento');
        $sql->bindValue(':ativo', $i->getAtivo());
        $sql->bindValue(':id', $i->getId());
        $sql->bindValue(':complemento', $i->getComplemento());
        $sql->execute();

        return true;
    }

    public function duplicar(Item $i, $novoIdComplemento){
        $sql = $this->pdo->prepare('INSERT INTO item (nome_item, descricao_item, valor_item, ativo_item, complemento) SELECT nome_item, descricao_item, valor_item, ativo_item, :novoIdComplemento FROM item WHERE complemento = :complemento');
        $sql->bindValue(':complemento', $i->getComplemento());
        $sql->bindValue(':novoIdComplemento', $novoIdComplemento);
        $sql->execute();
    
        $i->setID($this->pdo->lastInsertId());
        return true;
    }

}


?>