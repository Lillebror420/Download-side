<div class="jumbotron">
	<h1 class="display-4"><?php echo $templateArray["languages"]["search_title"];?></h1>
	<p class="lead"><?php echo $templateArray["languages"]["search_des"];?></p>
	<hr>
	
	<form  method="post" action="<?php echo $basepath;?>players/" onsubmit = "this.action += player.value.split(' ').join('-')" >
		<div class="form-group">
			<input type="text"  name='player' class="form-control" id="player" aria-describedby="urlHelp" placeholder="playername">
		</div>
		<input type="submit" value="<?php echo $templateArray["languages"]["search_button"];?>" class="btn btn-primary btn-lg btn-block">
	</form>
</div>

<div class="jumbotron">
	
	<p class="lead"><?php echo $templateArray["languages"]["players_more_active_accounts"];?></p>
	<hr>
	
	<table>
		<colgroup>
			<col width="10%">
			<col width="45%">
			
			<col width="45%">
		
		</colgroup>
	
		<thead>
			<tr>
				<th><?php echo $templateArray["languages"]["table_#"];?></th> 
				<th><?php echo $templateArray["languages"]["table_name"];?></th>
				
				<th><?php echo $templateArray["languages"]["table_last_activity"];?></th>
			</tr>
		
		</thead>
			
		<tbody class="tlist">
			<?php 
			
			$time_m = $templateArray["languages"]["time"];
			$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
			
			foreach($templateArray["players"] as $player){
				$time = transcurido($player['time'],$time_m);
				$last_time = str_replace("<time>",$time,$time_m['last']);
				echo "<tr>";
				    
					$img = str_replace("<player>",$player["name"],$templateArray["avatarApi"]);
				    
					echo "<td> <img src=\"".$img."\" alt=\"".$player["name"]."\" height=\"32\" width=\"32\"></td>";
					echo '<td><a href="'.$basepath.'players/'.$player["name"].'">'.$player["name"].'</a></td>';
					
					echo "<td>".$last_time."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	
	</table>
	
</div>