<!DOCTYPE html>
<html <?php echo "lang=\"".$templateArray["languages"]["html_lang"]."\""?>  >
<head>
<?php include("core/view/headView.php")?>
</head>
<body>
	<div class="container-fluid">
	
	<?php include("core/view/navView.php")?>
	</div>
	<div class="container">
    <!-- Page Content goes here -->
		<?php include("core/view/".$pageTemplate.".php")?>
	</div>
	
	<footer>
		<?php echo $templateArray["languages"]["footer"];?>
	</footer>
	
</body>

</html>