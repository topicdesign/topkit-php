<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- www.phpied.com/conditional-comments-block-downloads/ -->
	<!--[if IE]><![endif]-->
	
    <base href="<?php echo site_url(); ?>" />
	<title><?php echo $template['title']; ?></title>

	<!--  Mobile Viewport Fix j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag
		device-width : Occupy full width of the screen in its current orientation
		initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
		maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
	-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo site_url('assets/styles/screen.css'); ?>" media="screen, projection" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('assets/styles/print.css'); ?>" media="print" rel="stylesheet" type="text/css" />
    <!--[if lt IE 8]>
        <link href="<?php echo site_url('assets/styles/ie.css'); ?>" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->

</head>
<body>

    <!--container-->
    <div id="container">

        <?php echo $template['partials']['header']; ?>

        <!--content-->
        <div id="content">

            <?php echo display_status(); ?>

            <?php echo $template['body']; ?>

        </div>
        <!--/content-->

        <?php echo $template['partials']['footer']; ?>

    </div>
    <!--/container-->

    <?php echo get_scripts('jquery', array('combine'=>FALSE)) . get_scripts(); ?>
    <?php if (isset($template['partials']['analytics'])) echo $template['partials']['analytics']; ?>

</body>
</html>
<?php $this->output->enable_profiler(TRUE); ?>
