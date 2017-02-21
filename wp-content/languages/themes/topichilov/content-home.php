<?php
/**
 * The template for displaying content on home page
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
                        <?php if( $wp_query->current_post === (int) 0 ): ?>
                        <h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
                        <?php else: ?>
			<div class="title2 entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</div>
                        <?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
                        <p class="read-more"><a href="<?php the_permalink(); ?>">Читать далее ></a></p>
		</div><!-- .entry-summary -->
	</article><!-- #post -->