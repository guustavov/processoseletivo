			<?php
				
					session_start();
					
					$duracao = $_SESSION["duracao"];
								
					$data_realizacao_numeric = $_SESSION["data_realizacao"];			
					$data_atual_numeric = strtotime(date("Y-m-d H:i"));
					$data_atual = date("Y-m-d H:i:s");
					
					$tempo = (int)(($data_realizacao_numeric - $data_atual_numeric) / 60 / 60) ;
					$tempoResto = (($data_realizacao_numeric - $data_atual_numeric) / 60 % 60)-1+$duracao;
					
					$data_cand = date("d/m/Y H:i:s");
					
					$segundos = 60 - date("s");
					
					if ($tempoResto < 0){
						echo "<div id='yes' value='yes'></div>";						
					}
						
					if ($tempo < 1 AND $tempoResto < 5 AND $tempoResto >= 0 AND $segundos >= 0){
						echo "<div id='finalProva'>Falta ainda: ";
						if($tempo < 10){
							echo "0" . $tempo . ":";
						}else{
							echo $tempo . ":";
						}
						if($tempoResto < 10){
							echo "0" . $tempoResto . ":";
						}else{
							echo $tempoResto . ":";
						}
						if($segundos < 10){
							echo "0".$segundos;
						}else{
							echo $segundos;
						}
						
						echo " de duração.<br></div>";
						
					}else{
					
						if ($tempo < 1 AND $tempoResto < 30 AND $tempoResto > 0 AND $segundos >= 0){
							echo "<div id='duracao'>Falta ainda ";
							if($tempo < 10){
								echo "0" . $tempo . ":";
							}else{
								echo $tempo . ":";
							}
							if($tempoResto < 10){
								echo "0" . $tempoResto . ":";
							}else{
								echo $tempoResto . ":";
							}
							if($segundos < 10){
								echo "0".$segundos;
							}else{
								echo $segundos;
							}
							
							echo " de duração.<br></div>";
						}
					}
															
					
			?>
	
