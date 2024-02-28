<?php 

    require __DIR__ . '/../../class/gestor/categoria.php';

    class daoMysqlCategoria implements CategoriaDAO{
        private $pdo;

        public function __construct(PDO $drive){
            $this->pdo = $drive;
        }

        public function add(Categoria $c){
            $sql = $this->pdo->prepare('INSERT INTO categoria (nome_categoria, ordem_categoria, hi_categoria, hf_categoria, disponivel_categoria, ativo_categoria, imagem_categoria) VALUES (:nome, :ordem, :hora_inicial, :hora_final, :disponivel, :ativo, :imagem)');

            $sql->bindValue(':nome', $c->getNome());
            $sql->bindValue(':ordem', $c->getOrdem());
            $sql->bindValue(':hora_inicial', $c->getHoraInicial());
            $sql->bindValue(':hora_final', $c->getHoraFinal());
            $sql->bindValue(':disponivel', $c->getDisponivel());
            $sql->bindValue(':ativo', $c->getAtivo());
            $sql->bindValue(':imagem', $c->getImagem());
            $sql->execute();
            
            $c->setId($this->pdo->lastInsertId());
            return $c;
        }

        public function atualizar(Categoria $c){
            $sql = $this->pdo->prepare('UPDATE categoria SET nome_categoria = :nome, ordem_categoria = :ordem, hi_categoria = :hora_inicial, hf_categoria = :hora_final, disponivel_categoria = :disponivel, imagem_categoria = :imagem WHERE id = :id');
            $sql->bindValue(":nome", $c->getNome());
            $sql->bindValue(":ordem", $c->getOrdem());
            $sql->bindValue(":hora_inicial", $c->getHoraInicial());
            $sql->bindValue(":hora_final", $c->getHoraFinal());
            $sql->bindValue(":disponivel", $c->getDisponivel());
            $sql->bindValue(":imagem", $c->getImagem());
            $sql->bindValue(":id", $c->getId());
            $sql->execute();

            return true;
        }

        public function inativarAtivar(Categoria $c){
            $sql = $this->pdo->prepare('UPDATE categoria SET ativo_categoria = :ativo WHERE id = :id');
            $sql->bindValue(":ativo", $c->getAtivo());
            $sql->bindValue(":id", $c->getId());
            $sql->execute();

            return true;
        }

        public function setarID($id){
            $sql = $this->pdo->prepare('SELECT * FROM categoria WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
                $c = new Categoria();
                $c->setId($dados['id']);
                $c->setNome($dados['nome_categoria']);
                $c->setOrdem($dados['ordem_categoria']);
                $c->setHoraInicial(date('H:i', strtotime($dados['hi_categoria'])));
                $c->setHoraFinal(date('H:i', strtotime($dados['hf_categoria'])));
                $c->setDisponivel($dados['disponivel_categoria']);
                $c->setImagem($dados['imagem_categoria']);

                return $c;
            } else {
                return false;
            }
        }

        public function deletar($id){
            $sql = $this->pdo->prepare('DELETE FROM categoria WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        public function listar(){
            $lista = [];
            $sql = $this->pdo->query('SELECT * FROM categoria');

            if($sql->rowCount() > 0){
                $dados = $sql->fetchAll();

                foreach ($dados as $item) {
                    $categoria = new Categoria();
                    $categoria->setID($item['id']);
                    $categoria->setNome($item['nome_categoria']);
                    $categoria->setOrdem($item['ordem_categoria']);
                    $categoria->setDisponivel($item['disponivel_categoria']);
                    $categoria->setAtivo($item['ativo_categoria']);
                    $categoria->setHoraInicial(date('H:i', strtotime($item['hi_categoria'])));
                    $categoria->setHoraFinal(date('H:i', strtotime($item['hf_categoria'])));
                    $categoria->setImagem($item['imagem_categoria']);

                    $lista[] = $categoria;
                }
            }

            return $lista;
        }

        public function listarPorCategoria($id = null){
            $lista = [];

            if($id == null){
                $sql = $this->pdo->query('SELECT * FROM categoria ORDER BY ordem_categoria');
            } else {
                $sql = $this->pdo->prepare('SELECT * FROM categoria WHERE id = :id ORDER BY ordem_categoria ');
                $sql->bindValue(':id', $id);
                $sql->execute();
            }
            

            if($sql->rowCount() > 0){
                $dados = $sql->fetchAll();

                foreach ($dados as $item) {
                    $categoria = new Categoria();
                    $categoria->setID($item['id']);
                    $categoria->setNome($item['nome_categoria']);
                    $categoria->setOrdem($item['ordem_categoria']);
                    $categoria->setDisponivel($item['disponivel_categoria']);
                    $categoria->setAtivo($item['ativo_categoria']);
                    $categoria->setHoraInicial(date('H:i', strtotime($item['hi_categoria'])));
                    $categoria->setHoraFinal(date('H:i', strtotime($item['hf_categoria'])));
                    $categoria->setImagem($item['imagem_categoria']);

                    $lista[] = $categoria;
                }
            }

            return $lista;
        }
    }


?>