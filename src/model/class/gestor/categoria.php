<?php 

class Categoria{
    private $id;
    private $nome;
    private $ordem;
    private $hora_inicial;
    private $hora_final;
    private $disponivel;
    private $ativo;
    private $imagem;

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

    public function setOrdem($o){
        $this->ordem = $o;
    }

    public function getOrdem(){
        return $this->ordem;
    }

    public function setHoraInicial($hi){
        $this->hora_inicial = $hi;
    }

    public function getHoraInicial(){
        return $this->hora_inicial;
    }

    public function setHoraFinal($hf){
        $this->hora_final = $hf;
    }

    public function getHoraFinal(){
        return $this->hora_final;
    }

    public function setDisponivel($d){
        $this->disponivel = $d;
    }

    public function getDisponivel(){
        return $this->disponivel;
    }

    public function setAtivo($a){
        $this->ativo = $a;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setImagem($im){
        $this->imagem = $im;
    }

    public function getImagem(){
        return $this->imagem;
    }
    
}

interface CategoriaDAO{
    public function add(Categoria $c);
    public function atualizar(Categoria $c);
    public function deletar($id);
    public function listar();
}

?>