<?php 

class ProdutosPedido{
    private $id;
    private $idPedido;
    private $nome;
    private $quantidade;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdPedido($ip){
        $this->idPedido = $ip;
    }

    public function getIdPedido(){
        return $this->idPedido;
    }

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setQuantidade($q){
        $this->quantidade = $q;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

}

?>