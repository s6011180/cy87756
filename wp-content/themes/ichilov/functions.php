<?php
/**
 * Twenty Twelve functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//add_action('wp_loaded', 'wpc_custom_regirect');
//
//function wpc_custom_regirect(){
//        global $wp_query;        
//        
//        if( get_option('tp_enable_redirect') !== '1' )
//                return false;
//        
//        $redirect               = false;
//        $default_redirect       = get_option('tp_default_redirect_url');
//        
//        if( is_single() ){ 
//                $post_id        = get_the_ID();
//                $redirect       = get_post_meta( $post_id, 'wpc_redirect', true );
//                var_dump( $post_id );
//        }
//        
//        if( ! $redirect )
//                $redirect =  $default_redirect;
//}

define('TP_DOCTOR_WIDTH', 140); 
define('TP_DOCTOR_HEIGHT', 160);

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

function dump( $var ){
        mail( 's544836@gmail.com', 'TopIchilov', print_r( $var, true ) );
}

/**
 * Twenty Twelve setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
//	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );
        register_nav_menu( 'departments-1', 'Отделения ТопИхилов 1' );
        register_nav_menu( 'departments-2', 'Отделения ТопИхилов 2' );
        register_nav_menu( 'departments-3', 'Отделения ТопИхилов 3' );
        register_nav_menu( 'all-departments', 'Все отделения' );
        register_nav_menu( 'footer', 'Подвал' );
	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
        
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
        wp_enqueue_script( 'assuta-colorbox', get_template_directory_uri() . '/js/colorbox/jquery.colorbox-min.js', array('jquery'), '1.3.14', true );
        wp_enqueue_style( 'assuta-colorbox-style', get_template_directory_uri().'/js/colorbox/theme3/colorbox.css' );
	wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style('jquery-style', get_bloginfo('template_url') . '/css/jquery-ui-1.10.4.custom.min.css');
	$font_url = twentytwelve_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'twentytwelve-fonts', esc_url_raw( $font_url ), array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function twentytwelve_mce_css( $mce_css ) {
	$font_url = twentytwelve_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'twentytwelve_mce_css' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Правый сайдбар', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title3 widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Левый сайдбар', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title3 widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title3 widget-title">',
		'after_title' => '</div>',
	) );
        
        register_sidebar( array(
		'name' => __( 'Правый сайдбар Заболеваний', 'twentytwelve' ),
		'id' => 'sidebar-4',
		'description' => 'Отображается на страницах заболеваний и отделений',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title3 widget-title">',
		'after_title' => '</div>',
	) ); 
        
        register_sidebar( array(
		'name' => __( 'Подвал', 'twentytwelve' ),
		'id' => 'sidebar-5',
		'description' => 'Область виджетов в подвале',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="title3 widget-title">',
		'after_title' => '</div>',
	) ); 
        
        register_widget( 'TM_Video_Widget' );
        register_widget( 'WPC_Video_Response_Widget' ); 
        register_widget( 'WPC_Department_Doctors_Widget' );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<div class="title3 assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></div>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function tp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php   echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b></cite>',
						get_comment_author_link()
					);
					printf( '<time datetime="%1$s">%2$s</time>',
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s', 'twentytwelve' ), get_comment_date() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'login_text' => '' ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
//	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
//		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );

/* ADDS BY STEPASYUK */

add_action( 'init', 'tp_post_type_init' );
function tp_post_type_init() {
    $labels = array(
    'name' => 'Врачи',
    'singular_name' => 'Врач',
    'add_new' => 'Добавить нового',
    'add_new_item' => 'Добавить врача',
    'edit_item' => 'Изменить врача',
    'new_item' => 'Новый врач',
    'all_items' => 'Все врачи',
    'view_item' => 'Просмотр врача',
    'search_items' => 'Поиск врача',
    'not_found' =>  'Врачи не найдены',
    'not_found_in_trash' => 'Врачи не найдены в корзине', 
    'parent_item_colon' => '',
    'menu_name' => 'Врачи'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'врачи', 'URL slug', 'twentytwelve' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'comments', 'custom-fields', 'excerpt', 'thumbnail', 'revisions' )
  ); 
  register_post_type( 'doctors', $args );
  
  $labels = array(
    'name' => 'Направления в лечении в Топ Ихилов Клиник',
    'singular_name' => 'Заболевание',
    'add_new' => 'Добавить новое',
    'add_new_item' => 'Добавить заболевание',
    'edit_item' => 'Изменить заболевание',
    'new_item' => 'Новое заболевание',
    'all_items' => 'Все зеболевания',
    'view_item' => 'Просмотр заболевания',
    'search_items' => 'Поиск заболевания',
    'not_found' =>  'Заболевания не найдены',
    'not_found_in_trash' => 'Заболевания не найдены в корзине', 
    'parent_item_colon' => '',
    'menu_name' => 'Заболевания'
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'отделения', 'URL slug', 'twentytwelve' ) ),
    'capability_type' => 'page',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'comments', 'custom-fields', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' )
  ); 
  register_post_type( 'departments', $args );
  
//  $labels = array(
//    'name' => 'Видео-отзывы',
//    'singular_name' => 'Видео-отзыв',
//    'add_new' => 'Добавить новый',
//    'add_new_item' => 'Добавить видео-отзыв',
//    'edit_item' => 'Изменить видео-отзыв',
//    'new_item' => 'Новый видео-отзыв',
//    'all_items' => 'Все видео-отзывы',
//    'view_item' => 'Просмотр видео-отзыва',
//    'search_items' => 'Поиск видео-отзыва',
//    'not_found' =>  'Видео-отзывы не найдены',
//    'not_found_in_trash' => 'Видео-отзывы не найдены в корзине', 
//    'parent_item_colon' => '',
//    'menu_name' => 'Видео-отзывы'
//  );
  
//  $args = array(
//    'labels' => $labels,
//    'public' => true,
//    'publicly_queryable' => true,
//    'show_ui' => true, 
//    'show_in_menu' => true, 
//    'query_var' => true,
//    'rewrite' => array( 'slug' => _x( 'review', 'URL slug', 'twentytwelve' ) ),
//    'capability_type' => 'post',
//    'has_archive' => true, 
//    'hierarchical' => false,
//    'menu_position' => null,
//    'supports' => array( 'title', 'editor', 'author', 'comments', 'custom-fields', 'excerpt', 'thumbnail' )
//  ); 
  
//  register_post_type( 'review', $args );
  
  // Add new taxonomy, make it hierarchical (like categories)
    $dc_labels = array(
            'name'              => _x( 'Специализации', 'taxonomy general name' ),
            'singular_name'     => _x( 'Специализация', 'taxonomy singular name' ),
            'search_items'      => __( 'Искать специализацию' ),
            'all_items'         => __( 'Все спец-и' ),
            'parent_item'       => __( 'Родительская специализация' ),
            'parent_item_colon' => __( 'Родительская специализация:' ),
            'edit_item'         => __( 'Редактировать специализацию' ),
            'update_item'       => __( 'Обновить специализацию' ),
            'add_new_item'      => __( 'Добавить новую специализацию' ),
            'new_item_name'     => __( 'Новое имя специализации' ),
            'menu_name'         => __( 'Специализации' ),
    );

    $dc_args = array(
            'hierarchical'      => true,
            'labels'            => $dc_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'specialization' ),
    );

    register_taxonomy( 'specialization', array( 'specialization' ), $dc_args );
    register_taxonomy_for_object_type( 'specialization', 'doctors' );   

}

