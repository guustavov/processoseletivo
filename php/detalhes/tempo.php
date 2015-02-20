			<?php
					session_start();
					$data_realizacao_numeric = $_SESSION["data_realizacao"];			
					$data_atual_numeric = strtotime(date("Y-m-d H:i"));
					$data_atual = date("Y-m-d H:i:s");
					
					$tempo = (int)(($data_realizacao_numeric - $data_atual_numeric) / 60 / 60) ;
					$tempoResto = (($data_realizacao_numeric - $data_atual_numeric) / 60 % 60)-1;
					
					$data_cand = date("d/m/Y H:i:s");
					
					$segundos = 60 - date("s");
					

															
					if ($tempo >= 0 AND $tempoResto >= 0 AND $segundos >= 0){
						echo "<div class='sem'> Data e hora atual: ";
						echo $data_cand . "<br> Falta ainda: ";
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
							echo "0".$segundos." <br></div>";
						}else{
							echo $segundos." <br></div>";
						}
					}else{
						echo "<div ID='hide'><span id='nocolor'>yes</span></div>";
					}
										
					
			?>
	
