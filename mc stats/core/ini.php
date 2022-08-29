<?php

$controllers = array();

$controllers[] = array(
	"name" => "indexController",
	"router" => array(
		0 => "index"
		)
	);
$controllers[] = array(
	"name" => "playersController",
	"router" => array(
		0 => "players"
		)
	);
$controllers[] = array(
	"name" => "playerController",
	"router" => array(
		0 => "players",
		1 => "*"
		)
	);
$controllers[] = array(
	"name" => "topController",
	"router" => array(
		0 => "top"
		)
	);