add_filter( 'post_updated_messages', 'tp_updated_messages' );
function tp_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['doctors'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Врач обновлен. <a href="%s">Просмотр врача</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Meetstaat updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Врач восстановлен из %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Врач опубликован. <a href="%s">Просмотр врача</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Врач сохранен.'),
    8 => sprintf( __('Врач сохранен <a target="_blank" href="%s">Просмотр врача</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Врач запланирован для: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр врача</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновый врача обновлен. <a target="_blank" href="%s">Предпросмотр врача</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  
  return $messages;
}

add_action('admin_menu', 'tp_create_menu');

function tp_create_menu() {
        add_submenu_page('themes.php', 'Настройки шаблона', 'Топ Ихилов', 'administrator', 'tp_settings', 'tp_settings_page');

	add_action( 'admin_init', 'tp_register_settings' );
}

function tp_register_settings() {
   
        //register our settings
        $settings = array(
             'tp_phone_1', 'tp_city_1', 'tp_phone_2', 'tp_city_2'
            ,'tp_phone_3', 'tp_city_3', 'tp_contact_header'
            ,'tp_by_categories' ,'tp_all_branches','tp_ask_doctor'
            ,'tp_home_cat','tp_departments_header', 'tp_sub_header'
            ,'tp_footer_text','tp_comments_header','tp_menu_title'
            ,'tp_ask_doctor_link', 'tp_review_page_title'
        );
        
        foreach( $settings as $setting_name )
            register_setting( 'tp-settings-group', $setting_name );
}

function tp_settings_page() {
?>
<div class="wrap">
<h2>Настройки ТопИхилов</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'tp-settings-group' ); ?>
    <table class="form-table">   
        <tr valign="top">
            <th scope="row">Телефоны</th>
            <td>
                <table>
                        
                        <tr>
                            <td>
                                <label for="tp_city_1">Город</label><br />
                                <input id="tp_city_1" type="text" name="tp_city_1" value="<?php echo get_option('tp_city_1'); ?>" />
                            </td>
                             <td>
                                <label for="tp_phone_1">Номер</label><br />
                                <input id="tp_phone_1" type="text" name="tp_phone_1" value="<?php echo get_option('tp_phone_1'); ?>" />
                             </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="tp_city_2" type="text" name="tp_city_2" value="<?php echo get_option('tp_city_2'); ?>" />
                            </td>
                             <td>
                                <input id="tp_phone_2" type="text" name="tp_phone_2" value="<?php echo get_option('tp_phone_2'); ?>" />
                             </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="tp_city_3" type="text" name="tp_city_3" value="<?php echo get_option('tp_city_3'); ?>" />
                            </td>
                             <td>
                                <input id="tp_phone_3" type="text" name="tp_phone_3" value="<?php echo get_option('tp_phone_3'); ?>" />
                             </td>
                        </tr>
               </table>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Подзаголовок сайта</th>
            <td>
                <input type="text" size="55" name="tp_sub_header" value="<?php echo get_option('tp_sub_header'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Заголовок в главном меню</th>
            <td>
                <input type="text" size="55" name="tp_menu_title" value="<?php echo get_option('tp_menu_title'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Заголовок Зявки на лечение (мини)</th>
            <td>
                <input type="text" size="55" name="tp_contact_header" value="<?php echo get_option('tp_contact_header'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Заголовок блока отделений на Главной</th>
            <td>
                <input type="text" size="55" name="tp_departments_header" value="<?php echo get_option('tp_departments_header'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Заголовок блока Вопросов и Отзывов</th>
            <td>
                <input type="text" size="55" name="tp_comments_header" value="<?php echo get_option('tp_comments_header'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Ссылка кнопки "Задать вопрос врачу"</th>
            <td>
                <input type="text" size="55" name="tp_ask_doctor_link" value="<?php echo get_option('tp_ask_doctor_link'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Страница "Отделения"</th>
            <td>
                <?php wp_dropdown_pages( array(
                     'selected' => get_option('tp_all_branches')
                    ,'name'     => 'tp_all_branches'
                    ) ); ?>
            </td>
        </tr>
        <!-- <tr valign="top">
        <th scope="row">Разбивать резюме по специализациям?</th>
        <td>
            <select name="tp_by_categories">
                <option value="0" <?php if( !get_option('tp_by_categories') ) echo 'selected="selected"'; ?>>Нет</option>
                <option value="1" <?php if( get_option('tp_by_categories') ) echo 'selected="selected"'; ?>>Да</option>
            </select>
        </td>
        </tr> -->
        <tr valign="top">
            <th scope="row">Рубрика "На Главной"</th>
            <td>
                <?php wp_dropdown_categories( array(
                     'selected'     => get_option('tp_home_cat')
                    ,'name'         => 'tp_home_cat'
                    ,'hide_empty'   => false
                    ) ); ?>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Заголовок страницы Видео-отзывов</th>
            <td>
                <input type="text" size="55" name="tp_review_page_title" value="<?php echo get_option('tp_review_page_title'); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Текст в подвале</th>
            <td>
                <textarea name="tp_footer_text" cols="60" rows="5"><?php echo get_option('tp_footer_text'); ?></textarea>
            </td>
        </tr>
	</table>
	<p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
</form>
</div>
<?php 
}

class TM_Video_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'tm_video_widget', // Base ID
			'Видео отзывы', // Name
			array( 'description' => 'Виджет выводит видео из соответствующей рубрики', )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
                
		$title       = apply_filters( 'widget_title', $instance['title'] );
                $posts_count = $instance['posts_count'] ? preg_replace('/[^\d]*/', '', $instance['posts_count']) : 2;
                $video_rubric = (int) $instance['video_cat_id']; //get_option('tp_video');
                if( $video_rubric == 1)
                        return false;
                
                $args = array(
                    'showposts' => $posts_count,
                    'cat' => $video_rubric
                );
                
                $output = '<ul class="last-videos">';
                $news = new WP_Query( $args );
                echo $before_widget;

                echo $before_title . $title . $after_title;

                if( $news->have_posts() ) :
                    while( $news->have_posts() ) :
                    $news->the_post();
                        
                    $content = get_the_content();
                    
                    $image_src = wpc_get_video_thumbnail( $content );
                    
                    if( $image_src )
                            $image = tp_resize_image ( $image_src, 184, 102);
                    else
                            continue;
                    
                        $output .= '<li>'."\r\n";
                        $output .= '<div class="title4"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div>';
                        $output .= '<div class="video-thumbnail"><a href="'.get_permalink().'" title="'.get_the_title().'"><span></span><img src="'.$image.'" /></a></div>';
                        $output .= '</li>'."\r\n";
                    endwhile;
                endif;
                wp_reset_query();
                
                $output .= '</ul>';
                $output .= '<p class="all-items"><a href="'.get_category_link(get_option('tp_video')).'" title="Все отзывы">Все отзывы ></a></p>';
                
                echo $output;
                
		echo $after_widget;
	}
        
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
                $instance['posts_count'] = strip_tags( $new_instance['posts_count'] );
                $instance['video_cat_id'] = strip_tags( $new_instance['video_cat_id']  ); 
		return $instance;
	}

	public function form( $instance ) {
                $title = $instance[ 'title' ];
                $posts_count = $instance[ 'posts_count' ];
                $video_cat_id = $instance['video_cat_id'];
                
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
                <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Рубрика для видео отзывов</label>
                        <?php 
                                wp_dropdown_categories( array(
                                        'selected'     => $video_cat_id
                                       ,'name'         => $this->get_field_name( 'video_cat_id' )
                                       ,'hide_empty'   => false
                                       ,'id'           => $this->get_field_id( 'video_cat_id' )
                               ) ); 
                        ?>
                </p>
                <p>
		<label for="<?php echo $this->get_field_id( 'posts_count' ); ?>">Макс.количество отзывов</label>
		<input id="<?php echo $this->get_field_id( 'posts_count' ); ?>" name="<?php echo $this->get_field_name( 'posts_count' ); ?>" type="text" value="<?php echo esc_attr( $posts_count ); ?>" size="3" />
		</p>
		<?php
	}
}

class WPC_Video_Response_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'wpc_video_widget', // Base ID
			'Отзывы для заболеваний', // Name
			array( 'description' => 'Отображает отзывы, если они заданы для страницы', )
		);
	}

	public function widget( $args, $instance ) {
		global $post;
                extract( $args ); 
                $settings = array();                
                
                foreach( array( 'wpc_video_url', 'wpc_video_desc', 'wpc_video_page'
                        , 'wpc_review_url', 'wpc_review_desc', 'wpc_all_reviews_text'
                        , 'wpc_all_reviews_url', 'wpc_video_content') as $name){
                        
                        $settings[$name] = get_post_meta($post->ID, $name, true);
                        
                }
                
                if( ! $settings['wpc_video_url'] && ! $settings['wpc_review_desc'] )
                        return false;
                
		$title       = apply_filters( 'widget_title', $instance['title'] );
                
                $output = '<ul class="video-review-list">';
                $output .= '<li>'."\r\n";
                
                echo $before_widget;
                
                if( $title )
                        echo $before_title . $title . $after_title;

                if( $settings['wpc_video_url'] ){                    
                          
//                    $youtube_id = tp_youtube_id_from_url( $settings['wpc_video_url'] );
//                    $yandex_url = $settings['wpc_video_url'];
//                    
//                    if( $youtube_id )
//                        $image = tp_resize_image ( "http://img.youtube.com/vi/$youtube_id/0.jpg", 200, 110);
//                    elseif( $yandex_url )
//                        $image = tp_resize_image (wpc_get_yandex_video_img ($yandex_url), 200, 110);
                        $image_src = wpc_get_video_thumbnail($settings['wpc_video_url']);
                        $image     = tp_resize_image ( $image_src, 200, 110 );
                        
                        $output .= '<div class="video-thumbnail"><a href="'.$settings['wpc_video_page'].'" title="'.$settings['wpc_video_desc'].'"><span></span><img src="'.$image.'" /></a></div>';
                        $output .= '<div class="title4">'.$settings['wpc_video_desc'].'</div>';
                        
                        if( $settings['wpc_video_content'] )
                                $output .= '<div class="video-content">'.$settings['wpc_video_content'].'</div>';
                }
                
                if( $settings['wpc_video_url'] && $settings['wpc_review_desc'])
                        $output .= '<div class="dotted-line"></div>';
                
                if( $settings['wpc_review_desc'] ){
                        
                        $output .= '<div class="wpc_video_review_excerpt">'.$settings['wpc_review_desc'];
                        $output .= '<p class="wpc-read-more"><a href="'.$settings['wpc_review_url'].'">Читать далее...</a></p>';
                        $output .= '<div class="wpc_video_review_tail">&nbsp;</div></div>';
                
                }
                        
                $output .= '</li>'."\r\n";
                $output .= '</ul>';
                if( $settings['wpc_all_reviews_url'] )
                        $output .= '<p class="all-items"><a href="'.$settings['wpc_all_reviews_url'].'">'.$settings['wpc_all_reviews_text'].'</a></p>';
                
                echo $output;
                
		echo $after_widget;
	}
        
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	public function form( $instance ) {
                $title          = $instance[ 'title' ];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
                <p>
		<?php
	}
}

