<?php defined( 'ABSPATH' ) || exit; ?>
</main>
<footer class="qs-foot">
	<div class="qs-wrap">
		<a class="qs-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
		<p><?php echo esc_html( get_theme_mod( 'qs_tagline', 'استیکرهای اردکی، با کمی قات‌قات.' ) ); ?></p>
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?>
		<?php if ( function_exists( 'qs_tg_url' ) && qs_tg_url() ) { ?>
			<p><a href="<?php echo esc_url( qs_tg_url() ); ?>" target="_blank" rel="noopener">تلگرام ما</a></p>
		<?php } ?>
		<p class="qs-copy">© <?php echo esc_html( function_exists( 'qs_fa' ) ? qs_fa( wp_date( 'Y' ) ) : wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
