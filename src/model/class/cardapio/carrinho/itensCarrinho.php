<?php 
class ItensCarrinho{
    private $id;
    private $produto;
    private $nome;
    private $quantidade;
    private $valor;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setProdutoCarrinho($pc){
        $this->produto = $pc;
    }

    public function getProdutoCarrinho(){
        return $this->produto;
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

    public function setValor($v){
        $this->valor = $v;
    }

    public function getValor(){
        return $this->valor;
    }
}

interface ItensCarrinhoDao{
    public function add(ItensCarrinho $ic);
    public function listar();
}


?>