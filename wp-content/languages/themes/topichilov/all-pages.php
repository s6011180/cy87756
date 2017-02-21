<?php
/**
 * Template Name: all pages
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
                        <div class="breadcrumbs"><?php if(function_exists('bcn_display')) bcn_display(); ?></div>
                        <?php query_posts('posts_per_page=-1&post_type=page'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
                                </header>
                                <footer class="entry-meta">
                                        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                                </footer><!-- .entry-meta -->
                        </article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
                        
                        <?php query_posts('posts_per_page=-1&post_type=doctors'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
                                </header>
                                <footer class="entry-meta">
                                        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                                </footer><!-- .entry-meta -->
                        </article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
                        <?php query_posts('posts_per_page=-1&post_type=post'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
                                </header>
                                <footer class="entry-meta">
                                        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                                </footer><!-- .entry-meta -->
                        </article><!-- #post -->
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>