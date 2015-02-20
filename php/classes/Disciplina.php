<?php
    
    class Disciplina{
        private $codigo;
        private $disciplina;
        
        
        function getCodigo(){
            return $this->codigo;
        }
        
        function setCodigo($_codigo){
            $this->codigo = $_codigo;
        }
        
        
        function getDisciplina(){
            return $this->disciplina;
        }
        
        function setDisciplina($_disciplina){
            $this->disciplina = $_disciplina;
        }        
    }
?>