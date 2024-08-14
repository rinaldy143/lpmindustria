<?php
/**
 * The template for displaying 404 pages (not found).
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

                  <?php if ( ! dynamic_sidebar( 'colornews_error_404_page_sidebar' ) ) : ?>
            			<section class="error-404 not-found">
                        <div class="page-content">
               				<header class="page-header">
               					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'colornews' ); ?></h1>
               				</header><!-- .page-header -->

            					<p><?php esc_html_e( 'It looks like nothing was found at this location. You can try a search instead.', 'colornews' ); ?></p>

                           <div class="error-wrap">
                              <span class="num-404">
                                 <?php _e( '404', 'colornews' ); ?>
                              </span>
                              <span class="error"><?php _e( 'error', 'colornews' ); ?></span>
                           </div>

            					<?php get_search_form(); ?>
            				</div><!-- .page-content -->
            			</section><!-- .error-404 -->
                  <?php endif; ?>

         		</div><!-- #primary end -->
               <?php colornews_sidebar_select(); ?>
            </div><!-- #main-content-section end -->
         </div><!-- .tg-inner-wrap -->
      </div><!-- .tg-container -->
   </div><!-- #main -->

   <?php do_action( 'colornews_after_body_content' ); ?>

<?php get_footer(); ?>
