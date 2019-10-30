<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php the_title( '', true ); ?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
</head>

<body>
	<div class="container">
		<header id="header">
			<?php bloginfo('name'); ?>
		</header>
		<main id="main">

