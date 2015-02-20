<?php
    
    class ProvaQuestao{
        private $prova_codigo;
        private $questao_codigo;
        private $numero;
        
        
        function getProva_codigo(){
            return $this->prova_codigo;
        }
        
        function setProva_codigo($_prova_codigo){
            $this->prova_codigo = $_prova_codigo;
        }
        
        
        function getQuestao_codigo(){
            return $this->questao_codigo;
        }
        
        function setQuestao_codigo($_questao_codigo){
            $this->questao_codigo = $_questao_codigo;
        }
        
        
        function getNumero(){
            return $this->numero;
        }
        
        function setNumero($_numero){
            $this->numero = $_numero;
        }
        
        
    }
?>