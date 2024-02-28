<?php 

require __DIR__ . '/../../../class/gestor/pedido/cartaoPedido.php';

class daoMySqlCartaoPedido{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function addCartao(CartaoPedido $cp){
        $sql = $this->pdo->prepare('INSERT INTO cartao_pedido (id_pedido, tipo_cartao) VALUES (:pedido, :tipo)');
        $sql->bindValue(':pedido', $cp->getIdPedido());
        $sql->bindValue(':tipo', $cp->getTipoCartao());
        $sql->execute();

        $cp->setId($this->pdo->lastInsertId());
        return true;
    }

    public function listarCartao(){
        $lista = [];
        $sql = $this->pdo->query('SELECT * FROM cartao_pedido');


        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
                $cartao = new CartaoPedido();
                $cartao->setId($item['id']);
                $cartao->setIdPedido($item['id_pedido']);
                $cartao->setTipoCartao($item['tipo_cartao']);

                $lista[] = $cartao;
            }

            return $lista;
        }
    }
    
}


?>