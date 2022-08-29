<?php

spl_autoload_register(function ($clase){
	$ruta = str_replace("com\\pedrojm96\\","core/",$clase).".php";
	$ruta = str_replace("\\","/",$ruta);
	if(is_readable($ruta)){
		require_once $ruta;
	}else{
		echo "Error al cargar la clase, el archivo no existe...";
	}
});


require "core/ini.php";
require "core/config.php";
if($language == "ES"){
	 include ("core/language/language-ES.php");
	 $languages["html_lang"] = "es";
	 $languages["footer"] = "&copy;".$languages["site_name"]." ".date("Y")." &bull; Diseñado por <a href=\"https://www.spigotmc.org/members/pedrojm96.74713/\"><b>@pedrojm96</a>";
}else{
	 include ("core/language/language-EN.php");
	 $languages["html_lang"] = "en";
	 $languages["footer"] = "&copy;".$languages["site_name"]." ".date("Y")." &bull; Designed by <a href=\"https://www.spigotmc.org/members/pedrojm96.74713/\"><b>@pedrojm96</a>";
}

require "core/utils.php";
$router = new com\pedrojm96\model\Router();

$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';


$router->getPages();

foreach($controllers as $controller){
	$pasges = count($router->getPages());
	$valid = true;
	$rc = $controller['router'];
	
	if($pasges == count($rc)){
		
		for($int = 0 ; $int<$pasges ; $int++){
			if( ($router->getPages()[$int] != $rc[$int]) &&   ($rc[$int] != "*")){
				
				$valid = false;
				break;
			}	
		}
	}else{
		$valid = false;
		
	}
	if($valid){
		require "core/controller/".$controller['name'].".php";
		break;
	}
}
?>