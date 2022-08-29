<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><?php echo $templateArray["languages"]["site_name"];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	<?php 
	$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
	?>
      <li class="nav-item <?php if($templateArray['page'] == 'home'){echo 'active';}?>">
        <a class="nav-link" href="<?php echo $basepath;?>"><?php echo $templateArray["languages"]["home_name"];?> </a>
      </li>
	  
	  <li class="nav-item <?php if($templateArray['page'] == 'players'){echo 'active';}?>">
        <a class="nav-link" href="<?php echo $basepath;?>players"><?php echo $templateArray["languages"]["players_name"];?></a>
      </li>
	  
	  <li class="nav-item <?php if($templateArray['page'] == 'top'){echo 'active';}?>">
        <a class="nav-link" href="<?php echo $basepath;?>top"><?php echo $templateArray["languages"]["top_name"];?></a>
      </li>
    </ul>
  </div>
</nav>