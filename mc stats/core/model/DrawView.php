<?php 

namespace com\pedrojm96\model;

class DrawView{
	private $parentTemplate;
	private $pageTemplate;

	function __construct($parentTemplate,$pageTemplate) {
		$this->parentTemplate = $parentTemplate;
		$this->pageTemplate = $pageTemplate;
	}
	
	public function draw($arrray){
		$pageTemplate = $this->pageTemplate;
		$templateArray = $arrray;
		include("core/view/".$this->parentTemplate.".php");
	}
	
}
