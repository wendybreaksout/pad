<?php
/**
 * Template Name: Full Width
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

get_header();



if ( is_front_page() || ( get_post_meta( get_the_ID(), 'body_class') == PAD_THEME_HOME_PAGE_EQ_CLASS ) ) {
    $container_class = 'container-fluid';
}
else {
    $container_class = 'container';
}

?>

	<div class="<?php echo $container_class ;?>">
		<div class="row">
			<div class="col-xs-12">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							// Comments must also be enabled for the post.
							if ( ( comments_open() || get_comments_number() ) && get_post_meta( get_the_ID(), 'Allow Comments', true) ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div> <!-- col -->
		</div> <!-- row -->
	</div> <!-- container -->
<?php

get_footer();

