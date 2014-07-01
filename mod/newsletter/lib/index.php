<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php page_title(); ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php if(defined('DEFAULT_CHARSET')) { echo DEFAULT_CHARSET; } else { echo 'utf-8'; }?>" />
  <meta name="description" content="<?php page_description(); ?>" />
  <meta name="keywords" content="<?php page_keywords(); ?>" />
  <link href="<?php echo TEMPLATE_DIR; ?>/screen.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<div id="main">
		<div id="logo">
			<h1>WebsiteBaker<span class="blue">Templates</span></h1>
		</div>

			<?php show_menu(1, 0, 1, true, '<li>[a][menu_title]</a>','</li>','<ul id="menu">','</ul>','','class="active"'); ?>

		<div id="intro_left">
      <p>
      <?php 
        echo page_description();
      ?>
      </p>
		</div>

		<div id="intro_right">
			<p class="white">Your slogan goes here...</p>
      <h1><?php echo PAGE_TITLE; ?></h1>
      <?php
        echo "<p>" . page_content(2) . "</p>";
      ?>
		</div>

		  <?php 
        show_menu(1, 1, 1, true, '<li>[a][menu_title]</a>','</li>','<ul id="menu_left">','</ul>'); 
      ?>

		<div id="left">
			<div class="box">
				<?php 
          page_content(3);
        ?>
			</div>

      <?php // Note: you probably want to change this, simply comment it out if you don't want a note to appear on your site. ?>

			<div class="note">
				<p>Welcome to this Website Baker template conversion from a standrd XHTML/CSS template to Website Baker itself!</p>
			</div>

		</div>

		<div id="right">

			<div class="leftcol">
        <?php page_content(4); ?>
			</div>

			<div class="rightcol">
        <?php page_content(5); ?>
			</div>

			<div class="special">
		    <?php page_content(1); ?>
			</div>
		</div>

		<div id="footer">
			<p>&copy; Copyright 2007 &middot; Design: <a href="http://www.solucija.com/" title="Information Architecture and Web Design">Luka Cvrk</a> &middot; Powered by the excellent CMS <a href="http://www.websitebaker.org/">Website Baker</a> &middot; Ported by: <a href="http://www.websitebakertemplates.com/">Andrew Dowellin</a></p>
		</div>
		
  </div>
</body>
</html>