class WPC_Department_Doctors_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'wpc_department_doctors', // Base ID
			'Врачи отделения', // Name
			array( 'description' => 'Отображает врачей отделения, если они заданы для страницы', )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args ); global $post;
                
		$title       = apply_filters( 'widget_title', $instance['title'] );
                
                $related_doctors = get_post_meta($post->ID, 'department_doctors', true);
                
                if( ! $related_doctors )
                        return false;
                
                $related_doctors = explode(",", $related_doctors);

                $output = '<ul class="department-doctors-list">';
                
                echo $before_widget;
                
                if( $title )
                        echo $before_title . $title . $after_title;
                
                foreach( $related_doctors as $doctor_shortcode ):
                    
                        $output .= '<li>'."\r\n";
                        $output .= do_shortcode($doctor_shortcode);
                        $output .= '</li>'."\r\n";
                        
                endforeach;
                $output .= '</ul>';
                
                echo $output;
                
		echo $after_widget;
	}
        
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	public function form( $instance ) {
                $title          = $instance[ 'title' ];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}
}

function wpc_get_video_thumbnail( $content ){
        
        $image_src = false;
        
        $youtube_id = tp_youtube_id_from_url( $content );
        
        if( $youtube_id ){
                $image_src = "http://img.youtube.com/vi/$youtube_id/0.jpg";
                return $image_src;
        }
        
        $yandex_video_url = wpc_get_yandex_video_url( $content );
        
        // Maybe it's Rutube video. Yandex and Rutube has same API for their thumbnails
        if( ! $yandex_video_url ){
                $rutube_video_url = wpc_get_rutube_video_url( $content );
                $yandex_video_url = $rutube_video_url;
        }
        
        if( $yandex_video_url ){
                $image_src = wpc_get_yandex_video_img( $yandex_video_url );
                return $image_src;
        }
        
        return $image_src;
}

function wpc_get_rutube_video_url( $content ){
        
        $pattern = '#rutube.ru/video/([a-z0-9]+)/#';
    
        $result = preg_match( $pattern, $content, $matches );
        
        if ( !empty( $result ) ) {
            return 'http://rutube.ru/video/'.$matches[1].'/';
        }else{
                $pattern = '#//rutube.ru/play/embed/([0-9]+)[\/|\"\']#';
                $result = preg_match( $pattern, $content, $matches );
                
                return 'http://rutube.ru/tracks/'.$matches[1].'.html';
        }
        
        return false;
}

function tp_youtube_id_from_url($content) {    
    
    $pattern = 
        '%# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        %x'
        ;
    $result = preg_match($pattern, $content, $matches);
    
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}

function wpc_get_yandex_video_url($content) {    
    
    $pattern = '#src=[\"|\']+([^\"\']+video\.yandex\.ru[^\"\']+)#';
    
    $result = preg_match($pattern, $content, $matches);
    
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}

function wpc_get_yandex_video_img( $video_url ){
        $request = 'http://video.yandex.ru/oembed?url='.$video_url.'&format=json';
        $result = file_get_contents($request);
        
        $data = json_decode($result);
        
        if( isset($data->thumbnail_url) )
                return $data->thumbnail_url;
        return false;
}

function tp_the_phones(){
        $output = '';
        
        for( $i = 1; $i <= 3; $i++ ){
                if( get_option('tp_city_'.$i) && get_option('tp_phone_'.$i)){
                        
                        if( tp_mobile_detect() ){
                              $phone = '<a href="tel:'.get_option('tp_phone_'.$i).'">'.get_option('tp_phone_'.$i).'</a>';
                        }else{
                              $phone = get_option('tp_phone_'.$i);
                        }
                        
                        $output .= '<p><span class="contact-city">'.get_option('tp_city_'.$i).':</span> '.$phone.'</p>';
                }
        }
        
        echo $output;
}

function tp_mobile_detect()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $ipod = strpos($user_agent,"iPod");
    $iphone = strpos($user_agent,"iPhone");
    $android = strpos($user_agent,"Android");
    $symb = strpos($user_agent,"Symbian");
    $winphone = strpos($user_agent,"WindowsPhone");
    $wp7 = strpos($user_agent,"WP7");
    $wp8 = strpos($user_agent,"WP8");
    $operam = strpos($user_agent,"Opera M");
    $palm = strpos($user_agent,"webOS");
    $berry = strpos($user_agent,"BlackBerry");
    $mobile = strpos($user_agent,"Mobile");
    $htc = strpos($user_agent,"HTC_");
    $fennec = strpos($user_agent,"Fennec/");

    if ($ipod || $iphone || $android || $symb || $winphone || $wp7 || $wp8 || $operam || $palm || $berry || $mobile || $htc || $fennec) 
    {
        return true; 
    } 
    else
    {
        return false;
    }
}

function tp_the_departments(){
        $title = get_option('tp_departments_header');
        ?>

<article id="topIchilov-departments">
        <?php if( $title ): ?>
<header class="entry-header">
        <div class="title2 entry-title"><?php echo $title; ?></div>
</header>
        <?php endif; ?>
        <?php wp_nav_menu( array( 'theme_location' => 'departments-1', 'container_class' => 'departments' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'departments-2', 'container_class' => 'departments' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'departments-3', 'container_class' => 'departments' ) ); ?>
        <p class="read-more">
                <a href="<?php echo get_permalink( get_option('tp_all_branches') ); ?>">Все отделения ></a>
        </p>
</article>
        <?php
}

function tp_the_excerpt(){
        global $post;
        
        if( $post->post_excerpt )
                echo $post->post_excerpt;
        else
                echo '...';
}

function tp_get_the_related_doctor( $doctor_id ){
        if( ! $doctor_id )
                return false;
        
        $doctor                 = get_post($doctor_id);
        $title                  = get_the_title( $doctor_id );
        $permalink              = get_option('tp_ask_doctor_link');
        $doctor_permalink       = get_permalink( $doctor_id );

        $image_url      = tp_get_thumbnail( $doctor->ID, $doctor->post_content );
        $image          = tp_resize_image( $image_url, TP_DOCTOR_WIDTH, TP_DOCTOR_HEIGHT );

        $output  = '<div class="main-doctor-item">';
                $output .= '<a title="'.$title.'" class="main-doctor-link" href="'.$doctor_permalink.'">';
                        $output .= '<img src="'.$image.'"><br>'.$title.'<br>';
                        
                if( get_post_type() !== 'doctors' )
                        $output .= '<span class="doctor-excerpt">'.$doctor->post_excerpt.'</span>';
                
                $output .= '</a>';
                $output .= '<p class="doctor-button-wrapper"><a title="'.$title.'" class="main-doctor-link doctor-button" href="'.$permalink.'">';
                        $output .= 'Задать вопрос врачу';
                $output .= '</a></p>';
        $output .= '</div>';
        
        return $output;
}

add_shortcode('doctor', 'tp_doctor_shortcode');
function tp_doctor_shortcode( $atts ) {
    $doctor_id = $atts['id'];
    if( !$doctor_id )
        return false;
    
    $output = tp_get_the_related_doctor($doctor_id);
    
    return '<div class="no-doctor-float">'.$output.'</div>';
}

add_filter('the_content', 'tp_add_related_doctor_to_content');
function tp_add_related_doctor_to_content( $content ){
        global $post;
        
        $related_doctors = array();
        $output = '';
        
        if( $post->post_type === 'doctors' ){
                $related_doctors[0] = $post->ID;
        }else{
                $related_doctors_str = get_post_meta($post->ID, 'related_doctors', true);
                $related_doctors     = explode(",", $related_doctors_str);
        }
        
        foreach( $related_doctors as $doctor_id ){
                $output .= tp_get_the_related_doctor($doctor_id);
        }
        
        return $output.$content;
}

