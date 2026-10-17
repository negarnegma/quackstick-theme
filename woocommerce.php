<?php
defined( 'ABSPATH' ) || exit;
get_header();
echo '<div class="qs-wrap qs-page">';
woocommerce_content();
echo '</div>';
get_footer();
