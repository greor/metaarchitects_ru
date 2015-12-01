<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo HTML::chars($TITLE); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo HTML::chars($PAGE_META['keywords_tag']) ?>">
	<meta name="description" content="<?php echo HTML::chars($PAGE_META['description_tag']) ?>">
	
<?php if (0): ?>
	<link rel="shortcut icon" href="images/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="images/touchicons/apple-touch-icon-57-precomposed" />
	<link rel="apple-touch-icon" sizes="114x114" href="assets/touchicons/apple-touch-icon-114-precomposed" />
	<link rel="apple-touch-icon" sizes="72x72" href="assets/touchicons/apple-touch-icon-72-precomposed" />
	<link rel="apple-touch-icon" sizes="144x144" href="assets/touchicons/apple-touch-icon-144-precomposed" />
<?php endif; ?>
	
	<link href="<?php echo $MEDIA; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>fonts/fonts.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/pace.preloader.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/slimmenu.css" rel="stylesheet"/>
	<link href="<?php echo $MEDIA; ?>stylesheets/navmenu.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/less-compiled.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main-responsive.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main-retina.css" rel="stylesheet">
<?php
	foreach ($CSS as $_css) {
		echo HTML::style($_css);
	} 
?>
	<link href="<?php echo $MEDIA; ?>stylesheets/overload.css" rel="stylesheet">

	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700,900%7CMontserrat:400,700%7CLato:400,100,300,700,900%7CLekton:400,400italic,700' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="<?php echo $MEDIA; ?>bootstrap/js/html5shiv.js"></script>
      <script src="<?php echo $MEDIA; ?>bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
	echo View_Theme::factory('layout/loader');
?>	  
	<header class="masthead white-bg visible-lg">
		<a href="<?php echo URL::base(); ?>">
			<img class="main-logo" alt="" title="" src="<?php echo $MEDIA; ?>images/logo.png"/>
		</a>
<?php
		if ( ! empty($TOP_FILTER)) {
			echo View_Theme::factory('layout/filter', array(
				'filter' => $TOP_FILTER
			));
		}
?>		
	</header>
<?php
	echo View_Theme::factory('layout/menu/top', array(
		'menu' => $menu
	));
	echo View_Theme::factory('layout/menu/mobile', array(
		'menu' => $menu
	));
?>	
	<section id="mastwrap" class="mastwrap">
<?php
		echo $content;
?>
		<footer class="mastfoot offwhite-bg">
			<div class="container">
				<div class="row">
					<article class="col-md-12 text-center">
						<div class="inner-spacer color-bg"></div>
<?php
						echo View_Theme::factory('layout/footer/social');
?>	             
					</article>
				</div>
<?php
				echo View_Theme::factory('layout/footer/copyright');
?>	             
			</div>
		</footer>
	</section>

	<script src="<?php echo $MEDIA; ?>javascripts/libs/jquery.min.js"></script>
	<script src="<?php echo $MEDIA; ?>javascripts/libs/jquery.easing.1.3.js"></script>
	<script src="<?php echo $MEDIA; ?>bootstrap/js/bootstrap.js"></script> 
	<script src="<?php echo $MEDIA; ?>javascripts/libs/pace.min.js"></script>
	<script src="<?php echo $MEDIA; ?>javascripts/libs/device.min.js"></script>
	<script src="<?php echo $MEDIA; ?>javascripts/libs/retina.js" ></script> 
	<script src="<?php echo $MEDIA; ?>javascripts/libs/classie.js" ></script> 
	<script src="<?php echo $MEDIA; ?>javascripts/libs/jquery.touchSwipe.js"></script>
	<script src="<?php echo $MEDIA; ?>javascripts/libs/waypoints.min.js" ></script> 
	<script src="<?php echo $MEDIA; ?>javascripts/libs/jquery.slimmenu.min.js"></script> 
<?php
	foreach ($JS as $_js) {
		echo HTML::script($_js);
	} 
?>
	<script src="<?php echo $MEDIA; ?>javascripts/custom/navmenu-init.js" ></script> 
	<script src="<?php echo $MEDIA; ?>javascripts/custom/main.js" ></script> 
</body>
</html>