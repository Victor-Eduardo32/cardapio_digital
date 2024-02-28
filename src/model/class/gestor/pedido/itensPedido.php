<?php 

class ItensPedido{
    private $id;
    private $idProduto;
    private $nome;
    private $quantidade;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdProduto($ip){
        $this->idProduto = $ip;
    }

    public function getIdProduto(){
        return $this->idProduto;
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