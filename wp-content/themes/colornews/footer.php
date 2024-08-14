<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

?>
   <?php
   if( is_active_sidebar( 'colornews_advertisement_above_footer' ) ) {
      if ( !dynamic_sidebar( 'colornews_advertisement_above_footer' ) ):
      endif;
   }
   ?>

   <?php do_action( 'colornews_before_footer' ); ?>
	<footer id="colophon">
      <?php get_sidebar( 'footer' ); ?>
      <div id="bottom-footer">
         <div class="tg-container">
            <div class="tg-inner-wrap">
               <?php colornews_footer_copyright(); ?>
            </div>
         </div>
      </div>
	</footer><!-- #colophon end -->
   <a href="#masthead" id="scroll-up"><i class="fa fa-arrow-up"></i></a>
</div><!-- #page end -->

<?php wp_footer(); ?>

</body>
</html>