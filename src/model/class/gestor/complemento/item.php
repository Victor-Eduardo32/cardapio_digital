<?php 

class Item{
    private $id;
    private $complemento;
    private $nome;
    private $descricao;
    private $valor;
    private $ativo;

    public function setID($i){
        $this->id = $i;
    }

    public function getID(){
        return $this->id;
    }

    public function setComplemento($c){
        $this->complemento = $c;
    }

    public function getComplemento(){
        return $this->complemento;
    }

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setDescricao($d){
        $this->descricao = $d;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setValor($v){
        $this->valor = $v;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setAtivo($a){
        $this->ativo = $a;
    }

    public function getAtivo(){
        return $this->ativo;
    }
}


interface itemDAO{
    public function add(Item $i);
    public function atualizar(Item $i);
    public function excluir($id);
    public function setarID($id);
    public function listar();
}

?>