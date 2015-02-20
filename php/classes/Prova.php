<?php
    
    class Prova{
        private $codigo;
        private $nome;
        private $data_criacao;
        private $data_realizacao;
        private $duracao;
        
        
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
        
        function getData_criacao(){
            return $this->data_criacao;
        }
        
        function setData_criacao($_data_criacao){
            $this->data_criacao = $_data_criacao;
        }
	
	   function getData_realizacao(){
            return $this->data_realizacao;
        }
        
        function setData_realizacao($_data_realizacao){
            $this->data_realizacao = $_data_realizacao;
        }
	
	   function getDuracao(){
            return $this->duracao;
        }
        
        function setDuracao($_duracao){
            $this->duracao = $_duracao;
        }
    }
?>