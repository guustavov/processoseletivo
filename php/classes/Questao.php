<?php
    
    class Questao{
        private $codigo;
        private $disciplina_codigo;
        private $nivel;
        private $descricao;
        private $a;
        private $b;
        private $c;
        private $d;
        private $gabarito;
        
        
        function getCodigo(){
            return $this->codigo;
        }
        
        function setCodigo($_codigo){
            $this->codigo = $_codigo;
        }
        
        
        function getDisciplinaCodigo(){
            return $this->disciplina_codigo;
        }
        
        function setDisciplinaCodigo($_disciplina_codigo){
            $this->disciplina_codigo = $_disciplina_codigo;
        }
        
        
        function getNivel(){
            return $this->nivel;
        }
        
        function setNivel($_nivel){
            $this->nivel = $_nivel;
        }
        
        
        function getDescricao(){
            return $this->descricao;
        }
        
        function setDescricao($_descricao){
            $this->descricao = $_descricao;
        }
        
        
        function getA(){
            return $this->a;
        }
        
        function setA($_a){
            $this->a = $_a;
        }
        
        
        function getB(){
            return $this->b;
        }
        
        function setB($_b){
            $this->b = $_b;
        }
        
        
        function getC(){
            return $this->c;
        }
        
        function setC($_c){
            $this->c = $_c;
        }
        
        
        function getD(){
            return $this->d;
        }
        
        function setD($_d){
            $this->d = $_d;
        }
        
        
        function getGabarito(){
            return $this->gabarito;
        }
        
        function setGabarito($_gabarito){
            $this->gabarito = $_gabarito;
        }
        
        
    }
?>