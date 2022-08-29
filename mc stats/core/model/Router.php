<?php 

namespace com\pedrojm96\model;

class Router{
	private $basepath;
	private $uri;
	private $pages;
	private $params;
	
	function __construct() {
		$this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));

		if (strstr($this->uri, '?'))
		{
			$pages = substr($this->uri, 0, strpos($this->uri, '?'));
			$this->pages = explode('/', $pages);
			$params = explode("?", $this->uri);
			$params = $params[1];
			parse_str($params, $this->params);
			
		}else{
			$this->pages = explode('/', $this->uri);
		}
	}
	
	
	
	public function getPages(){
		if(empty($this->pages[0])) $this->pages[0] = "index";
		
		$pages = array();
		
		
		
		for($int = 0; $int <count($this->pages) ;$int++){
			
			if(!empty($this->pages[$int])){
				$pages[$int] = $this->pages[$int];
			}
			
		}
		
		return $pages;
	}
	
	public function getParams(){
		return $this->params;
	}
}