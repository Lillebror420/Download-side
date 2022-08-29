<?php
$sql = new com\pedrojm96\model\CoreSQL($host,$port,$database,$user,$pass,$table);

$data = $sql->getAllPlayersGeneral("WHERE data = 'online' AND server= 'all' ORDER BY time DESC LIMIT 0,10","*");
$page = new com\pedrojm96\model\DrawView("baseView","playersView");
$page->draw(array("avatarApiShares"=>$avatarApiShares,"avatarApi"=>$avatarApi,"theme"=>$theme,"basepath"=>$basepath,"languages"=>$languages,"players" => $data,"page" => "players","title"=>$languages["players_name"]));





