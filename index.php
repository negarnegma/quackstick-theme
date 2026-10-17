<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<div class="qs-wrap qs-page">
<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
	<article class="qs-post">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	</article>
<?php } the_posts_pagination(); } else { echo '<p>چیزی پیدا نشد.</p>'; } ?>
</div>
<?php get_footer();
