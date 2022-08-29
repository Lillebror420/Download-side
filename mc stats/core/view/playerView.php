
<div class="jumbotron">
	
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<h1 class="display-4"><?php echo $templateArray["name"];?></h1>
		</div>
	
		<div class="col-md-6 col-sm-6">
			<?php
			
			if($templateArray['player_stats_array']['is-online'] > 0){
				echo '<span class="online">'.$templateArray["languages"]["online"].'</span>  [ <strong>'.$templateArray['player_stats_array']['server']."</strong> ]";
				$time_m = $templateArray["languages"]["time"];
				$time = transcurido($templateArray['player_stats_array']['last-online'],$time_m);
				$last_time = str_replace("<time>",$time,$time_m['last']);
				echo '<br>'.$last_time;
			}else{
				echo '<span class="offline">'.$templateArray["languages"]["offline"].'</span>';
				$time_m = $templateArray["languages"]["time"];
				$time = transcurido($templateArray['player_stats_array']['last-online'],$time_m);
				$last_time = str_replace("<time>",$time,$time_m['last']);
				echo '<br>Última conexión: '.$last_time;
			}
	
			?>
		</div>
	
	</div>
	
	
	
	
	<hr>
	<div id="global-info" class="container">
	<div class="row body-img">
		<div class="col-md-6 col-sm-12">
			<?php
			$img = str_replace("<player>",$templateArray["name"],$templateArray["bodyApi"]);
			
			
			echo '<img src="'.$img.'" alt="'.$templateArray["name"].'">';
			?>
		</div>
		
		
		<div class="col-md-6 col-sm-12">
			
			<div class="vertical-center">
				
				<?php				
									foreach ($templateArray['player_stats_array']['global-stats'] as $valor){
										echo '<div class="item">
												<div  class="row">
													<span class="col-md-6 col-sm-6"><strong>'.$valor['name'].' </strong> </span> 
													<span class="col-md-6 col-sm-6">'.$valor['valor'].'</span>
												</div>
												
											</div>';
									}
									
									
									
				?>
				
			</div>
		</div>
		
	</div>
	</div>
	
	<div id="server-info" class="row">
		
		<?php
		
		
		foreach ($templateArray["player_stats_array"]["server-stats"] as $valor){
			echo '<div class="col-md-6 col-sm-12">
					<div class="card" style="background-image: url('.$valor['background-image'].');
														background-position: center;
														background-repeat: no-repeat;
														background-size: cover;">
						<div class="card-header"> 
						
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<strong>'.$valor['name'].'</strong>
								</div>
	
								<div class="col-md-9 col-sm-9">';
						
							if($valor['is-online'] > 0){
								echo '<span class="online-server">'.$templateArray["languages"]["online"].'</span>';
								$time_m = $templateArray["languages"]["time"];
								$time = transcurido($valor['last-online'],$time_m);
								$last_time = str_replace("<time>",$time,$time_m['last']);
								echo "<br>".$last_time;
							}else{
								echo '<span class="offline-server">'.$templateArray["languages"]["offline"].'</span>';
								$time_m = $templateArray["languages"]["time"];
								$time = transcurido($valor['last-online'],$time_m);
								$last_time = str_replace("<time>",$time,$time_m['last']);
								echo '<br>'.$templateArray["languages"]["last_online"].' '.$last_time;
							}
	
					
							echo '</div>
	
							</div>

						</div>
							
						<div class="card-body" >   
							
							<div >';
									foreach ($valor['stats'] as $valor2){
										echo '<div class="item">
												<div  class="row">
													<span class="col-6 col-md-6 col-sm-6"><strong>'.$valor2['name'].' </strong> </span> 
													<span class="col-6 col-md-6 col-sm-6">'.$valor2['valor'].'</span>
												</div>
											</div>';
									}
									
									
									
									
			echo '				
							</div>
						</div>
					</div>
				</div>';
			
		}
		
		
		?>
		
		
	</div>
	
	
	
	
	
	
</div>

<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>