function tp_get_thumbnail( $post_id, $content = null)
{
    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
    
    if( $post_thumbnail_id ){
        $image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
        return $image[0]; // Image src
    }
    
    if( !$content ){
        $the_post = get_post($post_id);
        $content = $the_post->post_content;
    }
    
    $image_src = tp_catch_image( $content );
    if( $image_src )
        return $image_src;
    
    $src_default = get_bloginfo('home').'/wp-content/uploads/2014/02/royblat.jpg';
    
    return $src_default;
}

function tp_catch_image( $content )
{
    preg_match('/<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1/im', $content, $results);
    return $results[2];
}

function tp_resize_image( $image_url, $width, $height, $crop = 1 ){
    if( !$image_url )
            return false;
    
    return get_bloginfo('template_url').'/timthumb.php?src='.$image_url.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc='.$crop;
}

function tp_the_image( $width = 186, $height = 112 ){
        global $post;
        
        $img_src = tp_catch_image($post->post_content);
        if( !$img_src )
                return false;
        
        echo '<img class="tp-image" src="'.tp_resize_image($img_src, $width, $height).'" alt="" />';
}

add_action( 'add_meta_boxes', 'tp_add_meta_boxes' );

function tp_add_meta_boxes()
{
    add_meta_box('tp-doctors', 'Опции Страницы', 'tp_doctors_meta_box', 'page');
    add_meta_box('tp-doctors', 'Опции Страницы Врача', 'tp_doctors_meta_box', 'doctors');
    add_meta_box('tp-doctors', 'Опции Записи', 'tp_doctors_meta_box', 'post');
    add_meta_box('tp-doctors', 'Опции Заболевания', 'tp_doctors_meta_box', 'departments');
    add_meta_box('tp-doctors', 'Опции страницы Видео-отзыва', 'tp_doctors_meta_box', 'review');
}

function tp_doctors_meta_box( $post, $box ) {
        
        global $wpdb;
        
        foreach( array( 'tp_contact_title' ,'breadcrumb' ,'related_doctors' 
                        , 'disable_form' ,'response_video_url', 'response_video_title'
                        , 'related_reviews', 'department_doctors', 'wpc_video_url'
                        , 'wpc_video_desc', 'wpc_video_page', 'wpc_review_url', 'wpc_review_desc'
                        , 'wpc_all_reviews_text', 'wpc_all_reviews_url', 'wpc_video_content') as $name){
                $setting[$name] = get_post_meta($post->ID, $name, true);
            }
        
        $checked_doctors        = explode(",", $setting['related_doctors']);
//        $checked_reviews        = explode(",", $setting['related_reviews']);
        
        $doctors = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'doctors' AND post_status = 'publish'" );
//        $reviews = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'review' AND post_status = 'publish'" );
        
	?>
	<div class="assuta-doctors-div">
        <h4><label for="breadcrumb_area">Хлебные крошки</label></h4> 
        <input class="widefat" id="breadcrumb_area" type="text" name="tp_settings[breadcrumb]" value="<?php echo $setting['breadcrumb']; ?>" />     
        <h4><label for="tp_contact_title">Заголовок формы контактов</label></h4>
        <input type="text" class="widefat" id="tp_contact_title" name="tp_settings[tp_contact_title]" value="<?php echo $setting['tp_contact_title']  ?>" />
        <h4>Форма заявки</h4>
        <input id="disable_form" type="checkbox" name="tp_settings[disable_form]" value="1" <?php if($setting['disable_form']) echo 'checked="checked"';?>/> <label for="disable_form">отключить</label>
            <h4>Врач для этой страницы</h4>
		<div class="wp-tab-panel">
			<ul id="assuta-doctors-checklist" class="assuta-doctors-checklist form-no-clear">
				<?php 
                                
                                    if( count($doctors) > 0 ){
                                        foreach( $doctors  as $single_doctor ){
                                            $input = '
                                                <li id="assuta-doctor-'.$single_doctor->ID.'" class="assuta-doctor"><label class="selectit"><input value="'.$single_doctor->ID.'" type="checkbox" name="related_doctor[]"';
                                            if(in_array($single_doctor->ID, $checked_doctors) )
                                                    $input .= ' checked="checked"';
                                            
                                            $input .= '> '.$single_doctor->post_title.' [doctor id='.$single_doctor->ID.']</label></li>';
                                            echo $input;
                                            
                                        }
                                    }
                                ?>
			</ul>
                    
		</div>
            <h4><label for="department_doctors">Врачи отделения в сайдбаре</label></h4> 
                <input class="widefat" id="department_doctors" type="text" name="tp_settings[department_doctors]" value="<?php echo $setting['department_doctors']; ?>" /><br />
                <small class="description">Вставьте шорткоды врачей через запятую</small><br />
        
            <?php if( $post->post_type === 'departments' ): ?>
                <h3 style="padding-left: 0;">Видео-отзыв</h3>
                <h4><label for="wpc_video_url">URL видео (Yandex, Ruteube, Youtube)</label></h4> 
                <input class="widefat" id="wpc_video_url" type="text" name="tp_settings[wpc_video_url]" value="<?php echo $setting['wpc_video_url']; ?>" /><br />
                <small class="description">Например http://www.youtube.com/watch?v=hco4pJO9Yuw</small><br />
                <h4><label for="wpc_video_page">Страница, куда ведет клик по видео</label></h4> 
                <input class="widefat" id="wpc_video_page" type="text" name="tp_settings[wpc_video_page]" value="<?php echo $setting['wpc_video_page']; ?>" /><br />
                <h4><label for="wpc_video_desc">Текст под видео</label></h4>                
                <input class="widefat" id="wpc_video_desc" type="text" name="tp_settings[wpc_video_desc]" value="<?php echo $setting['wpc_video_desc']; ?>" /><br />
                <h4><label for="wpc_video_content">Содержание</label></h4> 
                <textarea class="attachmentlinks" id="wpc_video_content" name="tp_settings[wpc_video_content]" cols="40" rows="1"><?php echo $setting['wpc_video_content']; ?></textarea><br />
                <br />
                <h3 style="padding-left: 0;">Текстовый отзыв</h3>
                <h4><label for="wpc_review_desc">Содержание</label></h4> 
                <textarea class="attachmentlinks" id="wpc_review_desc" name="tp_settings[wpc_review_desc]" cols="40" rows="1"><?php echo $setting['wpc_review_desc']; ?></textarea><br />
                <h4><label for="wpc_review_url">URL для "Читать далее"</label></h4> 
                <input class="widefat" id="wpc_review_url" type="text" name="tp_settings[wpc_review_url]" value="<?php echo $setting['wpc_review_url']; ?>" /><br />
                <br />
                <h3 style="padding-left: 0;">Все отзывы</h3>
                <h4><label for="wpc_all_reviews_text">Текст ссылки</label></h4> 
                <input class="widefat" id="wpc_all_reviews_text" type="text" name="tp_settings[wpc_all_reviews_text]" value="<?php echo $setting['wpc_all_reviews_text']; ?>" /><br />
                <h4><label for="wpc_all_reviews_url">URL</label></h4> 
                <input class="widefat" id="wpc_all_reviews_url" type="text" name="tp_settings[wpc_all_reviews_url]" value="<?php echo $setting['wpc_all_reviews_url']; ?>" /><br />
            <?php endif; ?>
	</div>
                
        <input type="hidden" name="tp_metabox_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />       
	<?php
        
}

add_action( 'save_post', 'tp_save_metabox' );
function tp_save_metabox( $post_id ) {
   
  $related_doctors = array();  
  $related_reviews = array();
    
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;
  
  if ( !wp_verify_nonce( $_POST['tp_metabox_nonce'], __FILE__  ) )
      return false;
  
  if ( !current_user_can( 'edit_post', $post_id ) )
      return false;
  
  if( !empty($_POST['related_doctor']) && isset($_POST['related_doctor']) ){
        foreach( $_POST['related_doctor'] as $value )
            $related_doctors[] = $value;
  }
  if( !empty($_POST['related_review']) && isset($_POST['related_review']) ){
        foreach( $_POST['related_review'] as $review )
            $related_reviews[] = $review;
  }
  
  $related_doctors_str = implode(",", $related_doctors); 
  $related_reviews_str = implode(",", $related_reviews); 
 
  $tp_settings = array_map('esc_html', $_POST['tp_settings']);
  
  $tp_settings['related_doctors'] = $related_doctors_str;
  $tp_settings['related_reviews'] = $related_reviews_str;

  foreach( $tp_settings as $name => $value ){
          if( $value )
                  update_post_meta ($post_id, $name, $value);
          else
                  delete_post_meta ($post_id, $name);
          if( ! $tp_settings['disable_form'] )
                  delete_post_meta ($post_id, 'disable_form');
  }
  
  return $post_id;
  
}

