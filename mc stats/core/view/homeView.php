<div class="jumbotron">
	<h1 class="display-4"><?php echo $templateArray["languages"]["site_name"];?></h1>
	<p class="lead"><?php echo $templateArray["languages"]["site_des"];?></p>
	<hr>
	
	<div id="infos" class="row">
		
		<?php 
		
		
		foreach ($templateArray["global_stats_array"] as $valor) {
						
			echo '<div class="col-md-6 col-sm-12">
					<div class="info">
						'.$valor['name'].'<br>
						<span class="global-value"> '.$valor['valor'].' </span>
					</div>		
                 </div>';
		}
		
		
		?>
	</div>
</div>


<div class='jumbotron'>
    <h1 class="display-4"><?php echo $templateArray["languages"]["home_panel_status"];?></h1>
	<hr>
   
	<?php 
	
	
	echo '<div class="card server">
			<div class="card-header"><strong>'.$templateArray["server_array"]["server-name"].' </strong></div>
							
			<div class="card-body grass">   
			<h1 class="text-center">'.$templateArray["server_array"]["server-ip"].'</h1>
				<h1 class="text-center">'.$templateArray["server_array"]["server-online"].'</h1>	';
		
		if(!empty($templateArray["server_array"]["server_last_players"])){
			$players_info = "";
			
			foreach ($templateArray["server_array"]["server_last_players"] as $player){
				$players_info = $players_info.'<a href="'.$basepath.'players/'.$player["name"].'">'.$player["name"].'</a>, ';
			}
			$server_info = str_replace("<players>",$players_info,$templateArray["languages"]["home_panel_status_server_info"]);
			echo '<p>'.$server_info.'</p>';
		}
		echo '</div>
		</div>';
	?>
   
    <div id="infos" class="row">
		
			<?php 
		
			
			
			
			
			
			foreach ($templateArray["server_array"]["servers"] as $valor) {
				echo '<div class="col-md-6 col-sm-12 server">
						<div class="card">
							<div class="card-header"><strong>'.$valor['title'].' </strong></div>
							
							 <div class="card-body grass">   
								<h1 class="text-center">'.$valor['online'].'</h1>
								
								';
								if(!empty($valor["last_players"])){
									$players_info = "";
									
									foreach ($valor["last_players"] as $player){
										$players_info = $players_info.'<a href="'.$basepath.'players/'.$player["name"].'">'.$player["name"].'</a>, ';
									}
									$server_info = "";
									$server_info = str_replace("<players>",$players_info,$templateArray["languages"]["home_panel_status_server_info"]);
									echo '<p>'.$server_info.'</p>';
								}
								
							 echo '</div>
						</div>
				</div>';
					
					
			}
			
			?>
	</div>
    
</div>
