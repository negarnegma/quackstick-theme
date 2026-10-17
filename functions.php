<?php
/**
 * QuackStick Craft: theme setup. Everything visible (menu tabs, footer text) is controlled here, not by the parent defaults.
 */
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 220, 'flex-width' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	register_nav_menus( array( 'primary' => 'منوی اصلی (تب‌های بالای سایت)', 'footer' => 'منوی فوتر' ) );
} );

/* Persian-only site: always right-to-left. (Also set Settings > General > Site Language to فارسی so WooCommerce loads its RTL styles.) */
add_filter( 'language_attributes', function ( $out ) {
	// Front end only: forcing RTL in wp-admin or on the login screen breaks their (LTR) layout when the admin language is not Persian.
	if ( is_admin() || ( isset( $GLOBALS['pagenow'] ) && 'wp-login.php' === $GLOBALS['pagenow'] ) ) { return $out; }
	return 'lang="fa-IR" dir="rtl"';
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'quackstick-craft', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
} );

/* Cart count in the header updates when something is added without reloading. */
add_filter( 'woocommerce_add_to_cart_fragments', function ( $f ) {
	$f['span.qs-cartcount'] = '<span class="qs-cartcount">' . (int) WC()->cart->get_cart_contents_count() . '</span>';
	return $f;
} );

/* Menu shown when no menu is assigned yet: shop, designer, request, account. */
function qs_theme_menu_links() {
	$links = array();
	$land  = function_exists( 'get_option' ) ? (int) get_option( 'qs_pg_landing' ) : 0;
	$links[] = array( 'خانه', $land ? get_permalink( $land ) : home_url( '/' ) );
	if ( function_exists( 'wc_get_page_permalink' ) ) { $links[] = array( 'فروشگاه', wc_get_page_permalink( 'shop' ) ); }
	foreach ( array( 'designer' => 'طراحی استیکر', 'request' => 'سفارش طراحی' ) as $k => $t ) {
		$id = (int) get_option( 'qs_pg_' . $k );
		if ( $id && get_post_status( $id ) ) { $links[] = array( $t, get_permalink( $id ) ); }
	}
	if ( function_exists( 'wc_get_page_permalink' ) ) { $links[] = array( 'حساب من', wc_get_page_permalink( 'myaccount' ) ); }
	return $links;
}
function qs_theme_menu_fallback() {
	echo '<ul class="menu">';
	foreach ( qs_theme_menu_links() as $l ) { echo '<li><a href="' . esc_url( $l[1] ) . '">' . esc_html( $l[0] ) . '</a></li>'; }
	echo '</ul>';
}

/* On activation: build the tab menu once so the shop/product list is always one tap away. */
add_action( 'after_switch_theme', function () {
	$loc = get_nav_menu_locations();
	if ( ! empty( $loc['primary'] ) ) { return; }
	$id = wp_create_nav_menu( 'منوی اصلی QuackStick ' . wp_rand( 100, 999 ) );
	if ( is_wp_error( $id ) ) { return; }
	foreach ( qs_theme_menu_links() as $l ) {
		wp_update_nav_menu_item( $id, 0, array( 'menu-item-title' => $l[0], 'menu-item-url' => $l[1], 'menu-item-status' => 'publish', 'menu-item-type' => 'custom' ) );
	}
	$loc['primary'] = $id;
	set_theme_mod( 'nav_menu_locations', $loc );
} );

add_action( 'admin_notices', function () {
	if ( 'fa_IR' !== get_locale() && current_user_can( 'manage_options' ) && 'quackstick-craft' === get_template() ) {
		echo '<div class="notice notice-info"><p>برای بهترین نتیجه، زبان سایت رو روی «فارسی» بذار (تنظیمات > همگانی > زبان سایت).</p></div>';
	}
} );
