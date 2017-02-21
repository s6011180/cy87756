<?php
require_once '../../../wp-load.php';

function tm_remove_redirect_for_wpcf7()
{
    if( !WPCF7_PLUGIN_URL )
        return false;
    
    wp_dequeue_script('contact-form-7-custom');
    
    wp_enqueue_script( 'contact-form-7',
                    WPCF7_PLUGIN_URL.'/includes/js/scripts.js',
		array( 'jquery', 'jquery-form' ), WPCF7_VERSION, true );
    
    $_wpcf7 = array(
            'loaderUrl' => wpcf7_ajax_loader(),
            'sending' => __( 'Sending ...', 'wpcf7' ) );

    if ( defined( 'WP_CACHE' ) && WP_CACHE )
            $_wpcf7['cached'] = 1;

    wp_localize_script( 'contact-form-7', '_wpcf7', $_wpcf7 );
}

add_action('wpcf7_enqueue_scripts', 'tm_remove_redirect_for_wpcf7', 1000);

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<style type="text/css">
        body{
                min-width: 0;
        }
</style>
</head>
    <body>
        <div id="contactFormContent">
            <?php echo do_shortcode('[crm-form-callme]'); ?>
        </div>
    <?php wp_footer(); ?>
    </body>
</html>