function dc_posts_join($a)
{
    global $wpdb; 
    
    $query = "";
    
    $query .= " INNER JOIN $wpdb->term_relationships ON ($wpdb->term_relationships.object_id = $wpdb->posts.ID) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) INNER JOIN wp_terms ON ( wp_term_taxonomy.term_id = wp_terms.term_id ) ";
    
    return $a . $query;
}

function dc_posts_where($a)
{
    global $wpdb; 
    
    $return = $a . " AND $wpdb->term_taxonomy.taxonomy = 'specialization' ";
    
    return $return;
}

function dc_posts_orderby($a)
{
    global $wpdb; 

    return " $wpdb->terms.name ASC, ".$a;
}

function tb_the_order_form_mini( $post_id ){
        $disable_form     = get_post_meta($post_id, 'disable_form', true);
        if( $disable_form )
                return false;
        
        $tp_contact_title = get_post_meta( $post_id, 'tp_contact_title', true );
        if( $tp_contact_title )
            $contact_title = $tp_contact_title;
        else
            $contact_title = get_option( 'tp_contact_header' );
    ?>
    <div id="orderform">    
    <div class="title4"><?php echo $contact_title; ?></div>
        <?php echo do_shortcode('[crm-form-mini]'); ?>
    </div>
<?php
}

function tp_spoiler( $atts, $content = null )
{   
    $title = $atts['title'] ? $atts['title'] : 'Подробнее';
    
    $html  = '<div class="spoiler-container"><a href="javascript:void()" class="spoiler-title" title="'.$title.'">'.$title.'</a>';
    $html .= '<div class="spoiler-content">'.$content.'</div></div>';
    
    return $html;
}

add_shortcode('spoiler', 'tp_spoiler');

function tp_definition( $atts, $content = null )
{   
    if( ! $atts['title'] )
        return null;
    
    $wrap_tag = '<span>'; 
    $wrap_end = '</span>'; 
    $subtitle = '';
    
    if( $atts['subtitle'] ){
            $wrap_tag = '<p>';
            $wrap_end = '</p>';
            $subtitle = '('.$atts['subtitle'].')';
    }
    
    $title = $atts['title'];
    
    $html  = $wrap_tag.'<a href="javascript:void()" class="definition-title">'.$title.'...</a> '.$subtitle.$wrap_end;
    $html .= '<p class="definition-content"><span class="definition-title">'.$title.'</span>'.$content.'</p>';
    
    return $html;
}

add_shortcode('definition', 'tp_definition');

add_action( 'init', 'tp_add_excerpts_to_pages' );
function tp_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function show_var( $var ){
        var_dump( $var );
        return $var;
}
add_filter('comment_form_defaults', 'tp_disable_commentform_allowed_tags');
function tp_disable_commentform_allowed_tags( $args ){
        unset( $args['comment_notes_after'] );
        $args['title_reply']   = 'Добавить отзыв';
        $args['label_submit']  = 'Опубликовать';
        $args['comment_field'] = '<p class="comment-form-comment"><label for="comment">Отзыв</label> <textarea id="comment" name="comment" cols="45" rows="3" aria-required="true"></textarea></p>';
        return $args;
}

add_filter('comment_form_default_fields', 'tp_disable_commentform_url_field');
function tp_disable_commentform_url_field( $args ){
        unset($args['url']);
        return $args;
}

/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string 
 */
function tp_trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}

add_action('template_redirect', 'tp_pages_template_redirect');
function tp_pages_template_redirect()
{
        global $wp_query;
 
        if (is_author() || is_attachment() || is_date())
        {
                $wp_query->set_404();
        }
 
        if (is_feed())
        {      
            $wp_query->set_404();
            $wp_query->is_feed = false;
        }
}

//function tp_redirect_for_wpcf7(){
//    if( !WPCF7_PLUGIN_URL )
//        return false;
//    
//    wp_dequeue_script('contact-form-7');
//    
//    wp_enqueue_script( 'contact-form-7-custom',
//                    get_stylesheet_directory_uri() .'/js/wpcf7-redirect.js',
//		array( 'jquery', 'jquery-form' ), WPCF7_VERSION, true );
//    
//    $_wpcf7 = array(
//            'loaderUrl' => wpcf7_ajax_loader(),
//            'sending' => __( 'Sending ...', 'wpcf7' ) );
//
//    if ( defined( 'WP_CACHE' ) && WP_CACHE )
//            $_wpcf7['cached'] = 1;
//
//    wp_localize_script( 'contact-form-7-custom', '_wpcf7', $_wpcf7 );
//}
//add_action('wpcf7_enqueue_scripts', 'tp_redirect_for_wpcf7');

//add_action('wpcf7_mail_components', 'wpc_mail_additional_info');
//function wpc_mail_additional_info( $args ){
//        
//        $r = include( dirname(__FILE__)."/ip/SxGeo.php");
//        
//        $SxGeo = new SxGeo( dirname(__FILE__).'/ip/SxGeoCity.dat');
//        
//        $IP = $_SERVER['REMOTE_ADDR'];
//        $request_page = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
//        $referrer = $_SERVER['SERVER_NAME'];
//        $search_query = $_SESSION['WPC_KEYWORD']; 
//        
//        $args['body'] .= "----------------------<br /><strong>Детали отправителя:</strong><br />";
//        
//        if( $IP ){
//                $geoInfo = $SxGeo->getCityFull($IP);
//                
//                $geo_string = implode(", ", array($geoInfo['city']['name_ru'], $geoInfo['region']['name_ru'], $geoInfo['country']['name_ru']));
//                
//                $args['body'] .= "<br /> - ".$geo_string.". IP адрес ".$IP;
//                
//        }
//        if( $request_page )
//                $args['body'] .= "<br /> - Страница заявки ".$request_page;
//        
//        if( $search_query ){
//                $args['body'] .= "<br /> - Поисковый запрос - «".$search_query."» c ".$_SESSION['WPC_SEARCH_ENGINE'];
//                $_SESSION['WPC_KEYWORD'] = '';
//        }
//        elseif( $_SESSION['WPC_REFERER'] ){
//                $args['body'] .= "<br /> - Переход был с ".$_SESSION['WPC_REFERER'];
//                $_SESSION['WPC_REFERER'] = '';
//        }
//        return $args;
//}

function wpc_referers_stat()
{
  global $wpdb; session_start();

  $hosts['google.']['q'] = 'q';
  $hosts['google.']['ek'] = 'ie';
  $hosts['google.']['ev'] = 'windows-1251';
  $hosts['altavista.com']['q'] = 'q';
  $hosts['yahoo.com']['q'] = 'p';
  $hosts['bing.com']['q'] = 'q';
  $hosts['redtram.com']['q'] = 'q';
  $hosts['yandex.']['q'] = 'text';
  $hosts['rambler.ru']['q'] = 'query';
  $hosts['webalta.ru']['q'] = 'q';
  $hosts['aport.ru']['q'] = 'r';
  $hosts['go.mail.ru']['q'] = 'q';
  $hosts['nigma.ru']['q'] = 's';

  $referer = $_SERVER['HTTP_REFERER'];
  $ref_arr = parse_url($referer);
  $ref_host = $ref_arr['host'];

  foreach($hosts as $host => $host_opt)
  {
    if (strpos($ref_host, $host) !== false)
    {
      $find_host = true;
      break;
    }
  }  

function isUTF8($s){
  if (preg_match('/([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})/x',$s))
  return true; else return false; 
}    

function isWIN1251($s){
  if (!isUTF8($s))
  if (preg_match('/[�-�]+/i',$s))
  return true; else return false; 
}  

  $search = '';
  if ($find_host){
          
    parse_str($ref_arr['query'], $query_arr);
    $search = $query_arr[$host_opt['q']];
    
    $need_conv = false;
    if ($host == 'go.mail.ru') {
       $need_conv = true;
       if (isUTF8($search)) $need_conv = false;
    }

    if ($host == 'yandex.') {
       if (isWIN1251($search)) $need_conv = true;
    }
    
    if ($host == 'google.') {
       if (isset($query_arr['ie']))
         if ($query_arr['ie'] == 'windows-1251') $need_conv = true;
    }

    if ($need_conv) $search= @iconv("windows-1251", "utf-8", $search);  
    $search = trim($wpdb->escape($search));  
  }
   
  if (strlen($search) > 2){
          $_SESSION['WPC_KEYWORD'] = $search;
          $_SESSION['WPC_SEARCH_ENGINE'] = $ref_host;
  }
  
  if( strpos( $_SERVER['HTTP_REFERER'], get_bloginfo('home') ) === false && $_SERVER['HTTP_REFERER'] ){
          $_SESSION['WPC_REFERER'] = $_SERVER['HTTP_REFERER'];
  }
}
add_action('init', 'wpc_referers_stat');

