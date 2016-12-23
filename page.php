<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						// Comments must also be enabled. 
						if ( ( comments_open() || get_comments_number() ) && get_post_meta( get_the_ID(), 'Allow Comments', true)) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div> <!-- col -->

		<div class="col-md-4">
			<?php
			get_sidebar();
			?>
		</div>
	</div> <!-- row -->
</div> <!-- container -->
<?php

get_footer();
