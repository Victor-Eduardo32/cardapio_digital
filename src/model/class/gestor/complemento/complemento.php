<?php 

class Complemento{
    private $id;
    private $nome;
    private $descricao;
    private $minimo_selecionavel;
    private $maximo_selecionavel;
    private $tipo;
    private $valor_maior;
    private $data;
    private $selecionadoProduto;

    public function setID($i){
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

    public function setDescricao($d){
        $this->descricao = $d;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setMinimoSel($min){
        $this->minimo_selecionavel = $min;
    }

    public function getMinimoSel(){
        return $this->minimo_selecionavel;
    }

    public function setMaximoSel($max){
        $this->maximo_selecionavel = $max;
    }

    public function getMaximoSel(){
        return $this->maximo_selecionavel;
    }

    public function setTipo($t){
        $this->tipo = $t;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setValorMaior($vm){
        $this->valor_maior = $vm;
    }

    public function getValorMaior(){
        return $this->valor_maior;
    }

    public function setDate($dt){
        $this->data = $dt;
    }

    public function getDate(){
        return $this->data;
    }

    public function setSelecionado($sp){
        $this->selecionadoProduto = $sp;
    }

    public function getSelecionado(){
        return $this->selecionadoProduto;
    }
}

interface complementoDAO{
    public function add(Complemento $c);
    public function atualizar(Complemento $c);
    public function excluir($id);
    public function setarID($id);
    public function listar();
}


?>