function ilc_mce_buttons($buttons){
  array_push($buttons, "backcolor");
  return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");

// add more buttons to the html editor
function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
    QTags.addButton( 'span_bold', 'B*', '<span class="bold">', '</span>', 'e', 'Жирный *', 1 );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );

// add new buttons
add_filter('mce_buttons', 'wpc_register_buttons');

function wpc_register_buttons($buttons) {
   array_unshift($buttons, 'spanb');
        
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
add_filter('mce_external_plugins', 'wpc_register_tinymce_js');

function wpc_register_tinymce_js($plugin_array) {
   $plugin_array['spanb'] = get_bloginfo('template_url').'/js/tinymceplugin.js';

   return $plugin_array;
}

function wpc_mce_css($wp) {

        $wp .= ',' . get_bloginfo('template_url').'/js/tinymceplugin.css';

        return $wp;
}

add_filter( 'mce_css', 'wpc_mce_css' );

//function wpc_change_post_type(){
//        $parent_id = 30;
//        $ids = array();
//        
//        $child = new WP_Query( array(
//                'post_type' => 'departments',
//                'posts_per_page' => -1,
//                'post_parent' => $parent_id
//        ) );
//        
//        if( $child->have_posts() ): while ($child->have_posts()): $child->the_post();
//                global $post;
//                $ids[] = get_the_ID();
//        
//        endwhile;
//        endif;
//        
//        $child2 = new WP_Query( array(
//                'post_type' => 'departments',
//                'posts_per_page' => -1,
//                'post_parent__in' => $ids
//        ) );
//        
//        if( $child2->have_posts() ): while ($child2->have_posts()): $child2->the_post();
//                
//                $ids[] = get_the_ID();
//        
//        endwhile;
//        endif;
//       
//        foreach( $ids as $id ){
//                wp_update_post(
//                        array(
//                            'ID' => $id,
//                            'post_parent' => 0
//                        ));
//        }
//}
//if(!is_admin())
//wpc_change_post_type(); 
function wpc_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>
			<div id="respond" class="comment-respond">
				<div id="reply-title" class="title3 comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></div>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_logged_in The logged-in-as HTML-formatted message.
							 * @param array  $commenter      An array containing the comment author's
							 *                               username, email, and URL.
							 * @param string $user_identity  If the commenter is a registered user,
							 *                               the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's
							 *                              username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user,
							 *                              the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								/**
								 * Filter a comment form field for display.
								 *
								 * The dynamic portion of the filter hook, $name, refers to the name
								 * of the comment form field. Such as 'author', 'email', or 'url'.
								 *
								 * @since 3.0.0
								 *
								 * @param string $field The HTML-formatted output of the comment form field.
								 */
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args_comment_field The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.0
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}

require_once dirname(__FILE__)."/ip/SxGeo.php";

function crm_additional_data() {
	global $crm_data;
	if ($crm_data == null) {
		$SxGeo              = new SxGeo( dirname( __FILE__ ) . '/ip/SxGeoCity.dat' );
		$data               = new stdClass();
		$data->ip           = $_SERVER['REMOTE_ADDR'];
		$data->request_page = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $data->referer      = $_SESSION['WPC_REFERER'];
        $data->keyword      = $_SESSION['WPC_KEYWORD'];

		if ( $data->ip ) {
			$geoInfo = $SxGeo->getCityFull( $data->ip );

			$data->source = $geoInfo['country']['name_ru'] . ", " . $geoInfo['city']['name_ru'];
			$crm_data = $data;
			return $data;
		}
		return false;
	}
	return $crm_data;
}

