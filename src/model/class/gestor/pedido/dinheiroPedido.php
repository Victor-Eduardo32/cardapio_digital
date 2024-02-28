<?php 

class DinheiroPedido{
    private $id;
    private $idPedido;
    private $confimacaoTroco;
    private $troco;

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

    public function setConfirmacaoTroco($ct){
        $this->confimacaoTroco = $ct;
    }

    public function getConfirmacaoTroco(){
        return $this->confimacaoTroco;
    }

    public function setTroco($t){
        $this->troco = $t;
    }

    public function getTroco(){
        return $this->troco;
    }
}

?>