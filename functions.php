<?php
/**
 * PAD functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PAD
 */

if (!defined('PAD_THEME_VERSION'))
	define('PAD_THEME_VERSION', '0.0.1');

if (!defined('PAD_THEME_OPTIONS_NAME'))
	define('PAD_THEME_OPTIONS_NAME', 'pad_theme_settings');


if (!defined('PAD_THEME_TEXTDOMAIN'))
    define('PAD_THEME_TEXTDOMAIN', 'pad');


if ( ! function_exists( 'pad_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pad_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PAD, use a find and replace
	 * to change 'pad' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( PAD_THEME_TEXTDOMAIN, get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'pad' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pad_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'pad_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pad_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pad_content_width', 640 );
}
add_action( 'after_setup_theme', 'pad_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pad_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pad' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pad' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar(array(
        'name' => 'Footer Widget 1',
        'id' => 'footer_first_widget_area',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Footer Widget 2',
        'id' => 'footer_second_widget_area',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Footer Widget 3',
        'id' => 'footer_third_widget_area',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name' => 'Footer Widget 4',
        'id' => 'footer_fourth_widget_area',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));


}
add_action( 'widgets_init', 'pad_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pad_scripts() {
	wp_enqueue_style( 'pad-style', get_stylesheet_uri() );

	wp_enqueue_script( 'pad-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pad-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pad_scripts' );

/*
 * Start
*/

function load_vendor_styles() {

	wp_enqueue_style( 'pad-style', get_stylesheet_uri() );


	wp_enqueue_style( 'divi-child-bootstrap',
		get_template_directory_uri() . '/css/bootstrap.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'divi-child-bootstrap-theme',
		get_template_directory_uri() . '/css/bootstrap-theme.min.css',
		array('divi-child-bootstrap'),
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'divi-child-fa',
		get_template_directory_uri() . '/css/font-awesome.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'divi-child-animate',
		get_template_directory_uri() . '/css/animate.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'divi-child-mdb',
		get_template_directory_uri() . '/css/mdb.min.css',
		wp_get_theme()->get('Version'),
		false
	);

}

function load_vendor_scripts() {

	wp_enqueue_script( 'pad-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pad-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'divi-child-bootstrap-js',
		get_template_directory_uri() . '/js/bootstrap.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'divi-child-mdb',
		get_template_directory_uri() . '/js/mdb.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'divi-child-tether',
		get_template_directory_uri() . '/js/tether.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'divi-child-custom-jsr',
		get_template_directory_uri() . '/js/custom.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'divi-child-enlax',
		get_template_directory_uri() . '/js/jquery.enllax.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'divi-child-scollability',
		get_template_directory_uri() . '/js/jScrollability.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);


}

add_action( 'wp_enqueue_scripts', 'load_vendor_scripts' );
add_action( 'wp_enqueue_scripts', 'load_vendor_styles' );




/*
 *  End
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
 * Theme settings
 */
require get_template_directory() . '/inc/class_pad_theme_settings.php';

$pad_theme_settings = new PAD_Theme_Settings();
add_action('admin_menu', array( $pad_theme_settings, 'add_pad_theme_options_page'));
add_action('admin_init', array( $pad_theme_settings, 'settings_init'));



