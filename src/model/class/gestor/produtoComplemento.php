<?php 

class ProdutoComplemento{
    private $id;
    private $idProduto;
    private $idComplemento;
    private $selecionado;

    public function setID($i){
        $this->id = $i;
    }

    public function getID(){
        return $this->id;
    }

    public function setIDProduto($ip){
        $this->idProduto = $ip;
    }

    public function getIDProduto(){
        return $this->idProduto;
    }

    public function setIDComplemento($ic){
        $this->idComplemento = $ic;
    }

    public function getIDComplemento(){
        return $this->idComplemento;
    }

    public function setSelecionado($s){
        $this->selecionado = $s;
    }

    public function getSelecionado(){
        return $this->selecionado;
    }
}


?>