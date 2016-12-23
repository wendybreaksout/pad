<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="row entry-header">
		<div class="col-xs-12"s>
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

	<div class="entry-content row">
		<div class="col-xs-12">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pad' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				));

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pad' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer row">
		<div class="col-xs-12">
			<?php pad_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
