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
		<div class="container-fluid">
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
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'pad' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'pad' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'pad' ), 'pad', '<a href="http://wkempferjr@tnotw.com" rel="designer">Wes Kempfer</a>' ); ?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
