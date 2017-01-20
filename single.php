<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PAD
 */

$options = get_option( PAD_THEME_OPTIONS_NAME );
if ( isset( $options['display_single_post_sidebar'] ) && $options['display_single_post_sidebar'] == true ) {
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
        <div id="primary" class="content-area <?php echo $primary_col_class ;?>">
            <main id="main" class="site-main" role="main">
    
            <?php
            while ( have_posts() ) : the_post();
    
                get_template_part( 'template-parts/content', get_post_format() );
    
                the_post_navigation();
    
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
    
            endwhile; // End of the loop.
            ?>
    
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
    </div><!-- row -->
</div> <!-- container -->
<?php
get_footer();
