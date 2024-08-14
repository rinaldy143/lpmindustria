<?php
/**
 * Template part for displaying single posts.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php do_action( 'colornews_before_post_content' ); ?>

   <?php
      $image_popup_id = get_post_thumbnail_id();
      $image_popup_url = wp_get_attachment_url( $image_popup_id );
   ?>

   <?php
   if ( has_post_thumbnail() ) {
      $featured_image_class = 'featured-image-enable';
   } else {
      $featured_image_class = '';
   }
   ?>

   <div class="figure-cat-wrap <?php echo $featured_image_class; ?>">
      <?php if ( has_post_thumbnail() ) { ?>
         <div class="featured-image">
         <?php if (get_theme_mod('colornews_featured_image_popup', 0) == 1) { ?>
            <a href="<?php echo $image_popup_url; ?>" class="image-popup"><?php the_post_thumbnail( 'colornews-featured-image' ); ?></a>
         <?php } else { ?>
            <?php the_post_thumbnail( 'colornews-featured-image' ); ?>
         <?php } ?>
         </div>
      <?php } ?>

      <?php colornews_colored_category_return(1); ?>
   </div>

   <?php if( get_post_format() ) { get_template_part( '/inc/post-formats' ); } ?>

	<?php colornews_published_date(); ?>

   <header class="entry-header">
      <h1 class="entry-title">
         <?php the_title(); ?>
      </h1>
   </header>

   <?php colornews_entry_meta(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colornews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

   <?php do_action( 'colornews_after_post_content' ); ?>
</article><!-- #post-## -->