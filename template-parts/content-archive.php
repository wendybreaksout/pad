<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

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
		// TODO: make thumbnail size configurable
		// the_post_thumbnail((array(200,200))) ;
		$image = new Pad_Image();
		$formatted_image = $image->get_image( get_the_ID());

		if ( !empty ( $formatted_image ) ) {
		?>
			<div class="col-xs-12 col-sm-6">
				<?php
				echo $formatted_image;
				?>
			</div>

		<?php
			$col2_class = "col-sm-6" ;
		}
		else {
			$col2_class = "" ;
		}
		?>
		<div class="col-xs-12 <?php echo $col2_class ; ?> pad-archive-excerpt-container">
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
