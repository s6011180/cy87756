<?php
/**
 * Archive Departments Template
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
                        <div class="breadcrumbs">
                        <?php if(function_exists('bcn_display')) bcn_display(); ?></div>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h1 class="entry-title">Направления в лечении в Топ Ихилов Клиник</h1>
                                </header>

                                <div class="entry-content">
                                        <?php wp_nav_menu( array( 'theme_location' => 'all-departments' ) ) ?>
                                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                                </div><!-- .entry-content -->
                        </article><!-- #post -->
                        
                        <?php // comments_template( '', true ); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>