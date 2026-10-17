<?php
/* Template Name: تمام‌عرض (بدون عنوان) */
defined( 'ABSPATH' ) || exit;
get_header();
echo '<div class="qs-full">';
while ( have_posts() ) { the_post(); the_content(); }
echo '</div>';
get_footer();
