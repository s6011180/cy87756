<?php
/**
 * Template Name: Заявка на лечение
 */

get_header(); ?>
	<div id="primary" class="site-content full-width">
		<div id="content" role="main">
                        <div class="breadcrumbs"><?php if(function_exists('bcn_display')) bcn_display(); ?></div>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>