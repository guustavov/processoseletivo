<?php
	class Administrador{
		private $codigo;
		private $nome;
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
		
		public function getSenha(){
			return $this->senha;
		}
		
		public function setSenha($senha){
			$this->senha = $senha;
		}
	}
?>