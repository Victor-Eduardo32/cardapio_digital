<?php 

class CartaoPedido{
    private $id;
    private $idPedido;
    private $tipoCartao;

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

    public function setTipoCartao($tc){
        $this->tipoCartao = $tc;
    }

    public function getTipoCartao(){
        return $this->tipoCartao;
    }
}

?>