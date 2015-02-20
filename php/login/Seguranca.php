	<?php
	require_once '../conexao/GerenciadorConexao.php';
	require_once '../dao/DaoLogin.php';

	class Seguranca{

		public function __construct(){
				$id = session_id();
				
				if ($id == null){
					session_start();
				}

			
		}
		
		function fecharSessao() {
			 
			$_SESSION = array();
			
			if (isset($_COOKIE[session_name()])) {
			    setcookie(session_name(), '', time()-42000, '/');
			}
			
			session_destroy();
			
			header("Location: ../login/acesso.php");
		}
		
		function fecharSessaoSemAcesso() {
			 
			$_SESSION = array();
			
			if (isset($_COOKIE[session_name()])) {
			    setcookie(session_name(), '', time()-42000, '/');
			}
			
			session_destroy();
		}

		function validaUsuario($usuario, $senha) {
			
			$daoLogin = new DaoLogin;
			
			$vetUsuario = $daoLogin->consultarUsuario($usuario, $senha);
				
			if (isset($vetUsuario)) {
				$_SESSION['usuarioID'] = $vetUsuario[0]->getCodigo(); 
				$_SESSION['usuarioNome'] = $vetUsuario[0]->getNome(); 
				$_SESSION['usuarioEmail'] = $vetUsuario[0]->getEmail(); 
				$_SESSION['usuarioTipo'] = $vetUsuario[0]->getTipo(); 
				
				$_SESSION['usuarioLogin'] = $usuario;
				$_SESSION['usuarioSenha'] = $senha;
				
				
				
				if($_SESSION['usuarioTipo'] == "admin"){
					return "admin";
				}else if ($_SESSION['usuarioTipo'] == "ori"){
					return "ori";
				} else if ($_SESSION['usuarioTipo'] == "cand"){
					return "cand";
				} 
				
			}else {			
				return false;
			}
		}

		function protegePagina($parametro) {
			
			if (!isset($_SESSION['usuarioLogin']) OR !isset($_SESSION['usuarioSenha'])) {
				$this->fecharSessao();
			}			
			if($parametro == "admin"){
				if ($_SESSION['usuarioTipo'] != $parametro){
					$this->fecharSessao();
				}
			}			
			if($parametro == "ori"){
				if ($_SESSION['usuarioTipo'] != $parametro){
					$this->fecharSessao();
				}
			}
			if($parametro == "cand"){
				if ($_SESSION['usuarioTipo'] != $parametro){
					$this->fecharSessao();
				}
			}
			
		}
	}

	?>
