<?php
    
    class Candidato{
        private $codigo;
        private $nome;
        private $rg;
        private $expeditor;
        private $cpf;
	private $data_nascimento;
        private $email;
        private $senha;
        private $cargo_codigo;
        private $escolaridade;
        private $telefone;
	private $rua;
        private $numero;
        private $cep;
        private $bairro;
        private $cidade;
        private $estado;
        private $complemento;
        private $cargo;
        
        
        function getCodigo(){
            return $this->codigo;
        }
        
        function setCodigo($_codigo){
            $this->codigo = $_codigo;
        }
        
        
        function getNome(){
            return $this->nome;
        }
        
        function setNome($_nome){
            $this->nome = $_nome;
        }
        
        
        function getRg(){
            return $this->rg;
        }
        
        function setRg($_rg){
            $this->rg = $_rg;
        }
	
	function getExpeditor(){
            return $this->expeditor;
        }
        
        function setExpeditor($_expeditor){
            $this->expeditor= $_expeditor;
        }
        
        
        function getCpf(){
            return $this->cpf;
        }
        
        function setCpf($_cpf){
            $this->cpf = $_cpf;
        }
        
	function getData_nascimento(){
            return $this->data_nascimento;
        }
        
        function setData_nascimento($_data_nascimento){
            $this->data_nascimento = $_data_nascimento;
        }
        
        function getEmail(){
            return $this->email;
        }
        
        function setEmail($_email){
            $this->email = $_email;
        }
        
        
        function getSenha(){
            return $this->senha;
        }
        
        function setSenha($_senha){
            $this->senha = $_senha;
        }
        
        
        function getCargoCodigo(){
            return $this->cargo_codigo;
        }
        
        function setCargoCodigo($_cargo_codigo){
            $this->cargo_codigo = $_cargo_codigo;
        }
        
        
        function getEscolaridade(){
            return $this->escolaridade;
        }
        
        function setEscolaridade($_escolaridade){
            $this->escolaridade = $_escolaridade;
        }
        
        
        function getTelefone(){
            return $this->telefone;
        }
        
        function setTelefone($_telefone){
            $this->telefone = $_telefone;
        }
        
        
	function getRua(){
		return $this->rua;
	}
		
        function setRua($_rua){
            $this->rua = $_rua;
        }
        
        
        function getNumero(){
            return $this->numero;
        }
        
        function setNumero($_numero){
            $this->numero = $_numero;
        }
        
        
        function getCep(){
            return $this->cep;
        }
        
        function setCep($_cep){
            $this->cep = $_cep;
        }
        
        function getBairro(){
            return $this->bairro;
        }
        
        function setBairro($_bairro){
            $this->bairro = $_bairro;
        }
        
        
        function getCidade(){
            return $this->cidade;
        }
        
        function setCidade($_cidade){
            $this->cidade = $_cidade;
        }
        
        
        function getEstado(){
            return $this->estado;
        }
        
        function setEstado($_estado){
            $this->estado = $_estado;
        }
        
        
        function getComplemento(){
            return $this->complemento;
        }
        
        function setComplemento($_complemento){
            $this->complemento = $_complemento;
        }
	
	function getCargo(){
            return $this->cargo;
        }
        
        function setCargo($_cargo){
            $this->cargo = $_cargo;
        }
        
        
    }
?>