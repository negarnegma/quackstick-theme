<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<div class="qs-wrap qs-page">
<?php while ( have_posts() ) { the_post(); ?>
	<article class="qs-post"><h1><?php the_title(); ?></h1><?php the_content(); ?></article>
<?php } ?>
</div>
<?php get_footer();
