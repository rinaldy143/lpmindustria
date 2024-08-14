<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'colornews_before_post_content' ); ?>

	<header class="entry-header">
		<?php if ( is_front_page() ) :
         the_title( '<h2 class="entry-title">', '</h2>' );
      else :
         the_title( '<h1 class="entry-title">', '</h1>' );
      endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colornews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'colornews' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

   <?php do_action( 'colornews_after_post_content' ); ?>
</article><!-- #post-## -->