<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PAD
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php dynamic_sidebar('footer_first_widget_area'); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('footer_second_widget_area'); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('footer_third_widget_area'); ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('footer_fourth_widget_area'); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<div class="site-info">
						<?php printf( esc_html__( 'Copyright &copy;  %1$s %2$s', 'pad' ), date('Y'), '<a href="' . get_site_url() . '" rel="designer">' . bloginfo('name') . '</a>' ); ?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
