<?php 

require __DIR__ . '/../../../class/gestor/complemento/complemento.php';

class daoMysqlComplemento implements complementoDAO{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function add(Complemento $c){
        $sql = $this->pdo->prepare('INSERT INTO complemento (nome_complemento, descricao_complemento, mins_complemento, maxs_complemento, tipo_complemento, vm_complemento, data_complemento) VALUES (:nome, :descricao, :min_sel, :max_sel, :tipo, :valor_maior, :data)');
        $sql->bindValue(':nome', $c->getNome());
        $sql->bindValue(':descricao', $c->getDescricao());
        $sql->bindValue(':min_sel', $c->getMinimoSel());
        $sql->bindValue(':max_sel', $c->getMaximoSel());
        $sql->bindValue(':tipo', $c->getTipo());
        $sql->bindValue(':valor_maior', $c->getValorMaior());
        $sql->bindValue(':data', $c->getDate());
        $sql->execute();

        $c->setID($this->pdo->lastInsertId());
        return true;
    }

    public function atualizar(Complemento $c){
        $sql = $this->pdo->prepare('UPDATE complemento SET nome_complemento = :nome, descricao_complemento = :descricao, mins_complemento = :min_sel, maxs_complemento = :max_sel, tipo_complemento = :tipo, vm_complemento = :valor_maior WHERE id = :id');
        $sql->bindValue(':nome', $c->getNome());
        $sql->bindValue(':descricao', $c->getDescricao());
        $sql->bindValue(':min_sel', $c->getMinimoSel());
        $sql->bindValue(':max_sel', $c->getMaximoSel());
        $sql->bindValue(':tipo', $c->getTipo());
        $sql->bindValue(':valor_maior', $c->getValorMaior());
        $sql->bindValue(':id', $c->getId());
        $sql->execute();

        return true;
    }

    public function excluir($id){
        $sql = $this->pdo->prepare('DELETE FROM complemento WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function setarID($id){
        $sql = $this->pdo->prepare('SELECT * FROM complemento WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch();

            $complemento = new Complemento();
            $complemento->setID($dados['id']);
            $complemento->setNome($dados['nome_complemento']);
            $complemento->setDescricao($dados['descricao_complemento']);
            $complemento->setMinimoSel($dados['mins_complemento']);
            $complemento->setMaximoSel($dados['maxs_complemento']);
            $complemento->setTipo($dados['tipo_complemento']);
            $complemento->setValorMaior($dados['vm_complemento']);
            $complemento->setDate($dados['data_complemento']);

            return $complemento;
        } else {
            return false;
        }
    }

    public function listar(){
        $lista = []; 
        $sql = $this->pdo->query('SELECT * FROM complemento'); 
    
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
    
            foreach($dados as $item){
                $complemento = new Complemento();
                $complemento->setID($item['id']);
                $complemento->setNome($item['nome_complemento']);
                $complemento->setDescricao($item['descricao_complemento']);
                $complemento->setMinimoSel($item['mins_complemento']);
                $complemento->setMaximoSel($item['maxs_complemento']);
                $complemento->setTipo($item['tipo_complemento']);
                $complemento->setValorMaior($item['vm_complemento']);
                $complemento->setDate($item['data_complemento']);
    
                $lista[] = $complemento;
            }
        }
    
        return $lista;
    }

    public function listarPorProduto($produtoId, $order = ''){
        $lista = []; 
    
        $sql = $this->pdo->prepare('
        SELECT c.*, pc.selecionado 
        FROM complemento c 
        LEFT JOIN produto_complemento pc ON c.id = pc.complemento AND pc.produto = :produtoId
        ' . $order
        );
    
        $sql->bindValue(':produtoId', $produtoId, PDO::PARAM_INT);
        $sql->execute();
    
        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
    
            foreach($dados as $item){
                $complemento = new Complemento();
                $complemento->setID($item['id']);
                $complemento->setNome($item['nome_complemento']);
                $complemento->setDescricao($item['descricao_complemento']);
                $complemento->setMinimoSel($item['mins_complemento']);
                $complemento->setMaximoSel($item['maxs_complemento']);
                $complemento->setTipo($item['tipo_complemento']);
                $complemento->setValorMaior($item['vm_complemento']);
                $complemento->setDate($item['data_complemento']);
                $complemento->setSelecionado($item['selecionado']);

                $lista[] = $complemento;
            }
        }
    
        return $lista;
    }

    public function duplicar(Complemento $c){
        $sql = $this->pdo->prepare('INSERT INTO complemento (nome_complemento, descricao_complemento, mins_complemento, maxs_complemento, tipo_complemento, vm_complemento, data_complemento) SELECT nome_complemento, descricao_complemento, mins_complemento, maxs_complemento, tipo_complemento, vm_complemento, data_complemento FROM complemento WHERE id = :id');
        $sql->bindValue(':id', $c->getId());
        $sql->execute();

        $c->setID($this->pdo->lastInsertId());
        return true;
    }
}

?>