<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

$options = get_option( PAD_THEME_OPTIONS_NAME );
if ( isset( $options['display_blog_sidebar'] ) && $options['display_blog_sidebar'] == true ) {
	$display_sidebar = true;
	$primary_col_class = "col-md-8";
	$secondary_col_class = "col-md-4";
}
else {
	$display_sidebar = false;
	$primary_col_class = "col-md-12";
}


get_header(); ?>
<div class="container">
    <div class="row">
        <div id="primary" class="content-area container <?php echo $primary_col_class ;?>">
            <main id="main" class="site-main" role="main">

            <?php
            if ( have_posts() ) :

                if ( is_home() && ! is_front_page() ) : ?>
                    <header>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    </header>

                <?php
                endif;

                /* Start the Loop */
                while ( have_posts() ) : the_post();


                    // get_template_part( 'template-parts/content', get_post_format() );

                    if ( is_single() ) {
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                        get_template_part( 'template-parts/content', get_post_format() );
                    }
                    else {
                        get_template_part( 'template-parts/content', 'archive' );
                    }

                endwhile;

                the_posts_navigation();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        if ( $display_sidebar ) {
            ?>
            <div class="<?php echo $secondary_col_class ; ?>">
                <?php
                get_sidebar();
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
get_footer();
