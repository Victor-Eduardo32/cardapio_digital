<?php 
     require __DIR__ . '/../../class/gestor/entrega.php';

    class daoMySqlEntrega implements EntregaDAO{
        private $pdo;

        function __construct(PDO $drive){
            $this->pdo = $drive;
        }

        public function add(Entrega $e){
            $sql = $this->pdo->prepare('INSERT INTO entrega (nome_entrega, preco_entrega) VALUES (:nome, :preco)');
            $sql->bindValue(':nome', $e->getNome());
            $sql->bindValue(':preco', $e->getPreco());
            $sql->execute();

            $e->setId($this->pdo->lastInsertId());
            return true;
        }

        public function editar(Entrega $e){
            $sql = $this->pdo->prepare('UPDATE entrega SET nome_entrega = :nome, preco_entrega = :preco WHERE id = :id');
            $sql->bindValue(':nome', $e->getNome());
            $sql->bindValue(':preco', $e->getPreco());
            $sql->bindValue(':id', $e->getId());
            $sql->execute();

            return true;
        }

        public function excluir($id){
            $sql = $this->pdo->prepare('DELETE FROM entrega WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        public function setarID($id){
            $sql = $this->pdo->prepare('SELECT * FROM entrega WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
                
                $e = new Entrega();
                $e->setId($dados['id']);
                $e->setNome($dados['nome_entrega']);
                $e->setPreco($dados['preco_entrega']);

                return $e;
            } else {
                return false;
            }
        }

        public function listar(){
            $lista = [];
            $sql = $this->pdo->query('SELECT * FROM entrega');

            if($sql->rowCount() > 0){
                $dados = $sql->fetchAll();

                foreach($dados as $item){
                    $entrega = new Entrega();
                    $entrega->setId($item['id']);
                    $entrega->setNome($item['nome_entrega']);
                    $entrega->setPreco($item['preco_entrega']);

                    $lista[] = $entrega;
                }

                return $lista;
            }
        }
    }

?>