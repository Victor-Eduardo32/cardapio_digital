<?php 

class EnderecoRelatorio{
    private $id;
    private $idCliente;
    private $rua;
    private $numeroCasa;
    private $bairro;
    private $totalPedidos;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdCliente($ic){
        $this->idCliente = $ic;
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setRua($r){
        $this->rua = $r;
    }

    public function getRua(){
        return $this->rua;
    }
    
    public function setNumeroCasa($n){
        $this->numeroCasa = $n;
    }

    public function getNumeroCasa(){
        return $this->numeroCasa;
    }

    public function setBairro($b){
        $this->bairro = $b;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setTotalPedidos($tp){
        $this->totalPedidos = $tp;
    }

    public function getTotalPedidos(){
        return $this->totalPedidos;
    }
}

?>