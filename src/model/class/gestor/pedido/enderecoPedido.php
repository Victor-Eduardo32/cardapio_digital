<?php 

class EnderecoPedido{
    private $id;
    private $idPedido;
    private $bairro;
    private $valorEntrega;
    private $rua;
    private $numero;
    private $referencia;

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

    public function setBairro($b){
        $this->bairro = $b;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setValorEntrega($ve){
        $this->valorEntrega = $ve;
    }

    public function getValorEntrega(){
        return $this->valorEntrega;
    }

    public function setRua($r){
        $this->rua = $r;
    }

    public function getRua(){
        return $this->rua;
    }

    public function setNumero($n){
        $this->numero = $n;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setReferencia($r){
        $this->referencia = $r;
    }

    public function getReferencia(){
        return $this->referencia;
    }

    
}


?>