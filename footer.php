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


// Determine which which footer widgets have content.
$sidebar_ids = array(   'footer_first_widget_area',
                        'footer_second_widget_area',
                        'footer_third_widget_area',
                        'footer_fourth_widget_area') ;

$sidebars_with_content = array();
foreach ( $sidebar_ids as $sidebar_id ) {
  if ( dynamic_sidebar( $sidebar_id )) {
      $sidebars_with_content[] = $sidebar_id;
  }
}

$sidebar_count = count( $sidebars_with_content) ;

switch ( $sidebar_count ) {
    case 1:
        $col_class = 'col-sm-12';
        break;
    case 2:
        $col_class = 'col-sm-6';
        break;
    case 3:
        $col_class = 'col-sm-4';
        break;
    case 4:
        $col_class = 'col-sm-3';
        break;
    default:

        error_log(__('PAD Theme, unexepected number of sidebars in footer.', PAD_THEME_TEXTDOMAIN));
        break;
}

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">

                <?php
                    foreach ( $sidebars_with_content as $sidebar_id ) {
                        ?>
                        <div class="<?php echo $col_class ; ?>">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </div>
                        <?php
                    }
                ?>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="site-info">
						<?php printf	( __( 'Copyright &copy %s %s', 'pad' ), date('Y'), '<a href="' . get_site_url() . '" rel="designer">' . get_bloginfo('name') . '</a>' ); ?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
