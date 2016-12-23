<?php
/**
 * Template part for displaying search results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

$image = new Pad_Image();
$formatted_image = $image->get_image( get_the_ID());
if ( $formatted_image === '') {
	// No image, text is full width always
	$column_class = "";
}
else {
	$column_class = "col-sm-6";
}

?>

<article class="container hoverable pad-archive" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="row entry-header">
		<div class="col-xs-12">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php pad_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="row entry-content">
		<?php
			if ( $formatted_image != '') {
                ?>
                <div class="col-xs-12 col-sm-6">
                <?php
				    echo $formatted_image;
                ?>
                </div>
                <?php
            }
		?>
		<div class="col-xs-12 <?php echo $column_class ;?> pad-archive-excerpt-container">
			<?php
			the_excerpt( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pad' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			), true);

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pad' ),
				'after'  => '</div>',
			) );
			?>
			<footer class="row entry-footer">
				<div class="col-xs-12">
					<?php pad_entry_footer(); ?>
				</div>
			</footer><!-- .entry-footer -->

		</div>

	</div><!-- .entry-content -->


</article><!-- #post-## -->
