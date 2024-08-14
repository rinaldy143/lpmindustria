<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'colornews-featured-image' ); ?></a>
         </div>
      <?php } ?>

      <?php colornews_colored_category_return(1); ?>
   </div>

   <?php if( get_post_format() ) { get_template_part( '/inc/post-formats' ); } ?>

	<?php if ( 'post' == get_post_type() ) {
     colornews_published_date();
   } ?>

   <header class="entry-header">
      <h2 class="entry-title">
         <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
      </h2>
   </header>

   <?php colornews_entry_meta(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

   <div class="entry-anchor-link">
      <a class="more-link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><span><?php _e( 'Read more', 'colornews' ); ?></span></a>
   </div>

</article><!-- #post-## -->