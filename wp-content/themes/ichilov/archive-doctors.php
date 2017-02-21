<?php
/**
 * Archive Doctors Template
 */

get_header(); ?>
<?php get_sidebar('left'); ?>
	<section id="primary" class="site-content">
		<div id="content" role="main">
                    <div class="breadcrumbs"><?php if(function_exists('bcn_display')) bcn_display(); ?></div>
		<?php if ( have_posts() ) : ?>
			<?php
                        global $post;
                        
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                        $inner_count = 1;
                    
                        $doctors_query = array( 
                                'post_type' => 'doctors'
                               ,'paged' => $paged
                               ,'showposts' => -1
                               ,'order' => 'ASC'
                        );

//                        $last_spec = false;

                        if( get_option('tp_by_categories')){

                                add_filter('posts_orderby', 'dc_posts_orderby');
                                add_filter('posts_where', 'dc_posts_where');
                                add_filter('posts_join', 'dc_posts_join', 999);
//                                add_filter('query', 'dc_query');

                        }
                    
                        $doctors = new WP_Query( $doctors_query );
                        $i = 0;
			while ( $doctors->have_posts() ) : $doctors->the_post(); 
                        
                        $image_url      = tp_get_thumbnail( get_the_ID(), get_the_content() );
                        $image          = tp_resize_image( $image_url, TP_DOCTOR_WIDTH, TP_DOCTOR_HEIGHT );
                        
//                        $specialization = get_the_terms( get_the_ID(), 'specialization' );
//                        
//                        $current_spec = current($specialization)->name;
                        
//                        if( get_option('tp_by_categories')){
//                                    
//                            if( $last_spec !== $current_spec)
//                                echo '<div class="title2 speciality-title">'.$current_spec.'</div>';
//
//                        }
                        $the_excerpt = $post->post_excerpt;
                        ?>
                            <div class="main-doctor-item">
                                <a href="<?php the_permalink(); ?>" class="main-doctor-link" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="">
                                    <br /><?php the_title(); ?><br />
                                    <span class="doctor-excerpt"><?php echo $the_excerpt; ?></span>
                                </a>
                            </div>                        
                        
			<?php 
//                        $last_spec = $current_spec;
                        
                        endwhile;
                        wp_reset_query();
                        if( get_option('tp_by_categories')){
                        
                            remove_filter('posts_orderby', 'dc_posts_orderby');
                            remove_filter('posts_where', 'dc_posts_where');
                            remove_filter('posts_join', 'dc_posts_join', 999);
                            
                        }
                        
			?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>