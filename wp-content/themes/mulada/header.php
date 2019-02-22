<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<?php mulada_page_loading(); ?>
	<?php mulada_wrapper_before(); ?>
	<?php mulada_site_content_start(); ?>
	<header class="header header-fixed<?php mulada_header_style_class(); ?>">
		<div class="menu-area">
			<div class="container">
				<?php mulada_header_styles_social_media(); ?>
				<?php mulada_site_logo(); ?>
				<?php header_menu_button(); ?>
				<?php mulada_header_search(); ?>
				<nav class="navbar">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only"><?php echo esc_html_e( 'Toggle Navigation', 'mulada' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>
					<?php wp_nav_menu( array( 'menu' => 'mainmenu', 'theme_location' => 'mainmenu', 'depth' => 5, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'mulada_walker::fallback', 'walker' => new mulada_walker()) ); ?>
				</nav>
			</div>
		</div>
	</header>