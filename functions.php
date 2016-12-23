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


if (!defined('PAD_DESKTOP_EXCERPT_WORDS'))
    define('PAD_DESKTOP_EXCERPT_WORDS', 80);

if (!defined('PAD_TABLET_EXCERPT_WORDS'))
    define('PAD_TABLET_EXCERPT_WORDS', 60);

if (!defined('PAD_MOBILE_EXCERPT_WORDS'))
    define('PAD_MOBILE_EXCERPT_WORDS', 50);

if (!defined('PAD_THEME_HOME_PAGE_EQ_CLASS'))
	define('PAD_THEME_HOME_PAGE_EQ_CLASS', 'hero-layout');


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

/*
 * Start
*/

function load_vendor_styles() {



	wp_enqueue_style( 'pad-bootstrap',
		get_template_directory_uri() . '/css/bootstrap.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'pad-bootstrap-theme',
		get_template_directory_uri() . '/css/bootstrap-theme.min.css',
		array('divi-child-bootstrap'),
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'pad-fa',
		get_template_directory_uri() . '/css/font-awesome.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'pad-animate',
		get_template_directory_uri() . '/css/animate.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	wp_enqueue_style( 'pad-mdb',
		get_template_directory_uri() . '/css/mdb.min.css',
		wp_get_theme()->get('Version'),
		false
	);

	// wp_enqueue_style( 'pad-style', get_stylesheet_uri() );

}

function load_vendor_scripts() {

	wp_enqueue_script( 'pad-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pad-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'pad-bootstrap-js',
		get_template_directory_uri() . '/js/bootstrap.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);



	wp_enqueue_script( 'pad-tether',
		get_template_directory_uri() . '/js/tether.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);



	wp_enqueue_script( 'pad-enlax',
		get_template_directory_uri() . '/js/jquery.enllax.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'pad-scrollability',
		get_template_directory_uri() . '/js/jScrollability.min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);



	wp_enqueue_script( 'pad-max-height',
		get_template_directory_uri() . '/js/jquery.matchHeight-min.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'pad-custom-jsr',
		get_template_directory_uri() . '/js/custom.js',
		array('jquery'),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script( 'pad-mdb',
		get_template_directory_uri() . '/js/mdb.min.js',
		array('jquery', 'pad-bootstrap-js'),
		wp_get_theme()->get('Version'),
		true
	);


}

add_action( 'wp_enqueue_scripts', 'load_vendor_scripts' );
add_action( 'wp_enqueue_scripts', 'load_vendor_styles' );
add_action( 'wp_enqueue_scripts', 'pad_scripts' );





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

/*
 * Shortcodes
*/
// TODO: change underscrores to dashes in the following two file paths:
require get_template_directory() . '/inc/class_pad_shortcodes.php';

$pad_shortcodes = new PAD_Shortcodes();
$pad_shortcodes->register();

/*
 * PageBuilder Layout
 */
require get_template_directory() . '/inc/class_pad_pagebuilder_layouts.php';


$pad_layouts = new PAD_PageBuilder_Layouts();
$pad_layouts = $pad_layouts->register();


/*
 * Image formatting 
 */
require get_template_directory() . '/inc/class-pad-image.php';

/*
 * Metaboxes
 */
require get_template_directory() . '/inc/class-pad-meta-box.php';
require get_template_directory() . '/inc/class-pad-page-meta-box.php';

switch ( get_current_post_type() ) {
    case 'page':
    case 'edit-page':
        $page_meta_box = new PAD_Page_Meta_Box();
        add_action( 'add_meta_boxes', array($page_meta_box, 'meta_box_init' ));
        add_action( 'admin_menu', array( $page_meta_box, 'remove_meta_boxes' ));
        add_action( 'save_post', array( $page_meta_box, 'post_meta_save' ));
        break;


    default:
        break;
}

function get_current_post_type() {
    if ( isset( $_REQUEST['post_type'] )  ) {
        return $_REQUEST['post_type'];
    }
    elseif (isset( $_REQUEST['screen_id'] ) ) {
        return $_REQUEST['screen_id'];
    }
    elseif (isset( $_POST['screen_id'] ) ) {
        return $_POST['screen_id'];
    }
    else {
        if ( isset( $_REQUEST['post'])) {
            $post_type = get_post_type( $_REQUEST['post'] );
            return $post_type;
        }
    }
}

// Archive pages formatting
// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
	global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">' . __('...Read more', PAD_THEME_TEXTDOMAIN) . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*
 * Declare Woocomerce theme support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


function pad_shopping_cart_html() {

    $output = '';
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
       $count = WC()->cart->cart_contents_count;
       $output .= '
            <a class="cart-contents" href="' . WC()->cart->get_cart_url() . '" title="' .  __( 'View your shopping cart', PAD_THEME_TEXTDOMAIN ) . '">';
        if ( $count > 0 ) {
            $output .= '<span class="cart-contents-count">' . esc_html( $count ) . '</span>';
        }
        $output .= '</a>';
    }
    return $output;
}

function pad_account_menu_html() {

    if ( is_user_logged_in() ) {
        $title = __('Log out');
        $href = '/my-account/customer-logout/';
    }
    else {
        $title =  __('Customer Login', PAD_THEME_TEXTDOMAIN);
        $href = '/my-account/';
    }
    $output = '<a title="' . $title . '" href="' . $href . '"><i class="fa fa-user"></i></a>';
    return $output;
}


/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function pad_header_add_to_cart_fragment( $fragments ) {
    $fragments['a.cart-contents'] = pad_shopping_cart_html();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pad_header_add_to_cart_fragment' );

/*
 * Add taxonomy to media
 */
// add categories for attachments
function add_categories_for_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'add_categories_for_attachments' );

// add tags for attachments
function add_tags_for_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'add_tags_for_attachments' );


/*
 * WooCommerce support
*/
function woo_product_terms_tab( $tabs ) {

    if ( is_product() ) {

        global $post;

        $terms = get_the_terms( $post->ID, 'product_cat');

        foreach ( $terms as $term ) {
            if ( $term->slug == 'house-plans') {
                $tabs['terms_tab'] = array(
                    'title' 	=> __( 'Requirements & Terms', 'woocommerce' ),
                    'priority' 	=> 10,
                    'callback' 	=> 'woo_product_terms_content'
                );
            }
        }

    }


	return $tabs;

}

function woo_product_terms_content() {

    $args = array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'post_count'     => 1,
        'posts_per_page' => 1,
        'name'             => 'plan-requirements'
    );

    $page_query = new WP_Query( $args );

    if ( $page_query->have_posts() ) {

        while ($page_query->have_posts()) : $page_query->the_post();
            the_content();
        endwhile;
    }

    wp_reset_postdata();


}

add_filter( 'woocommerce_product_tabs', 'woo_product_terms_tab' );

/*
 * Change upsell test.
 */

add_filter('gettext', 'translate_upsell');
add_filter('ngettext', 'translate_upsell');

function translate_upsell($translated) {
	$translated = str_ireplace('You may also like&hellip;', 'Recommended products', $translated);
	return $translated;
}


/*
 *
 * Change empty shopping cart return to URL.
 */

function pad_empty_cart_redirect_url() {
    return $_SERVER['HTTP_REFERER'];
	// return '/books-plans/';
}

add_filter( 'woocommerce_return_to_shop_redirect', 'pad_empty_cart_redirect_url' );

// Remove Sidebar on all the Single Product Pages
add_action( 'wp', 'pad_remove_sidebar_product_pages' );

function pad_remove_sidebar_product_pages() {
	if (is_product()) {
		remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
	}
}













