<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'colornews_footer_sidebar_one' ) &&
   !is_active_sidebar( 'colornews_footer_sidebar_two' ) &&
   !is_active_sidebar( 'colornews_footer_sidebar_three' ) ) {
   return;
}
?>
<div id="top-footer">
   <div class="tg-container">
      <div class="tg-inner-wrap">
         <div class="top-footer-content-wrapper">
            <div class="tg-column-wrapper">
               <div class="tg-footer-column-3">
                  <?php
                  if ( !dynamic_sidebar( 'colornews_footer_sidebar_one' ) ):
                  endif;
                  ?>
               </div>
               <div class="tg-footer-column-3">
                  <?php
                  if ( !dynamic_sidebar( 'colornews_footer_sidebar_two' ) ):
                  endif;
                  ?>
               </div>
               <div class="tg-footer-column-3">
                  <?php
                  if ( !dynamic_sidebar( 'colornews_footer_sidebar_three' ) ):
                  endif;
                  ?>
               </div>
            </div><!-- .tg-column-wrapper end -->
         </div><!-- .top-footer-content-wrapper end -->
      </div><!-- .tg-inner-wrap end -->
   </div><!-- .tg-container end -->
</div><!-- .top-footer end -->
