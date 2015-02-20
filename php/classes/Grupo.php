<?php
    
    class Grupo{
        private $codigo;
        private $nome;
        private $orientador_codigo;
        private $prova_codigo;
        private $orientador_nome;
        
        
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
        
        
        function getOrientador_codigo(){
            return $this->orientador_codigo;
        }
        
        function setOrientador_codigo($_orientador_codigo){
            $this->orientador_codigo = $_orientador_codigo;
        }
        
        
        function getProva_codigo(){
            return $this->prova_codigo;
        }
        
        function setProva_codigo($_prova_codigo){
            $this->prova_codigo = $_prova_codigo;
        }
	
	   function getOrientador_nome(){
            return $this->orientador_nome;
        }
        
        function setOrientador_nome($_orientador_nome){
            $this->orientador_nome = $_orientador_nome;
        }
        
        
    }
?>