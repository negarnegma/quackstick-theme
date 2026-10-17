<?php defined( 'ABSPATH' ) || exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="qs-head">
	<div class="qs-wrap qs-bar">
		<a class="qs-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
			if ( has_custom_logo() ) { the_custom_logo(); } else { echo esc_html( get_bloginfo( 'name' ) ); }
		?></a>
		<input type="checkbox" id="qs-nav" class="qs-navchk" aria-hidden="true" tabindex="-1">
		<nav class="qs-nav" aria-label="منوی اصلی">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'qs_theme_menu_fallback', 'depth' => 1 ) ); ?>
		</nav>
		<?php if ( function_exists( 'WC' ) && WC()->cart ) { ?>
			<a class="qs-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">سبد خرید <span class="qs-cartcount"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span></a>
		<?php } ?>
		<label class="qs-burger" for="qs-nav" aria-label="منو"><span></span></label>
	</div>
</header>
<main class="qs-main">
