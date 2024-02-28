<?php 

class ClientesRelatorio{
    private $id;
    private $idPedido;
    private $nome;
    private $telefone;
    private $totalPedidos;
    
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

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setTelefone($t){
        $this->telefone = $t;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTotalPedidos($tp){
        $this->totalPedidos = $tp;
    }

    public function getTotalPedidos(){
        return $this->totalPedidos;
    }
}

?>