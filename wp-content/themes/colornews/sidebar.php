<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */
?>

<div id="secondary">
   <?php do_action( 'colornews_before_sidebar' ); ?>
      <?php
         if( is_page_template( 'page-templates/contact.php' ) ) {
            $sidebar = 'colornews_contact_page_sidebar';
         }
         else {
            $sidebar = 'colornews_right_sidebar';
         }
      ?>

      <?php if ( ! dynamic_sidebar( $sidebar ) ) :
         if ( $sidebar == 'colornews_contact_page_sidebar' ) {
            $sidebar_display = __('Contact Page', 'colornews');
         } else {
            $sidebar_display = __('Right', 'colornews');
         }
         the_widget( 'WP_Widget_Text',
            array(
               'title'  => __( 'Example Widget', 'colornews' ),
               'text'   => sprintf( __( 'This is an example widget to show how the %s Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'colornews' ), $sidebar_display, current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
               'filter' => true,
            ),
            array(
               'before_widget' => '<aside class="widget widget_text clearfix">',
               'after_widget'  => '</aside>',
               'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
               'after_title'   => '</span></span></h3>'
            )
         );
      endif; ?>

   <?php do_action( 'colornews_after_sidebar' ); ?>
</div>