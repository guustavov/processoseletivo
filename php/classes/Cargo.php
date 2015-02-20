<?php
    
    class Cargo{
        private $codigo;
        private $cargo;
        
        
        function getCodigo(){
            return $this->codigo;
        }
        
        function setCodigo($_codigo){
            $this->codigo = $_codigo;
        }
        
        
        function getCargo(){
            return $this->cargo;
        }
        
        function setCargo($_cargo){
            $this->cargo = $_cargo;
        }        
    }
?>