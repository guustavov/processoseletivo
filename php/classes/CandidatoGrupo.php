<?php
    
    class CandidatoGrupo{
        private $candidato_codigo;
        private $grupo_codigo;
        private $resposta_candidato;
        private $acertos;
        private $nome_candidato;
        private $nome_grupo;
        
        
        function getCandidato_codigo(){
            return $this->candidato_codigo;
        }
        
        function setCandidato_codigo($_candidato_codigo){
            $this->candidato_codigo = $_candidato_codigo;
        }
        
        
        function getGrupo_codigo(){
            return $this->grupo_codigo;
        }
        
        function setGrupo_codigo($_grupo_codigo){
            $this->grupo_codigo = $_grupo_codigo;
        }
        
        
        function getResposta_candidato(){
            return $this->resposta_candidato;
        }
        
        function setResposta_candidato($_resposta_candidato){
            $this->resposta_candidato = $_resposta_candidato;
        }
	
	 function getAcertos(){
            return $this->acertos;
        }
        
        function setAcertos($_acertos){
            $this->acertos = $_acertos;
        }
	
	function getNome_candidato(){
            return $this->nome_candidato;
        }
        
        function setNome_candidato($_nome_candidato){
            $this->nome_candidato = $_nome_candidato;
        }
	
	function getNome_grupo(){
            return $this->nome_grupo;
        }
        
        function setNome_Grupo($_nome_grupo){
            $this->nome_grupo = $_nome_grupo;
        }
	
	
    }
?>