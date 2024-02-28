<?php 

class ClientePedido{
    private $id;
    private $idPedido;
    private $nome;
    private $telefone;

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
}

?>