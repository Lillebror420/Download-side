<?php
$sql = new com\pedrojm96\model\CoreSQL($host,$port,$database,$user,$pass,$table);

$top_stats = file_get_contents("core/top-stats.json");
$top_stats_decode = json_decode($top_stats,true);

$top_stats_array;

for ($int = 0; $int < count($top_stats_decode);$int++ ){
	$top_stats_array[$int]['title'] = $top_stats_decode[$int]['title'];
	$top_stats_array[$int]['name'] = $top_stats_decode[$int]['name'];
	$server;
	if(empty($top_stats_decode[$int]['server'])){
		$server = "all";
	}else{
		$server = $top_stats_decode[$int]['server'];
	}
	
	
	$top_stats_array[$int]['top'] = array();	
	
	$data = $sql->getAllPlayersGeneral("WHERE data='".$top_stats_decode[$int]['stats']."' AND server='".$server."' ORDER BY value DESC LIMIT 0,10","*");
	
	
	for ($int2 = 0; $int2 < count($data);$int2++ ){
		$top_stats_array[$int]['top'][$int2]['name'] = $data[$int2]['name'];
		$top_stats_array[$int]['top'][$int2]['valor'] = $data[$int2]['stringvalue'];
	}	
}

$page = new com\pedrojm96\model\DrawView("baseView","topView");
$page->draw(array("avatarApiShares"=>$avatarApiShares,"avatarApi"=>$avatarApi,"theme"=>$theme,"basepath"=>$basepath,"top_stats_array"=>$top_stats_array,"languages"=>$languages,"players" => $data,"page" => "top","title"=>"Top"));