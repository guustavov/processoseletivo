<?php
	class Orientador{
		private $codigo;
		private $nome;
		private $rg;
		private $expeditor;
		private $cpf;
		private $email;
		private $senha;
		
		public function getCodigo(){
			return $this->codigo;
		}
		
		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function getRg(){
			return $this->rg;
		}
		
		public function setRg($rg){
			$this->rg = $rg;
		}
		
		function getExpeditor(){
		    return $this->expeditor;
		}
		
		function setExpeditor($_expeditor){
		    $this->expeditor= $_expeditor;
		}
				
		public function getCpf(){
			return $this->cpf;
		}
		
		public function setCpf($cpf){
			$this->cpf = $cpf;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function getSenha(){
			return $this->senha;
		}
		
		public function setSenha($senha){
			$this->senha = $senha;
		}
	}
?>