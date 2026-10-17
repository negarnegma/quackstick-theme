<?php
defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) {
	the_post();
	$land = has_shortcode( get_the_content(), 'quackstick_landing' );
	if ( $land ) { the_content(); continue; }
	echo '<article class="qs-wrap qs-page"><h1 class="qs-title">' . esc_html( get_the_title() ) . '</h1>';
	the_content();
	echo '</article>';
}
get_footer();
