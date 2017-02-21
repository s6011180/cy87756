<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
                <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
                        <div class="footer-widgets">
                                <?php dynamic_sidebar( 'sidebar-5' ); ?>
                                <br class="clear" />
                        </div><!-- .first -->
	<?php endif; ?>
		<div class="site-info">                        
                        <div id="copyright">© Copyright <a href="http://www.topichilov.ru">www.topichilov.ru</a> <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu' ) ); ?></div>
                        <div id="terms-of-service">
                                <?php echo get_option('tp_footer_text'); ?>
                        </div>                        
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>