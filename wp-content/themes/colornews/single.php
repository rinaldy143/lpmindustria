<?php
/**
 * The template for displaying all single posts.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */
get_header(); ?>

   <?php do_action( 'colornews_before_body_content' ); ?>

	<div id="main" class="clearfix">
      <div class="tg-container">
         <div class="tg-inner-wrap clearfix">
            <div id="main-content-section clearfix">
               <div id="primary">

            		<?php while ( have_posts() ) : the_post(); ?>

            			<?php get_template_part( 'template-parts/content', 'single' ); ?>

            			<?php colornews_post_navigation(); ?>

                     <?php if ( get_the_author_meta( 'description' ) ) : ?>
                        <div class="author-box">
                           <div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
                              <h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>
                              <p class="author-description"><?php the_author_meta( 'description' ); ?></p>
                        </div>
                     <?php endif; ?>

                     <?php if ( get_theme_mod( 'colornews_related_posts_activate', 0 ) == 1 )
                        get_template_part( '/inc/related-posts' );
                     ?>

            			<?php
            				// If comments are open or we have at least one comment, load up the comment template.
            				if ( comments_open() || get_comments_number() ) :
            					comments_template();
            				endif;
            			?>

            		<?php endwhile; // End of the loop. ?>

               </div><!-- #primary end -->
               <?php colornews_sidebar_select(); ?>
            </div><!-- #main-content-section end -->
         </div><!-- .tg-inner-wrap -->
      </div><!-- .tg-container -->
   </div><!-- #main -->

   <?php do_action( 'colornews_after_body_content' ); ?>

<?php get_footer(); ?>
