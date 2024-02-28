<?php 

class Entrega{
    private $id;
    private $nome;
    private $preco;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setPreco($p){
        $this->preco = $p;
    }

    public function getPreco(){
        return $this->preco;
    }
}

interface EntregaDAO{
    public function add(Entrega $e);
    public function editar(Entrega $e);
    public function excluir($id);
    public function setarID($id);
    public function listar();
}


?>