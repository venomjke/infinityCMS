<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		  </a>
		  <a class="brand" href="#">CMS</a>
		  <div class="nav-collapse collapse">
		    <p class="navbar-text pull-right">
		      Авторизован как: <a href="#" class="navbar-link"> Администратор </a>
		      <a class="btn btn-small" style="margin-top:0px;" href="<?php echo CMS::adminUrl("auth.php","a=logout"); ?>"> Выйти </a>
		    </p>
		    <ul class="nav">
		    	<li class="dropdown">
		    		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Сайт</a>
		    		<ul class="dropdown-menu" role="menu" aria-labelledby="siteMenu">
		    			<li <?php echo $this->prepare('nav_current') == 'pages'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("pages.php");?>">Страницы</a></li>
		    			<li <?php echo $this->prepare('nav_current') == 'layouts'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("layouts.php");?>">Макеты</a></li>
		    			<li <?php echo $this->prepare('nav_current') == 'snippets'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("snippets.php");?>">Сниппеты</a></li>
		    		</ul>	
		    	</li>
		      <li class="dropdown">
		      	<a class="dropdown-toggle" data-toggle="dropdown" href="#" >Система</a>
		      	  <ul class="dropdown-menu" role="menu" aria-labelledby="systemMenu">
						    <li <?php echo $this->prepare('nav_current') == 'modules'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("modules.php");?>" >Модули</a></li>
						    <li <?php echo $this->prepare('nav_current') == 'settings'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("settings.php");?>" >Настройки</a></li>
						    <li <?php echo $this->prepare('nav_current') == 'users'?'class="active"':'';?>><a tabindex="-1" href="<?php echo CMS::adminUrl("users.php");?>" >Пользователи</a></li>
						  </ul>
		      </li>
		    </ul>
		  </div><!--/.nav-collapse -->
		</div>
	</div>
</div>