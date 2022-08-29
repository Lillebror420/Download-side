<?php 

namespace com\pedrojm96\model;
use mysqli;

class CoreSQL{
	private $host, $database, $username, $password, $table;
	
	private $connection;

	function __construct(String $host,int $port,String $database,String $username,String $password,String $table) {
		$this->table = $table;
		$this->host = $host;
		$this->port = $port;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->MYSQLConnection();
		
	}
	
	public function MYSQLConnection(){
		$this->connection = new mysqli($this->host, $this->username, $this->password,$this->database) or die("Error conectando a la BBDD");
		$this->connection->set_charset("utf8");
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
	}
	
	public function where($arrayWhere){
		$wheres = "";
		for($i=0 ; $i<count($arrayWhere);$i++){
		
			
			$contain = strpos($arrayWhere[$i], ':');
			
			if(!empty($contain) && $contain >= 0){
				
				$local = explode(':', $arrayWhere[$i]);
				$locaWhere = $local[0];
				$locaValue = $local[1];
				if($i==(count($arrayWhere) - 1)) {
					$wheres = $wheres.$locaWhere." = '".$locaValue."'";
				}else {
					$wheres = $wheres.$locaWhere." = '".$locaValue."'"." AND ";
				}
			}
		}
		return $wheres;
	}
	
	
	public function checkData($paranWhere,$paranString) {
	
		$secureParanWhere = array();
		foreach($paranWhere as $data){
			$secureParanWhere[] = $this->connection->real_escape_string($data);
		}
		
		$query = "SELECT ".$this->connection->real_escape_string($paranString)." FROM ".$this->table." WHERE ".$this->where($secureParanWhere).";";
		
		$result = $this->connection->query($query);
		
		if ($result && $result->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	
	
	public function getDataGeneral($paranWhere,$paranString){
		$secureParanWhere = array();
		foreach($paranWhere as $data){
			$secureParanWhere[] = $this->connection->real_escape_string($data);
		}
		$query = "SELECT ".$this->connection->real_escape_string($paranString)." FROM ".$this->table." WHERE ".$this->where($secureParanWhere).";";
		$result = $this->connection->query($query);
		$retuno = array();
		
		if ($result && $result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}else{
			return false;
		}
	}
	
	public function getAllDataGeneral($criterio){
		
		$query = "SELECT * FROM ".$this->table." ".$criterio.";";
		
		$result = $this->connection->query($query);
		$retuno = array();
		
		if ($result && $result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}else{
			return false;
		}
	}
	
	
	public function getAllPlayersGeneral($criterio,$paranString){
		$query = "SELECT ".$this->connection->real_escape_string($paranString)." FROM ".$this->table." ".$criterio.";";
		$result = $this->connection->query($query);
		$retuno = array();
		
		if ($result && $result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$retuno[] = $row;
			}
			return $retuno;
		}else{
			return array();;
		}
	}
	
	public function getAllTotalRecords($criterio){
		$query = "SELECT COUNT(*) AS totals FROM ".$this->table." ".$criterio.";";
		
		$result = $this->connection->query($query);
		if ($result && $result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row["totals"];
		}else{
			return 0;
		}
	}
	
	
	
	public function getTotalSUMGeneral($paranString,$type){
		$query = "SELECT SUM(value) AS totals FROM ".$this->table." WHERE data='".$this->connection->real_escape_string($paranString)."'";
		$result = $this->connection->query($query);
		if ($result && $result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($type == "integer"){
				return intval($row['totals']);
			}else{
				return $row["totals"];
			}
			
		}else{
			return 0;
		}
	}
	
	public function getTotalRecordsGeneral($paranString){
		$query = "SELECT COUNT(*) AS totals FROM ".$this->table." WHERE data='".$this->connection->real_escape_string($paranString)."';";
		
		$result = $this->connection->query($query);
		if ($result && $result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row["totals"];
		}else{
			return 0;
		}
	}
	
	
	
	public function getGlobalStats($stats,$type){
		if($type == "records"){
			return $this->getTotalRecordsGeneral($stats);
		}else if($type == "integer"){
			return $this->getTotalSUMGeneral($stats,$type);
		}else if($type == "decimal"){
			return $this->getTotalSUMGeneral($stats,$type);
		}else{
			return 5;
		}
	}
	
	public function getPlayerStats($stats,$player,$type,$server,$time_m){
		$retorno = "";
		
		if($server=="all"){
		
			$query = "SELECT * FROM ".$this->table." WHERE name='".$player."' AND data='".$this->connection->real_escape_string($stats)."';";
			
			$result = $this->connection->query($query);

			if ($result && $result->num_rows > 0){
				$row = $result->fetch_assoc();
				
				if($type == "decimal"){
					$retorno = $row['value'];
				}else if($type == "integer"){
					$retorno = intval($row['value']);
				}else if($type == "last-time"){
					$retorno = $this->transcurido($row['value'],$time_m);
				}else if($type == "color"){
					$retorno = $this->color($row['stringvalue']);
				}else if($type == "string"){
					
					$retorno = $row['stringvalue'];
				}else{
					$retorno = "1";
				}
			}else{
				$retorno = "0";
			}
		}else{
			$query = "SELECT * FROM ".$this->table." WHERE data='".$this->connection->real_escape_string($stats)."' AND server='".$server."' AND name='".$player."';";
			$result = $this->connection->query($query);

			if ($result && $result->num_rows > 0){
				$row = $result->fetch_assoc();
				
				if($type == "decimal"){
					$retorno = $row['value'];
				}else if($type == "integer"){
					$retorno = intval($row['value']);
				}else if($type == "last-time"){
					$retorno = $this->transcurido($row['value'],$time_m);
				}else if($type == "color"){
					$retorno = $this->color($row['stringvalue']);
				}else if($type == "string"){
					$retorno = $row['stringvalue'];
				}else{
					$retorno = "1";
				}
			}else{
				$retorno = "0";
			}
		}
		return $retorno;
		
	}
	
function transcurido($dtime,$time) {
	   
		$date_time = ($dtime/1000);
		
		$transcurido = time()-$date_time;
		
		$tc['minutos'] = @$transcurido/60;
		
		$tc['horas'] = @$transcurido/3600;
		$tc['dias'] = @$transcurido/86400;
		
		$tc['meses'] = @$transcurido/(2629743.83);
		
		$tc['años'] = @$transcurido/31556926;
		$plu['minutos'] = (intval($tc['minutos'])==1) ? NULL : 's';
		$plu['horas'] = (intval($tc['horas'])==1) ? NULL : 's';
		$plu['dias'] = (intval($tc['dias'])==1) ? NULL : 's';
		$plu['meses'] = (intval($tc['meses'])==1) ? NULL : 'es';
		$plu['años'] = (intval($tc['años'])==1) ? NULL : 's';
		
		$frase = " ";
		$frase = ($transcurido<60 AND $transcurido>15) ? 'menos de un minuto' : $frase;
		$frase = ($transcurido>60 AND $transcurido<3600) ? intval($tc['minutos']).' '.$time['minute'].$plu['minutos'] : $frase;
		$frase = ($transcurido>3600 AND $transcurido<86400) ? intval($tc['horas']).' '.$time['hour'].$plu['horas'] : $frase;
		$frase = ($transcurido>86000 AND $transcurido<'2629743,83') ? intval($tc['dias']).' '.$time['day'].$plu['dias'] : $frase;
		$frase = ($transcurido>'2629743,83' AND $transcurido<31556926) ? intval($tc['meses']).' '.$time['month'].$plu['meses'] : $frase;
		$frase = ($transcurido>31556926 AND $transcurido<315569260) ? intval($tc['años']).' '.$time['year'].$plu['años'] : $frase;
		$frase = ($transcurido>3155692600) ? 'mas de 10 años' : $frase;
		return $frase;
}
	
function  color($uncolore){
	$uncolore = str_replace("§","&",$uncolore);
	
	
	
	$arc = array("&0", "&1", "&2","&3", "&4", "&5","&6", "&7", "&8", "&9","&a", "&b","&c", "&d", "&e", "&f");
	$ars = array("&k", "&l", "&m","&n", "&o", "&r");
    $replasoc = array(
            "<font color='#000000'>", //&0
            "<font color='#0000AA'>", //&1
            "<font color='#00AA00'>", //&2
            "<font color='#00AAAA'>", //&3
            "<font color='#AA0000'>", //&4
            "<font color='#AA00AA'>", //&5
            "<font color='#FFAA00'>", //&6
            "<font color='#AAAAAA'>", //&7
            "<font color='#555555'>", //&8
            "<font color='#5555FF'>", //&9
            "<font color='#55FF55'>", //&a
            "<font color='#55FFFF'>", //&b
            "<font color='#FF5555'>", //&c
            "<font color='#FF55FF'>", //&d
            "<font color='#FFFF55'>", //&e
            "<font color='#FFFFFF'>"); //&f
    $replasos = array(
            "",
            "<b>", 
            "<s>",
            "<u>", 
            "<i>", 
            "<font color='#000000'></b></s></u></i>");
	
	$total_color = 0;
	foreach($arc as $valor){
		$total_color = $total_color + substr_count($uncolore,$valor);
	}
	
	$total_l = substr_count($uncolore,"&l");
	$total_m = substr_count($uncolore,"&m");
	$total_n = substr_count($uncolore,"&n");
	$total_o = substr_count($uncolore,"&o");
	$total_r = substr_count($uncolore,"&r");

	
	$retorno = str_replace($arc,$replasoc,$uncolore);
	$retorno = str_replace($ars,$replasos,$retorno);
	
	for ($int = 0; $int < $total_color;$int++ ){
		$retorno = $retorno."</font>";
	}
	
	
	for ($int = 0; $int < $total_l;$int++ ){
		$retorno = $retorno."</b>";
	}
	
	for ($int = 0; $int < $total_m;$int++ ){
		$retorno = $retorno."</s>";
	}
	
	for ($int = 0; $int < $total_n;$int++ ){
		$retorno = $retorno."</u>";
	}
	
	for ($int = 0; $int < $total_o;$int++ ){
		$retorno = $retorno."</i>";
	}
	
	
	for ($int = 0; $int < $total_r;$int++ ){
		$retorno = $retorno."</font>";
	}
	
	return $retorno;
}	

}

