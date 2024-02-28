<?php 

class PedidosRelatorio{
    private $id;
    private $valorCompra;
    private $tipoEntrega;
    private $valorEntrega;
    private $tempo;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setValorCompra($vc){
        $this->valorCompra = $vc;
    }

    public function getValorCompra(){
        return $this->valorCompra;
    }

    public function setTipoEntrega($tp){
        $this->tipoEntrega = $tp;
    }

    public function getTipoEntrega(){
        return $this->tipoEntrega;
    }

    public function setValorEntrega($ve){
        $this->valorEntrega = $ve;
    }

    public function getValorEntrega(){
        return $this->valorEntrega;
    }

    public function setTempo($t){
        $this->tempo = $t;
    }

    public function getTempo(){
        return $this->tempo;
    }
}



?>