<?php
/**
 * The template used for displaying page content in page-news.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>"><?php tp_the_image(); ?></a>
        <div class="entry-summary">              
                <div class="title2 entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </div>
                <?php tp_the_excerpt(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                <p class="read-more"><a href="<?php the_permalink(); ?>">Читать дальше ></a></p>
        </div><!-- .entry-content -->        
                <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post -->