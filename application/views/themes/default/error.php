<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo HTML::chars($TITLE); ?></title>
	
<?php if (0): ?>
	<link rel="shortcut icon" href="images/favicon/favicon.ico">
<?php endif; ?>

	<link href="<?php echo $MEDIA; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>fonts/fonts.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/pace.preloader.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/ionicons.min.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/slimmenu.css" rel="stylesheet"/>
	<link href="<?php echo $MEDIA; ?>stylesheets/navmenu.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/owl.theme.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/venobox.css" rel="stylesheet" />
	<link href="<?php echo $MEDIA; ?>stylesheets/parallax.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/jquery.bxslider.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/less-compiled.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main-responsive.css" rel="stylesheet">
	<link href="<?php echo $MEDIA; ?>stylesheets/main-retina.css" rel="stylesheet">
	
	<link href="<?php echo $MEDIA; ?>less/color.less" rel="stylesheet/less" type="text/css">
	<link href="<?php echo $MEDIA; ?>less/fonts.less" rel="stylesheet/less" type="text/css">
	<script src="<?php echo $MEDIA; ?>less/less-1.7.3.min.js"></script>

	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700,900%7CMontserrat:400,700%7CLato:400,100,300,700,900%7CLekton:400,400italic,700' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
		<script src="<?php echo $MEDIA; ?>bootstrap/js/html5shiv.js"></script>
		<script src="<?php echo $MEDIA; ?>bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<section id="mastwrap" class="mastwrap" style="height: 100%;">
		<section class="page-fold subtle fullheight" style="height: 100%;">  
			<div class="valign">
				<div class="container">
					<div class="row">
						<article class="text-center col-md-12">
							<h1 class="page-heading font4bold black"><?php echo $code; ?></h1>
							<div class="sub-spacer color-bg"></div>
							<h4 class="sub-heading-minor font4light dark"><?php echo $message; ?></h4>
						</article>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>