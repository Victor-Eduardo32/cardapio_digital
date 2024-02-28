<?php 

class Usuario{
    private $id;
    private $nome;
    private $senha;

    public function setId($i){
        $this->id = $i;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($n){
        $this->nome = $n;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setSenha($s){
        $this->senha = $s;
    }

    public function getSenha(){
        return $this->senha;
    }

}

interface UsuarioDAO{
    public function logar($nome, $senha);
    public function logout();
}

?>