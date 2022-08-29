<title><?php echo $templateArray["title"]." &bull; ".$templateArray["languages"]["site_name"];?></title>
<?php 
if($templateArray["page"]=="player"  ){
	$img = str_replace("<player>",$templateArray["name"],$templateArray["avatarApiShares"]);
}else{
	$img = str_replace("<player>","Steve",$templateArray["avatarApiShares"]);
}

$isHttps = 
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
;

$preurl;
if($isHttps){
	$preurl = "https://";
}else{
	$preurl = "http://";
}
?>

<meta property="og:title" content="<?php echo $templateArray["title"]." &bull; ".$templateArray["languages"]["site_name"];?>">
<meta property="og:url" content="<?= $preurl.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>">
<meta property="og:site_name" content="<?php echo $templateArray["languages"]["site_name"];?>">


<meta property="og:image" content="<?php echo $img?>">
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<meta property="og:description" content="<?php echo $templateArray["languages"]["site_des"];?>">
<meta property="og:type" content="website">

<link href="<?php echo $templateArray["basepath"];?>favicon.png" rel="favicon.png" />
<link rel="apple-touch-icon" href="<?php echo $templateArray["basepath"];?>favicon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $templateArray["basepath"];?>favicon.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo $templateArray["basepath"];?>favicon.png">


<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo $templateArray["basepath"]; ?>assets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo $templateArray["basepath"]; ?>assets/themes/<?php echo $templateArray["theme"];?>.css">

<script src="<?php echo $templateArray["basepath"]; ?>assets/js/jquery-3.1.1.min.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="<?php echo $templateArray["basepath"]; ?>assets/js/bootstrap.min.js"></script>