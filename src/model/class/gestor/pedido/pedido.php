<?php 

class Pedido{
    private $id;
    private $valorCompra;
    private $pagamento;
    private $entrega;
    private $estado;

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

    public function setPagamento($p){
        $this->pagamento = $p;
    }

    public function getPagamento(){
        return $this->pagamento;
    }

    public function setEntrega($e){
        $this->entrega = $e;
    }

    public function getEntrega(){
        return $this->entrega;
    }

    public function setEstado($ed){
        $this->estado = $ed;
    }

    public function getEstado(){
        return $this->estado;
    }
}

?>