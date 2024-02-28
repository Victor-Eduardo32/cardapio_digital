<?php 
    class Produto{
        private $id;
        private $id_c;
        private $nome;
        private $descricao;
        private $ordem;
        private $valor;
        private $hora_inicial;
        private $hora_final;
        private $disponivel;
        private $ativo;
        private $imagem;
        private $nome_categoria;

        public function setId($i){
            $this->id = $i;
        }

        public function getId(){
            return $this->id;
        }

        public function setIDC($ic){
            $this->id_c = $ic;
        }

        public function getIDC(){
            return $this->id_c;
        }

        public function setNome($n){
            $this->nome = $n;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setDescricao($dc){
            $this->descricao = $dc;
        }

        public function getDescricao(){
            return $this->descricao;
        } 

        public function setOrdem($o){
            $this->ordem = $o;
        }

        public function getOrdem(){
            return $this->ordem;
        }

        public function setValor($v){
            $this->valor = $v;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setHoraInicial($hi){
            $this->hora_inicial = $hi;
        }

        public function getHoraInicial(){
            return $this->hora_inicial;
        }

        public function setHoraFinal($hf){
            $this->hora_final = $hf;
        }

        public function getHoraFinal(){
            return $this->hora_final;
        }

        public function setDisponivel($d){
            $this->disponivel = $d;
        }

        public function getDisponivel(){
            return $this->disponivel;
        }

        public function setAtivo($a){
            $this->ativo = $a;
        }

        public function getAtivo(){
            return $this->ativo;
        }

        public function setImagem($im){
            $this->imagem = $im;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setNomeCategoria($nc){
            $this->nome_categoria = $nc;
        }

        public function getNomeCategoria(){
            return $this->nome_categoria;
        }
    }

    interface ProdutoDAO{
        public function add(Produto $p);
        public function atualizar(Produto $p);
        public function excluir($id);
        public function setarID($id);
        public function listar();
    }
?>