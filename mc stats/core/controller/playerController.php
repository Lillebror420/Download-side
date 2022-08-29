<?php
$sql = new com\pedrojm96\model\CoreSQL($host,$port,$database,$user,$pass,$table);

$consulta = $sql->getDataGeneral(array("name:".$router->getPages()[1]),"*");
	
if($consulta){
	$mame = $consulta["stringvalue"];
	$player_stats_array;
	
	$player_stats = file_get_contents("core/player-stats.json");
	$player_stats_decode = json_decode($player_stats,true);
		
	$global_stats = $player_stats_decode['global-stats'];
	
	$online = $sql->getDataGeneral(array("name:".$mame , "data:online" , "server:all"),"*");
	
	$player_stats_array['is-online'] = $online['value'];
	$player_stats_array['server'] = $sql->getAllDataGeneral("WHERE name = '".$mame."' AND data = 'online' AND value = '1' AND server != 'all'")["server"];
	
	$player_stats_array['last-online'] = $online['time'];
	
	
	for($int2 = 0; $int2 < count($global_stats);$int2++ ){
		$player_stats_array['global-stats'][$int2]['name'] = $global_stats[$int2]['name'];	
		$player_stats_array['global-stats'][$int2]['valor'] = $sql->getPlayerStats($global_stats[$int2]['stats'],$mame,$global_stats[$int2]['type'],$global_stats[$int2]['server'],$languages["time"]);	
	}	
	
	$servers_stats = $player_stats_decode['server-stats'];	
		
	for ($int = 0; $int < count($servers_stats);$int++ ){
		$player_stats_array['server-stats'][$int]['name'] = $servers_stats[$int]['name'];	
		$player_stats_array['server-stats'][$int]['background-image'] = $servers_stats[$int]['background-image'];
		
		$online2 = $sql->getDataGeneral(array("name:".$mame , "data:online" , "server:".$servers_stats[$int]['server']),"*");
		
		$player_stats_array['server-stats'][$int]['is-online'] = $online2['value'];
	
		$player_stats_array['server-stats'][$int]['last-online'] = $online2['time'];
		
		for($int2 = 0; $int2 < count($servers_stats[$int]['stats-list']);$int2++ ){
			$player_stats_array['server-stats'][$int]['stats'][$int2]['name'] = $servers_stats[$int]['stats-list'][$int2]['name'];	
			$player_stats_array['server-stats'][$int]['stats'][$int2]['valor'] = $sql->getPlayerStats($servers_stats[$int]['stats-list'][$int2]['stats'],$mame,$servers_stats[$int]['stats-list'][$int2]['type'],$servers_stats[$int]['stats-list'][$int2]['server'],$languages["time"]);	
		}	
	}

	$page = new com\pedrojm96\model\DrawView("baseView","playerView");

	$page->draw(array("avatarApiShares"=>$avatarApiShares,"bodyApi"=>$bodyApi,"theme"=>$theme,"basepath"=>$basepath,"languages"=>$languages,"player_stats_array"=>$player_stats_array,"name"=>$mame,"page" => "player","title"=>$mame));
}else{
	$page = new com\pedrojm96\model\DrawView("baseView","searchPlayerErrorView");
	$page->draw(array("avatarApiShares"=>$avatarApiShares,"bodyApi"=>$bodyApi,"theme"=>$theme,"basepath"=>$basepath,"languages"=>$languages,"page" => "404","title"=>$languages['search_player_no_found']));
}
	
	





