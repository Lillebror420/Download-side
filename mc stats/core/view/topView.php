

<div class="jumbotron">
	<h1 class="display-4"><?php echo $templateArray["languages"]["top_title"];?></h1>
	
	<hr>
	
	
	<div id="infos" class="row">
		<?php
		
		
		foreach ($templateArray["top_stats_array"] as $valor){
			echo '<div class="col-md-6 col-sm-12 top">
					<div class="card">
						<div class="card-header"><strong>'.$valor['title'].' </strong></div>
							
						<div class="card-body">   
							<table>
								<colgroup>
									<col width="10%">
									<col width="45%">
									<col width="45%">
								</colgroup>
								
								<thead>
									<tr>
										<th> '.$templateArray["languages"]["table_#"].'  </th> 
										<th> '.$templateArray["languages"]["table_name"].'  </th>
										<th>'.$valor['name'].'</th>
				
									</tr>
		
								</thead>
								
								
								<tbody class="tlist">';
									
									
									
									foreach ($valor['top'] as $valor2){
										$img = str_replace("<player>",$valor2["name"],$templateArray["avatarApi"]);
										echo '<tr>
												<td><img src="'.$img.'" alt="'.$valor2["name"].'" height="32" width="32"></td>
												<td><strong><a href="'.$basepath.'players/'.$valor2["name"].'">'.$valor2["name"].'</a> :</strong> </td> 
												<td>'.$valor2['valor'].'</td>
											</tr>';
									}
									
									
									
									
			echo '				</tbody>
							</table>
						</div>
					</div> <br>
				</div>';
			
		}
		
		?>
		
		
	</div>
	
</div>