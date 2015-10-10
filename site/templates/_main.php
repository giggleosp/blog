	<?php 

/**
 * _main.php
 * Main markup file
 *
 * This file contains all the main markup for the site and outputs the regions 
 * defined in the initialization (_init.php) file. These regions include: 
 * 
 *   $title: The page title/headline 
 *   $content: The markup that appears in the main content/body copy column
 *   $sidebar: The markup that appears in the sidebar column
 * 
 * Of course, you can add as many regions as you like, or choose not to use
 * them at all! This _init.php > [template].php > _main.php scheme is just
 * the methodology we chose to use in this particular site profile, and as you
 * dig deeper, you'll find many others ways to do the same thing. 
 * 
 * This file is automatically appended to all template files as a result of 
 * $config->appendTemplateFile = '_main.php'; in /site/config.php. 
 *
 * In any given template file, if you do not want this main markup file 
 * included, go in your admin to Setup > Templates > [some-template] > and 
 * click on the "Files" tab. Check the box to "Disable automatic append of
 * file _main.php". You would do this if you wanted to echo markup directly 
 * from your template file or if you were using a template file for some other
 * kind of output like an RSS feed or sitemap.xml, for example. 
 *
 * See the README.txt file for more information. 
 *
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $page->summary; ?>" />
	<link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/material.min.css">
	<script src="<?php echo $config->urls->templates?>scripts/material.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>styles/main.css" />
</head>
<body class="<?php if($sidebar) echo "has-sidebar "; ?>">
	<!-- Uses a header that scrolls with the text, rather than staying
	 	 locked at the top -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title"><a href="/" style="text-decoration:none;color:white">Giggle</a></span>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
				<!-- Navigation -->
				<nav class="main mdl-navigation mdl-layout--large-screen-only">
					<?php 
				// top navigation consists of homepage and its visible children
				foreach($homepage->
					and($homepage->children) as $item) {
					echo "
					<a class='mdl-navigation__link' href='$item->url'>$item->title</a>
					";
				}

				// output an "Edit" link if this page happens to be editable by the current user
				if($page->editable()) echo "
					<a class='mdl-navigation__link' href='$page->editUrl'>Edit</a>
					";
			  ?>
				</nav>
				<div class="nav-search-left-spacer"></div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
	                  mdl-textfield--floating-label mdl-textfield--align-right">
					<label class="mdl-button mdl-js-button mdl-button--icon"
	               for="fixed-header-drawer-exp"> <i class="material-icons">search</i>
					</label>
					<div class="mdl-textfield__expandable-holder">
						<form class='search' action='<?php echo $pages->
							get('template=search')->url; ?>' method='get'>
							<input class="mdl-textfield__input" type='text' id="fixed-header-drawer-exp" name='q' placeholder='Search' value='<?php echo $sanitizer->entities($input->whitelist('q')); ?>' /></form>
					</div>
				</div>
			</div>
		</header>
	  <div class="mdl-layout__drawer">
	    <span class="mdl-layout-title"><a href="/" style="text-decoration:none;color:#3F51B5">Giggle</a></span>
	    <nav class="mdl-navigation">
	      <?php 
				// top navigation consists of homepage and its visible children
				foreach($homepage->and($homepage->children) as $item) {
					// if($item->id == $page->rootParent->id) {
					// 	echo "<li class='current'>";
					// } else {
					// 	echo "<li>";
					// }
					echo "<a class='mdl-navigation__link' href='$item->url'>$item->title</a></li>";
				}

				// output an "Edit" link if this page happens to be editable by the current user
				if($page->editable()) echo "<a class='mdl-navigation__link' href='$page->editUrl'>Edit</a>";
			?>
	    </nav>
	  </div>
	</div>

	<div id="main">
		<div class="mdl-grid">
			<!-- Wide card with share menu button -->
		<style>
		.demo-card-wide > .mdl-card__title {
		  background: url("<?php echo $image->url; ?>") center / cover;
		}
		</style>

		<div id="content" class="demo-card-wide mdl-card mdl-shadow--2dp">
		  <div class="mdl-card__title">
		    <h2 class="mdl-card__title-text"><?php echo $title; ?></h2>
		  </div>
		  <div class="mdl-card__supporting-text">
		    <?php echo $content; ?>
		  </div>
		  <?php
		  	if($blog_post) {
		  		echo "<div class='mdl-card__actions mdl-card--border author-div'>
			    <div class='published-details'>
			    	<span>Posted by $author on $published_date</span>
			    </div>
			  </div>";
		  	} 
		  ?>
		  <div class="mdl-card__menu">
		    <!-- <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
		      <i class="material-icons">share</i>
		    </button> -->
		  </div>
		</div>
		</div>
	</div>

	<!-- footer -->
			<footer class="mdl-mini-footer">
				<div class="mdl-mini-footer__left-section">
					<div class="mdl-logo"><a href="/" style="text-decoration:none;color:white">Giggle</a></div>
					<ul class="mdl-mini-footer__link-list">
						<?php 
					if($user->
						isLoggedin()) {
						// if user is logged in, show a logout link
						echo "
						<li>
							<a href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>
						</li>
						";
					} else {
						// if user not logged in, show a login link
						echo "
						<li>
							<a href='{$config->urls->admin}'>Admin Login</a>
						</li>
						";
					}
				  ?>
					</ul>
				</div>
			</footer>
			<?php
				if($page->editable()) {
					if($blog_post || $blog_list) {
					echo "
					<a href='/processwire/page/add/?parent_id=1014' class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect btn-new-post'>
					  <i class='material-icons'>add</i>
					</a>
					";
					}
				}
			?>				
</body>
</html>