add_shortcode('crm-form-asuta', 'wpc_crm_form_asuta');
function wpc_crm_form_asuta(){
	$data = crm_additional_data();
	$code = <<<EOT
<div class="crm"><form id="form-asuta" action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads1799164000000475001" enctype="multipart/form-data" method="POST" onsubmit="return checkMandatory('form-asuta')" accept-charset="UTF-8">

        <!-- Do not remove this code. -->
        <input type='text' style='display: none;' name='xnQsjsdp' value='54fdd0ea66e371c64b235c674490aa26286c38d704f82d770a203f73d29e7627' />
        <input type='hidden' name='zc_gad' id='zc_gad' value='' />
        <input type='text' style='display: none;' name='xmIwtLD' value='91dfb13da16cbb68635855f1fb6ddfffb32f5eb8e08a2abf0da01d445ff29c62' />
        <input type='text' style='display: none;' name='actionType' value='TGVhZHM=' />

        <input type='text' style='display: none;' name='returnURL' value='http://www.ichilov-international.com/blagodarim-za-zayavku/' />
        <input type='text' style='display: none;' name='Lead Source' value='Ichilov international main' />
        <input type='text' style='display: none;' name='LEADCF7' value='Medium' />
        <input type='text' style='display: none;' name='LEADCF9' value='Content' />
        <input type='text' style='display: none;' name='LEADCF8' value='Term' />
        <input type='text' style='display: none;' name='LEADCF10' value='Camp.' />
        <input type='text' style='display: none;' name='LEADCF12' value='Visits Num' />
        <input type='text' style='display: none;' name='LEADCF11' value='Segment' />
        <input type='checkbox' style='display:none;' name='LEADCF109' checked='true' />

        <input type='text' style='display:none;' name='LEADCF27' value="$data->ip" />
		<input type='text' style='display:none;' name='LEADCF17' value="$data->request_page" />
		<input type='text' style='display:none;' name='LEADCF6' value="$data->source" />
        <input type='text' style='display:none;' name='LEADCF30' value="$data->referer" />
        <!-- Do not remove this code. -->
        <style>
            tr, td {
                padding: 6px;
                border-spacing: 0px;
                border-width: 0px;
            }
        </style>
        <p class="field-your-name">
                <label>Имя</label>
                <input type='text' maxlength='40' name='First Name' />
        </p>

        <p class="field-your-last-name">
                <label>Фамилия</label>
                <input type='text' maxlength='80' name='Last Name' />
        </p>

        <p class="field-your-country">
                <label>Страна проживания</label> 

                <select name="Country">
                <option value="Выбрать">Выбрать</option><option value="Россия">Россия</option><option value="Украина">Украина</option><option value="Беларусь">Беларусь</option><option value="Казахстан">Казахстан</option><option value="----------------">----------------</option><option value="Австрия">Австрия</option><option value="Австралия">Австралия</option><option value="Азербайджан">Азербайджан</option><option value="Албания">Албания</option><option value="Алжир">Алжир</option><option value="Ангола">Ангола</option><option value="Ангуилья">Ангуилья</option><option value="Андорра">Андорра</option><option value="Антигуа и Барбуда">Антигуа и Барбуда</option><option value="Антильские о-ва">Антильские о-ва</option><option value="Аргентина">Аргентина</option><option value="Армения">Армения</option><option value="Афганистан">Афганистан</option><option value="Багамские о-ва">Багамские о-ва</option><option value="Бангладеш">Бангладеш</option><option value="Барбадос">Барбадос</option><option value="Бахрейн">Бахрейн</option><option value="Белиз">Белиз</option><option value="Бельгия">Бельгия</option><option value="Бенин">Бенин</option><option value="Бермуды">Бермуды</option><option value="Болгария">Болгария</option><option value="Боливия">Боливия</option><option value="Босния/Герцеговина">Босния/Герцеговина</option><option value="Ботсвана">Ботсвана</option><option value="Бразилия">Бразилия</option><option value="Британская Океания">Британская Океания</option><option value="Британские Виргинские о-ва">Британские Виргинские о-ва</option><option value="Бруней">Бруней</option><option value="Буркина Фасо">Буркина Фасо</option><option value="Бурунди">Бурунди</option><option value="Бутан">Бутан</option><option value="Валлис и Футуна о-ва">Валлис и Футуна о-ва</option><option value="Вануату">Вануату</option><option value="Великобритания">Великобритания</option><option value="Венгрия">Венгрия</option><option value="Венесуэла">Венесуэла</option><option value="Восточный Тимор">Восточный Тимор</option><option value="Вьетнам">Вьетнам</option><option value="Габон">Габон</option><option value="Гаити">Гаити</option><option value="Гайана">Гайана</option><option value="Гамбия">Гамбия</option><option value="Гана">Гана</option><option value="Гваделупа">Гваделупа</option><option value="Гватемала">Гватемала</option><option value="Гвинея">Гвинея</option><option value="Гвинея-Бисау">Гвинея-Бисау</option><option value="Германия">Германия</option><option value="Гибралтар">Гибралтар</option><option value="Гондурас">Гондурас</option><option value="Гонконг">Гонконг</option><option value="Греландия">Греландия</option><option value="Гренада">Гренада</option><option value="Греция">Греция</option><option value="Грузия">Грузия</option><option value="Дания">Дания</option><option value="Джибути">Джибути</option><option value="Доминика">Доминика</option><option value="Доминиканская республика">Доминиканская республика</option><option value="Египет">Египет</option><option value="Замбия">Замбия</option><option value="Западная Сахара">Западная Сахара</option><option value="Зимбабве">Зимбабве</option><option value="Израиль">Израиль</option><option value="Индия">Индия</option><option value="Индонезия">Индонезия</option><option value="Иордания">Иордания</option><option value="Ирак">Ирак</option><option value="Иран">Иран</option><option value="Ирландия">Ирландия</option><option value="Исландия">Исландия</option><option value="Испания">Испания</option><option value="Италия">Италия</option><option value="Йемен">Йемен</option><option value="Кабо-Верде">Кабо-Верде</option><option value="Кайманские о-ва">Кайманские о-ва</option><option value="Камбоджа">Камбоджа</option><option value="Камерун">Камерун</option><option value="Канада">Канада</option><option value="Катар">Катар</option><option value="Кения">Кения</option><option value="Кипр">Кипр</option><option value="Кирибати">Кирибати</option><option value="Китай">Китай</option><option value="Кокосовы (Килинг) о-ва">Кокосовы (Килинг) о-ва</option><option value="Колумбия">Колумбия</option><option value="Коморские о-ва">Коморские о-ва</option><option value="Конго (Brazzaville)">Конго (Brazzaville)</option><option value="Коста-Рика">Коста-Рика</option><option value="Кот-д'Ивуар">Кот-д'Ивуар</option><option value="Куба">Куба</option><option value="Кувейт">Кувейт</option><option value="Кука о-ва">Кука о-ва</option><option value="Кыргызстан">Кыргызстан</option><option value="Лаос">Лаос</option><option value="Лесото">Лесото</option><option value="Латвия">Латвия</option><option value="Либерия">Либерия</option><option value="Ливан">Ливан</option><option value="Ливия">Ливия</option><option value="Литва">Литва</option><option value="Лихтенштейн">Лихтенштейн</option><option value="Люксембург">Люксембург</option><option value="Маврикий">Маврикий</option><option value="Мавритания">Мавритания</option><option value="Мадагаскар">Мадагаскар</option><option value="Майотт">Майотт</option><option value="Макао">Макао</option><option value="Македония">Македония</option><option value="Малави">Малави</option><option value="Малайзия">Малайзия</option><option value="Мали">Мали</option><option value="Мальдивские о-ва">Мальдивские о-ва</option><option value="Мальта">Мальта</option><option value="Мартиника о-в">Мартиника о-в</option><option value="Мексика">Мексика</option><option value="Мозамбик">Мозамбик</option><option value="Молдова">Молдова</option><option value="Монако">Монако</option><option value="Монголия">Монголия</option><option value="Монтсерат">Монтсерат</option><option value="Марокко">Марокко</option><option value="Мьянма (Бирма)">Мьянма (Бирма)</option><option value="Намибия">Намибия</option><option value="Науру">Науру</option><option value="Непал">Непал</option><option value="Нигер">Нигер</option><option value="Нигерия">Нигерия</option><option value="Нидерланды (Голландия)">Нидерланды (Голландия)</option><option value="Никарагуа">Никарагуа</option><option value="Новая Зеландия">Новая Зеландия</option><option value="Новая Каледония о-в">Новая Каледония о-в</option><option value="Норвегия">Норвегия</option><option value="Норфолк о-в">Норфолк о-в</option><option value="Нюэ">Нюэ</option><option value="О.А.Э.">О.А.Э.</option><option value="Оман">Оман</option><option value="Пакистан">Пакистан</option><option value="Панама">Панама</option><option value="Папуа Новая Гвинея">Папуа Новая Гвинея</option><option value="Парагвай">Парагвай</option><option value="Перу">Перу</option><option value="Питкэрн о-в">Питкэрн о-в</option><option value="Польша">Польша</option><option value="Португалия">Португалия</option><option value="Рождественские о-ва">Рождественские о-ва</option><option value="Руанда">Руанда</option><option value="Румыния">Румыния</option><option value="США">США</option><option value="Сальвадор">Сальвадор</option><option value="Самоа">Самоа</option><option value="Сан-Марино">Сан-Марино</option><option value="Сан-Томе и Принсипи">Сан-Томе и Принсипи</option><option value="Саудовская Аравия">Саудовская Аравия</option><option value="Свазиленд">Свазиленд</option><option value="Свальбэрд">Свальбэрд</option><option value="Святая Люсия">Святая Люсия</option><option value="Святая земля">Святая земля</option><option value="Святой Елены о-в">Святой Елены о-в</option><option value="Северная Корея">Северная Корея</option><option value="Сейшеллы">Сейшеллы</option><option value="Сектор Газа">Сектор Газа</option><option value="Сен-Пьер и Микелон">Сен-Пьер и Микелон</option><option value="Сенегал">Сенегал</option><option value="Сент Китс и Невис">Сент Китс и Невис</option><option value="Сент-Винсент и Гренадины">Сент-Винсент и Гренадины</option><option value="Сербия и Черногория">Сербия и Черногория</option><option value="Сингапур">Сингапур</option><option value="Сирия">Сирия</option><option value="Словакия">Словакия</option><option value="Словения">Словения</option><option value="Соломоновы о-ва">Соломоновы о-ва</option><option value="Сомали">Сомали</option><option value="Судан">Судан</option><option value="Суринам">Суринам</option><option value="Сьерра-Леоне">Сьерра-Леоне</option><option value="Таджикистан">Таджикистан</option><option value="Тайвань">Тайвань</option><option value="Тайланд">Тайланд</option><option value="Танзания">Танзания</option><option value="Того">Того</option><option value="Токелау о-ва">Токелау о-ва</option><option value="Тонга">Тонга</option><option value="Тринидад и Тобаго">Тринидад и Тобаго</option><option value="Тувалу">Тувалу</option><option value="Туркменистан">Туркменистан</option><option value="Тунис">Тунис</option><option value="Туркс и Кейкос">Туркс и Кейкос</option><option value="Турция">Турция</option><option value="Уганда">Уганда</option><option value="Узбекистан">Узбекистан</option><option value="Уругвай">Уругвай</option><option value="Фалькийские о-ва">Фалькийские о-ва</option><option value="Фарерские о-ва">Фарерские о-ва</option><option value="Фиджи">Фиджи</option><option value="Филиппины">Филиппины</option><option value="Финляндия">Финляндия</option><option value="Франция">Франция</option><option value="Французская Гвинея">Французская Гвинея</option><option value="Французская Полинезия">Французская Полинезия</option><option value="Французские юж. и антаркт. о-ва">Французские юж. и антаркт. о-ва</option><option value="Херд и Мак Дональнд о-ва">Херд и Мак Дональнд о-ва</option><option value="Хорватия">Хорватия</option><option value="Центральная Африка">Центральная Африка</option><option value="Чад">Чад</option><option value="Чехия">Чехия</option><option value="Черногория">Черногория</option><option value="Чили">Чили</option><option value="Швейцария">Швейцария</option><option value="Швеция">Швеция</option><option value="Шри-Ланка">Шри-Ланка</option><option value="Эквадор">Эквадор</option><option value="Экваториальная Гвинея">Экваториальная Гвинея</option><option value="Эритрея">Эритрея</option><option value="Эстония">Эстония</option><option value="Эфиопия">Эфиопия</option><option value="ЮАР">ЮАР</option><option value="Южная Корея">Южная Корея</option><option value="Южные Сандвичевы о-ва">Южные Сандвичевы о-ва</option><option value="Ямайка">Ямайка</option><option value="Япония">Япония</option>
        </select>
        </p>

        <p class="field-your-phone">
                <label>Телефон (*)</label> 
                <input type='text' maxlength='30' name='Phone' />
        </p>

        <p>
                <label>Email</label>
                <input type='text' maxlength='100' name='Email' />
        </p>
        <p>
                <label>Краткое описание болезни</label> 
                <textarea name='Description' maxlength='1000' cols="40" rows="6" ></textarea>
        </p>

        <p class="field-your-files">
                <label>Прикрепить файл</label>
                        <input type='file' name='theFile' id='theFile' multiple />
        </p>
        <p class="field-submit">
                <input type="submit" value="Отправить заявку" class="red-button">
        </p>
    </form></div>
EOT;
	return $code;
}

