<?php
/**
 * Template to show the front page.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */
get_header(); ?>

<div id="main" class="clearfix">
   <div class="tg-container">
      <div class="tg-inner-wrap clearfix">
         <div class="home-slider-wrapper">
            <?php
            if( is_active_sidebar( 'colornews_front_slider_area' ) ) {
               if ( !dynamic_sidebar( 'colornews_front_slider_area' ) ):
               endif;
            }
            ?>
         </div><!-- .home-slider-wrapper -->
         <div id="main-content-section clearfix">
            <div id="primary">
               <?php
               if( is_active_sidebar( 'colornews_front_content_top_section' ) ) {
                  if ( !dynamic_sidebar( 'colornews_front_content_top_section' ) ):
                  endif;
               }
               ?>
               <div class="middle-section-wrapper clearfix">
                  <div class="tg-column-wrapper">
                     <div class="tg-column-2">
                        <?php
                        if( is_active_sidebar( 'colornews_front_content_left_section' ) ) {
                           if ( !dynamic_sidebar( 'colornews_front_content_left_section' ) ):
                           endif;
                        }
                        ?>
                     </div>
                     <div class="tg-column-2">
                        <?php
                        if( is_active_sidebar( 'colornews_front_content_right_section' ) ) {
                           if ( !dynamic_sidebar( 'colornews_front_content_right_section' ) ):
                           endif;
                        }
                        ?>
                     </div>
                  </div>
               </div><!-- .magazine-block-2-wrapper end -->
               <?php
               if( is_active_sidebar( 'colornews_front_content_bottom_section' ) ) {
                  if ( !dynamic_sidebar( 'colornews_front_content_bottom_section' ) ):
                  endif;
               }
               ?>
               <?php
               if ( get_theme_mod('colornews_hide_blog_front', 0) == 0 ) : ?>

                  <?php if ( have_posts() ) : ?>

                     <?php /* Start the Loop */ ?>

                     <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                           /*
                            * Include the Post-Format-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                            */
                           if ( is_front_page() && is_home() ) {
                              get_template_part( 'template-parts/content', get_post_format() );
                           } elseif ( is_front_page() ) {
                              get_template_part( 'template-parts/content', 'page' );
                           }
                        ?>

                     <?php endwhile; ?>

                     <?php colornews_posts_navigation(); ?>

                  <?php else : ?>

                     <?php get_template_part( 'template-parts/content', 'none' ); ?>

                  <?php endif; ?>

               <?php endif; ?>
            </div><!-- #primary end -->
            <?php colornews_sidebar_select(); ?>
         </div><!-- #main-content-section end -->
      </div><!-- .tg-inner-wrap -->
   </div><!-- .tg-container -->
</div><!-- #main -->

<?php get_footer(); ?>
