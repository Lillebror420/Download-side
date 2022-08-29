<?php

$sql = new com\pedrojm96\model\CoreSQL($host,$port,$database,$user,$pass,$table);



$global_stats = file_get_contents("core/global-stats.json");
$global_stats_decode = json_decode($global_stats,true);

$servers = file_get_contents("core/server.json");
$servers_decode = json_decode($servers,true);

$server_array;
$global_stats_array;
$int = 0;
foreach ($global_stats_decode as $valor) {
	$global_stats_array[$int]['name']	= $valor['name'];	
	$global_stats_array[$int]['valor'] = $sql->getGlobalStats($valor['stats'],$valor['type']);
	$int = $int + 1;	
}

$server_array['server-name'] = $servers_decode['server-name'];
$server_array['server-online'] = $sql->getAllTotalRecords("WHERE data = 'online' AND server = 'all' AND value > 0","*");
$server_array['server-ip'] = $servers_decode['server-ip'];

$players = $sql->getAllPlayersGeneral("WHERE data = 'online' AND server = 'all' AND value > 0 ORDER BY time DESC LIMIT 0,10","*");

for ($int2 = 0; $int2 < count($players);$int2++ ){
	$server_array['server_last_players'][$int2]['name'] = $sql->getDataGeneral(array("name:".$players[$int2]['name'],"data:player"),"*")['stringvalue'];
}

for ($int3 = 0; $int3 < count($servers_decode['servers']);$int3++ ){
	$server_array['servers'][$int3]['title'] = $servers_decode['servers'][$int3]['title'];
	$players_server = $sql->getAllPlayersGeneral("WHERE data = 'online' AND server = '".$servers_decode['servers'][$int3]['stats-name']."' AND value > 0 ORDER BY time DESC LIMIT 0,10","*");
	$server_array['servers'][$int3]['version'] = $servers_decode['servers'][$int3]['version'];
	
	$server_array['servers'][$int3]['online'] = $sql->getAllTotalRecords("WHERE data = 'online' AND server = '".$servers_decode['servers'][$int3]['stats-name']."' AND value > 0","*");
	for ($int4 = 0; $int4 < count($players_server);$int4++ ){
		$server_array['servers'][$int3]['last_players'][$int4]['name'] =  $sql->getDataGeneral(array("name:".$players_server[$int4]['name'],"data:player"),"*")['stringvalue'];
	}
}




$page = new com\pedrojm96\model\DrawView("baseView","homeView");



$page->draw(array("avatarApiShares"=>$avatarApiShares,"theme"=>$theme,"basepath"=>$basepath,"global_stats_array"=>$global_stats_array,"server_array"=>$server_array,"languages"=>$languages,"page" => "home","title"=>$languages["home_name"]));