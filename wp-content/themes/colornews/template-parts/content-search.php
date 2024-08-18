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
   <?php do_action( 'colornews_before_post_content' ); ?>

   <div class="post-content-wrapper">
      <div class="figure-cat-wrap <?php echo $featured_image_class; ?>">
         <?php if ( has_post_thumbnail() ) { ?>
            <div class="featured-image">
               <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_post_thumbnail( 'medium-small' ); ?> <!-- Mengubah ukuran thumbnail -->
               </a>
            </div>
         <?php } ?>
      </div>

      <div class="post-text-content">
         <?php if( get_post_format() ) { get_template_part( '/inc/post-formats' ); } ?>

         <?php colornews_published_date(); ?>

         <header class="entry-header">
            <h2 class="entry-title">
               <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
            </h2>
         </header>

         <div class="entry-content">
            <?php the_excerpt(); ?>

            <?php
            wp_link_pages( array(
               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colornews' ),
               'after'  => '</div>',
            ) );
            ?>
         </div><!-- .entry-content -->

         <div class="entry-anchor-link">
            <a class="more-link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><span><?php _e( 'Read more', 'colornews' ); ?></span></a>
         </div>
      </div>
   </div>

   <?php do_action( 'colornews_after_post_content' ); ?>
</article><!-- #post-## -->
