<?php
/**
 * The Template for displaying all single departments post
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
                        <div class="breadcrumbs">
                        <?php if(function_exists('bcn_display')) bcn_display(); ?></div>
			<?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar('departments-right'); ?>
<?php get_footer(); ?>