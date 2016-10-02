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
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pad' ); ?></a>

    <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-custom navbar-fixed-top affix" role="navigation">
        <div class="container">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pad' ); ?></button>
            <div id="pad-logo-container" class="navbar-header">
                <?php
                $logo_markup = '<a href="' . esc_url(home_url("/")) . '" class="navbar-brand">'. __('NO LOGO', 'pad') . '</a>';

                if ( function_exists( 'has_custom_logo') && has_custom_logo()) {
                    if ( function_exists( 'get_custom_logo') ) {
                    $logo_markup = get_custom_logo();
                    $logo_markup = str_replace('custom-logo-link', 'custom-logo-link navbar-brand', $logo_markup);
                    }
                }

                ?>
                <?php echo $logo_markup ?>
                <header id="masthead" class="site-header" role="banner">
                    <div class="site-branding">
                        <?php

                        ?>
                        <?php
                        if ( is_front_page() && is_home() ) : ?>

                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
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
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'nav navbar-nav navbar-right',

                )
            );
            ?>
        </div>
    </nav><!-- #site-navigation -->



	<div id="content" class="site-content">
