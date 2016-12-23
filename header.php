<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PAD
 */

?><!DOCTYPE html>
<html <?php if ( is_front_page()) { echo 'class="preloader-target"'; } ?><?php language_attributes();  ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
wp_head();
$pad_theme_options = get_option( PAD_THEME_OPTIONS_NAME );
?>
</head>
<?php
/* Header variables and resources */
$logo_markup = '<a href="' . esc_url(home_url("/")) . '" class="navbar-brand">'. __('NO LOGO', 'pad') . '</a>';

if ( function_exists( 'has_custom_logo') && has_custom_logo()) {
    if ( function_exists( 'get_custom_logo') ) {
        $logo_markup = get_custom_logo();
        $logo_markup = str_replace('custom-logo-link', 'custom-logo-link navbar-brand normal-logo', $logo_markup);
    }
}

$light_logo_markup = '';
$light_logo_id = get_theme_mod('light_logo');
if ( $light_logo_id ) {
    $light_logo_markup = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
        esc_url( home_url( '/' ) ),
        wp_get_attachment_image( $light_logo_id, 'full', false, array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo',
        ) )
    );
    $light_logo_markup = str_replace('custom-logo-link', 'custom-logo-link navbar-brand inverted-logo', $light_logo_markup);

}

$mobile_logo_markup = '';
$custom_logo_id = get_theme_mod( 'custom_logo' );
if ( $custom_logo_id ) {
    $mobile_logo_markup = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
        esc_url( home_url( '/' ) ),
        wp_get_attachment_image( $custom_logo_id, 'small', false, array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo',
        ) )
    );
    $mobile_logo_markup = str_replace('custom-logo-link', 'custom-logo-link navbar-brand mobile-logo', $mobile_logo_markup);

}

$pad_page_body_class = get_post_meta( get_the_ID(), 'body_class');
?>

<body <?php body_class( $pad_page_body_class ); ?>>
<div id="preloader"></div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pad' ); ?></a>

    <div id="pad-logo-container-mobile">
        <?php echo $mobile_logo_markup ; ?>
    </div>

    <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-custom navbar-fixed-top affix" role="navigation">
        <div class="container-fluid">
            <div class="row">


                <!-- col 1-->
                <div class="col-md-2">


                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu-container">
                            <span class="sr-only">Toggle navigation</span>
                        </button>
                    </div>

                    <div id="pad-logo-container" class="navbar-header">

                        <?php echo $logo_markup ; echo $light_logo_markup ?>

                    </div>
                </div> <!-- col 1 -->
                <div class="col-md-10">
                    <?php
                    $menu_markup = wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'primary-menu-container',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'echo' => false
                        )
                    );


                    $cart_html = pad_shopping_cart_html();
                    
                    /* 
                    if ( !empty( $cart_html )) {
                        $cart_html = '<li class="menu-item utility-trigger">' . $cart_html . '</li>';

                    }
                    */

                    $account_menu_html = pad_account_menu_html();

                    $menu_with_search = str_replace(
                        '</ul></div>',
                        '<li id="modal-search" class="menu-item modal-trigger utility-set">
                            <a title="' . __('Search', PAD_THEME_TEXTDOMAIN) . '" href="#" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></a>'
                        . $cart_html . $account_menu_html . '
                        </li></ul></div>',
                        $menu_markup
                    );
                    echo $menu_with_search;
                    ?>
                </div> <!-- col 2 -->
            </div> <!-- row 1 -->

            <div id="masthead-row" class="row">
                <div class="col-sm-12">
                    <header id="masthead" class="site-header" role="banner">
                        <div class="site-branding">
                            <?php

                            ?>
                            <?php
                            if ( is_front_page() && is_home() ) : ?>

                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php
                            endif;

                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                <?php
                            endif; ?>
                        </div><!-- .site-branding -->

                    </header><!-- #masthead -->
                </div>
            </div>
        </div> <!-- container -->
    </nav><!-- #site-navigation -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="searchModalLabel"><?php _e('Site Search', PAD_THEME_TEXTDOMAIN) ?></h4>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <?php get_search_form(); ?>
                </div>
                <!--Footer-->
                <!--
                <div class="modal-footer">
                    <<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                -->
            </div>
            <!--/.Content-->
        </div>
    </div>


	<div id="content" class="site-content">
