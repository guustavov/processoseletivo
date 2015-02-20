<?php
    
    class Usuario{
        private $codigo;
        private $nome;
        private $email;
        private $senha;
        private $tipo;
        
        
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
	
	  function getTipo(){
            return $this->tipo;
        }
        
        function setTipo($_tipo){
            $this->tipo = $_tipo;
	}

        
        
    }
?>