<?php 
	class GerenciadorConexao{
		public $con = null;
		public $dbType = "mysql";
		
		//parametros de conxao
		public $host = "localhost";
		public $user = "root";
		public $senha = "root";
		public $db = "mydb";
		
		public function pegarConexao(){
			try{
				//REALIZA A CONEXAO
				//usando o padrao: new PDO
				//("tipo_do_banco:host=ip_do_host; dbname=nome_da_base", "usu�rio", "senha");
				$this->con = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha);
				return $this->con;
			}catch (PDOException $ex){
				echo ("Erro: ".$ex->getMessage());
			}
		}
	}
?>
