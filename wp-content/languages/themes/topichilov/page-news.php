<?php
/**
 * Template Name: Все новости
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="primary" class="site-content content-news">
		<div id="content" role="main">
                        <div class="breadcrumbs"><?php if(function_exists('bcn_display')) bcn_display(); ?></div>
                        <?php 
                                global $post;
                                query_posts('post_type=page&post_parent='.$post->ID.'&posts_per_page=-1'/*'&paged='.get_query_var('paged')*/);
                        ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'news' ); ?>
			<?php endwhile; // end of the loop. ?>
                        <?php 
                        if(function_exists('wp_pagenavi') )
                                wp_pagenavi();
                                ?>        
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>