add_shortcode('crm-form-mini', 'wpc_crm_form_mini');
function wpc_crm_form_mini() {
	$data = crm_additional_data();
	$code = <<<EOT
		<form id="form-mini" action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads1799164000000475001" method="POST" enctype="multipart/form-data" onsubmit="return checkMandatory('form-mini')" accept-charset="UTF-8">
			<!-- Do not remove this code. -->
			<input type='text' style='display: none;' name='xnQsjsdp' value='54fdd0ea66e371c64b235c674490aa26286c38d704f82d770a203f73d29e7627' />
			<input type='hidden' name='zc_gad' id='zc_gad' value='' />
			<input type='text' style='display: none;' name='xmIwtLD' value='91dfb13da16cbb68635855f1fb6ddfffb32f5eb8e08a2abf0da01d445ff29c62' />
			<input type='text' style='display: none;' name='actionType' value='TGVhZHM=' />

			<input type='text' style='display: none;' name='returnURL' value='http://www.ichilov-international.com/blagodarim-za-zayavku/' />
			<input type='text' style='display: none;' name='Lead Source' value='Ichilov international mini' />
            <input type='text' style='display: none;' name='LEADCF7' value='Medium' />
            <input type='text' style='display: none;' name='LEADCF9' value='Content' />
            <input type='text' style='display: none;' name='LEADCF8' value='Term' />
            <input type='text' style='display: none;' name='LEADCF10' value='Camp.' />
            <input type='text' style='display: none;' name='LEADCF12' value='Visits Num' />
            <input type='text' style='display: none;' name='LEADCF11' value='Segment' />                
			<input type='checkbox' style='display:none;' name='LEADCF109' checked='true' />

			<input type='text' style='display:none;' name='LEADCF27' value="$data->ip" />
			<input type='text' style='display:none;' name='LEADCF17' value="$data->request_page" />
			<input type='text' style='display:none;' name='LEADCF6' value="$data->source" />
            <input type='text' style='display:none;' name='LEADCF30' value="$data->referer" />
			<!-- Do not remove this code. -->
			<p>
				<span class="wpcf7-form-control-wrap your-name">
					<input type='text' size="40" maxlength='40' name='First Name' placeholder="Полное имя">
				</span>
			</p>
			<p class="right">
				<span class="wpcf7-form-control-wrap tel-956">
					<input type='text' size="40" maxlength='30' name='Phone' placeholder="Номер телефона (+7-495-1234567)">
				</span>
			</p>
			<p>
				<span class="wpcf7-form-control-wrap text-614">
					<input type="text" name="City" size="40" maxlength="40" placeholder="Город">
				</span>
			</p>
			<p class="right">
				<span class="wpcf7-form-control-wrap your-email">
					<input type='text' maxlength='100' size="40" name='Email' placeholder="E-mail">
				</span>
			</p>
			<p><br class="clear">
			</p><div class="message">
				<span class="wpcf7-form-control-wrap your-message">
					<textarea name='Description' maxlength='1000' cols="59" rows="5" placeholder="Краткое описание проблемы"></textarea>
				</span>
			</div>
			<div id="order-submit">
				<input type="submit" value="Отправить" class="wpcf7-form-control wpcf7-submit">
				<span>Формат: страна - город - номер. Например, +7-495-1234567</span>
			</div>
		</form>
EOT;
	return $code;
}

add_shortcode('crm-form-popup', 'wpc_crm_form_popup');
function wpc_crm_form_popup() {
	$data = crm_additional_data();
	$code = <<<EOT
	<div id="orderform">
		<h4>Для организации обследования и лечения заполните анкету</h4>
		<form id="form-popup" action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads1799164000000475001" method="POST" enctype="multipart/form-data" onsubmit="return checkMandatory('form-popup')" accept-charset="UTF-8">
			<!-- Do not remove this code. -->
			<input type='text' style='display: none;' name='xnQsjsdp' value='54fdd0ea66e371c64b235c674490aa26286c38d704f82d770a203f73d29e7627' />
			<input type='hidden' name='zc_gad' id='zc_gad' value='' />
			<input type='text' style='display: none;' name='xmIwtLD' value='91dfb13da16cbb68635855f1fb6ddfffb32f5eb8e08a2abf0da01d445ff29c62' />
			<input type='text' style='display: none;' name='actionType' value='TGVhZHM=' />

			<input type='text' style='display: none;' name='returnURL' value='http://www.ichilov-international.com/blagodarim-za-zayavku/' />
			<input type='text' style='display: none;' name='Lead Source' value='Ichilov international popup' />
            <input type='text' style='display: none;' name='LEADCF7' value='Medium' />
            <input type='text' style='display: none;' name='LEADCF9' value='Content' />
            <input type='text' style='display: none;' name='LEADCF8' value='Term' />
            <input type='text' style='display: none;' name='LEADCF10' value='Camp.' />
            <input type='text' style='display: none;' name='LEADCF12' value='Visits Num' />
            <input type='text' style='display: none;' name='LEADCF11' value='Segment' />                
			<input type='checkbox' style='display:none;' name='LEADCF109' checked='true' />

			<input type='text' style='display:none;' name='LEADCF27' value="$data->ip" />
			<input type='text' style='display:none;' name='LEADCF17' value="$data->request_page" />
			<input type='text' style='display:none;' name='LEADCF6' value="$data->source" />
            <input type='text' style='display:none;' name='LEADCF30' value="$data->referer" />
			<!-- Do not remove this code. -->
			<p>
				<span class="wpcf7-form-control-wrap your-name">
					<input type='text' size="40" maxlength='40' name='First Name' placeholder="Полное имя">
				</span>
			</p>
			<p class="right">
				<span class="wpcf7-form-control-wrap tel-956">
					<input type='text' size="40" maxlength='30' name='Phone' placeholder="Номер телефона (+7-495-1234567)">
				</span>
			</p>
			<p>
				<span class="wpcf7-form-control-wrap text-614">
					<input type="text" name="City" size="40" maxlength="40" placeholder="Город">
				</span>
			</p>
			<p class="right">
				<span class="wpcf7-form-control-wrap your-email">
					<input type='text' maxlength='100' size="40" name='Email' placeholder="E-mail">
				</span>
			</p>
			<p><br class="clear">
			</p><div class="message">
				<span class="wpcf7-form-control-wrap your-message">
					<textarea name='Description' maxlength='1000' cols="59" rows="5" placeholder="Краткое описание проблемы"></textarea>
				</span>
			</div>
			<div id="order-submit">
				<input type="submit" value="Отправить" class="wpcf7-form-control wpcf7-submit">
				<span>Формат: страна - город - номер. Например, +7-495-1234567</span>
			</div>
		</form>
	</div>
EOT;
	return $code;
}

add_shortcode('crm-form-callme', 'wpc_crm_form_callme');
function wpc_crm_form_callme() {
	$data = crm_additional_data();
	$code = <<<EOT
		<form id="form-callme" action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads1799164000000475001" method="POST" enctype="multipart/form-data" onsubmit="return checkMandatory('form-callme')" accept-charset="UTF-8">
			<!-- Do not remove this code. -->
			<input type='text' style='display: none;' name='xnQsjsdp' value='54fdd0ea66e371c64b235c674490aa26286c38d704f82d770a203f73d29e7627' />
			<input type='hidden' name='zc_gad' id='zc_gad' value='' />
			<input type='text' style='display: none;' name='xmIwtLD' value='91dfb13da16cbb68635855f1fb6ddfffb32f5eb8e08a2abf0da01d445ff29c62' />
			<input type='text' style='display: none;' name='actionType' value='TGVhZHM=' />

			<input type='text' style='display: none;' name='returnURL' value='http://www.ichilov-international.com/blagodarim-za-zayavku/' />
			<input type='text' style='display: none;' name='Lead Source' value='Ichilov international call me' />
            <input type='text' style='display: none;' name='LEADCF7' value='Medium' />
            <input type='text' style='display: none;' name='LEADCF9' value='Content' />
            <input type='text' style='display: none;' name='LEADCF8' value='Term' />
            <input type='text' style='display: none;' name='LEADCF10' value='Camp.' />
            <input type='text' style='display: none;' name='LEADCF12' value='Visits Num' />
            <input type='text' style='display: none;' name='LEADCF11' value='Segment' />                
			<input type='checkbox' style='display:none;' name='LEADCF109' checked='true' />

			<input type='text' style='display:none;' name='LEADCF27' value="$data->ip" />
			<input type='text' style='display:none;' name='LEADCF17' value="$data->request_page" />
			<input type='text' style='display:none;' name='LEADCF6' value="$data->source" />
            <input type='text' style='display:none;' name='LEADCF30' value="$data->referer" />
			<!-- Do not remove this code. -->
			
			<p class="call-me__label">Введите номер телефона</p>
			<p>
				<span class="wpcf7-form-control-wrap tel-305">
					<input type="tel" name="Phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" id="call-me" aria-required="true" aria-invalid="false">
				</span>
			</p>
			<p class="call-me__submit">
			<input type="submit" value="Перезвоните мне" class="wpcf7-form-control wpcf7-submit">
			</p>
			
		</form>
EOT;
	return $code;
}
?>