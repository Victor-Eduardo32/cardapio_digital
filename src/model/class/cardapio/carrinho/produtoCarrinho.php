<?php 

class produtoCarrinho{
    private $id;
    private $imagem;
    private $nome;
    private $valor;
    private $quantidade;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setImagem($im){
        $this->imagem = $im;
    }

    public function getImagem(){
        return $this->imagem;
    }

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setValor($v){
        $this->valor = $v;        
    }

    public function getValor(){
        return $this->valor;
    }

    public function setQuantidade($q){
        $this->quantidade = $q;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

}

interface ProdutoCarrinhoDao{
    public function add(ProdutoCarrinho $pc);
    public function excluir($id);
    public function listar();
}
?>