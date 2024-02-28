<?php 
    require __DIR__ . '/../../class/gestor/produto.php';

    class daoMysqlProduto implements ProdutoDAO{
        private $pdo;

        function __construct(PDO $drive){
            $this->pdo = $drive;
        }

        public function add(Produto $p){
            $sql = $this->pdo->prepare("INSERT INTO produto (categoria, nome_produto, descricao_produto, ordem_produto, valor_produto, hi_produto, hf_produto, disponivel_produto, ativo_produto, imagem_produto) VALUES (:categoria, :nome, :descricao, :ordem, :valor, :hora_inicial, :hora_final, :disponivel, :ativo, :imagem)");

            $sql->bindValue(":categoria", $p->getIDC());
            $sql->bindValue(":nome", $p->getNome());
            $sql->bindValue(":descricao", $p->getDescricao());
            $sql->bindValue(":ordem", $p->getOrdem());
            $sql->bindValue(":valor", $p->getValor());
            $sql->bindValue(":hora_inicial", $p->getHoraInicial());
            $sql->bindValue(":hora_final", $p->getHoraFinal());
            $sql->bindValue(":disponivel", $p->getDisponivel());
            $sql->bindValue(":ativo", $p->getAtivo());
            $sql->bindValue(":imagem", $p->getImagem());
            $sql->execute();

            $p->setId($this->pdo->lastInsertId());
            return $p;
        }

        public function atualizar(Produto $p){
            $sql = $this->pdo->prepare('UPDATE produto SET categoria = :categoria, nome_produto = :nome, descricao_produto = :descricao, ordem_produto = :ordem, valor_produto = :valor, hi_produto = :hora_inicial, hf_produto = :hora_final, disponivel_produto = :disponivel, ativo_produto = :ativo, imagem_produto = :imagem WHERE id = :id');
            $sql->bindValue(':categoria', $p->getIDC());
            $sql->bindValue(':nome', $p->getNome());
            $sql->bindValue(':descricao', $p->getDescricao());
            $sql->bindValue(':ordem', $p->getOrdem());
            $sql->bindValue(':valor', $p->getValor());
            $sql->bindValue(':hora_inicial', $p->getHoraInicial());
            $sql->bindValue(':hora_final', $p->getHoraFinal());
            $sql->bindValue(':disponivel', $p->getDisponivel());
            $sql->bindValue(':ativo', $p->getAtivo());
            $sql->bindValue(':imagem', $p->getImagem());
            $sql->bindValue(':id', $p->getId());
            $sql->execute();

            return true;
        }

        public function inativarAtivar(Produto $p){
            $sql = $this->pdo->prepare('UPDATE produto SET ativo_produto = :ativo WHERE id = :id');
            $sql->bindValue(':ativo', $p->getAtivo());
            $sql->bindValue(':id', $p->getId());
            $sql->execute();

            return true;
        }

        public function excluir($id){
            $sql = $this->pdo->prepare('DELETE FROM produto WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        public function setarID($id){
            $sql = $this->pdo->prepare('SELECT * FROM produto WHERE id = :id');
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
                $p = new Produto();
                $p->setId($dados['id']);
                $p->setIDC($dados['categoria']);
                $p->setNome($dados['nome_produto']);
                $p->setDescricao($dados['descricao_produto']);
                $p->setOrdem($dados['ordem_produto']);
                $p->setValor($dados['valor_produto']);
                $p->setHoraInicial(date('H:i', strtotime($dados['hi_produto'])));
                $p->setHoraFinal(date('H:i', strtotime($dados['hf_produto'])));
                $p->setDisponivel($dados['disponivel_produto']);
                $p->setAtivo($dados['ativo_produto']);
                $p->setImagem($dados['imagem_produto']);

                return $p;
            }else{
                return false;
            }
        }

        public function listar($order = ''){
            $lista = [];
            $sql = $this->pdo->query('SELECT p.*, c.nome_categoria FROM produto p LEFT JOIN categoria c ON p.categoria = c.id ' . $order);
            
            if($sql->rowCount() > 0){
                $dados = $sql->fetchAll();

                foreach($dados as $item){
                    $produto = new Produto();
                    $produto->setID($item['id']);
                    $produto->setIDC($item['categoria']);
                    $produto->setNome($item['nome_produto']);
                    $produto->setDescricao($item['descricao_produto']);
                    $produto->setOrdem($item['ordem_produto']);
                    $produto->setValor($item['valor_produto']);
                    $produto->setHoraInicial(date('H:i', strtotime($item['hi_produto'])));
                    $produto->setHoraFinal(date('H:i', strtotime($item['hf_produto'])));
                    $produto->setDisponivel($item['disponivel_produto']);
                    $produto->setAtivo($item['ativo_produto']);
                    $produto->setImagem($item['imagem_produto']);
                    $produto->setNomeCategoria($item['nome_categoria']);

                    $lista[] = $produto;
                }
            }

            return $lista;
        }
    }

?>