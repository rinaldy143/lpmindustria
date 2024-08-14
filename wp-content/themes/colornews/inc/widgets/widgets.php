<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function colornews_widgets_init() {
   // registering right sidebar
   register_sidebar( array(
      'name'          => esc_html__( 'Right Sidebar', 'colornews' ),
      'id'            => 'colornews_right_sidebar',
      'description'   => __( 'Shows widgets at the Right Sidebar.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering left sidebar
   register_sidebar( array(
      'name'          => esc_html__( 'Left Sidebar', 'colornews' ),
      'id'            => 'colornews_left_sidebar',
      'description'   => __( 'Shows widgets at the Left Sidebar.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering header sidebar
   register_sidebar( array(
      'name'          => esc_html__( 'Header Sidebar', 'colornews' ),
      'id'            => 'colornews_header_sidebar',
      'description'   => __( 'Shows widgets in the Header Section just above the main navigation menu.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering contact page sidebar
   register_sidebar( array(
      'name'          => esc_html__( 'Contact Page Sidebar', 'colornews' ),
      'id'            => 'colornews_contact_page_sidebar',
      'description'   => __( 'Shows widgets in the Contact Page sidebar.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering 404 page sidebar
   register_sidebar( array(
      'name'          => esc_html__( '404 Error Page Sidebar', 'colornews' ),
      'id'            => 'colornews_error_404_page_sidebar',
      'description'   => __( 'Shows widgets in the 404 Error Page sidebar.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering front page slider area
   register_sidebar( array(
      'name'          => esc_html__( 'Front Page: Slider Area', 'colornews' ),
      'id'            => 'colornews_front_slider_area',
      'description'   => __( 'Shows widgets in the Front Page: Slider Area. Suitable for TG: Featured Posts (Style 1) widget.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering front page content top section
   register_sidebar( array(
      'name'          => esc_html__( 'Front Page: Content Top Section', 'colornews' ),
      'id'            => 'colornews_front_content_top_section',
      'description'   => __( 'Shows widgets in the Front Page: Content Top Section.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering front page content left section
   register_sidebar( array(
      'name'          => esc_html__( 'Front Page: Content Middle Left Section', 'colornews' ),
      'id'            => 'colornews_front_content_left_section',
      'description'   => __( 'Shows widgets in the Front Page: Content Middle Left Section.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering front page content right section
   register_sidebar( array(
      'name'          => esc_html__( 'Front Page: Content Middle Right Section', 'colornews' ),
      'id'            => 'colornews_front_content_right_section',
      'description'   => __( 'Shows widgets in the Front Page: Content Middle Right Section.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering front page content top section
   register_sidebar( array(
      'name'          => esc_html__( 'Front Page: Content Bottom Section', 'colornews' ),
      'id'            => 'colornews_front_content_bottom_section',
      'description'   => __( 'Shows widgets in the Front Page: Content Bottom Section.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering footer advertisement area
   register_sidebar( array(
      'name'          => esc_html__( 'Advertisement Above Footer', 'colornews' ),
      'id'            => 'colornews_advertisement_above_footer',
      'description'   => __( 'Shows widgets just above the Footer Area.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering footer advertisement area
   register_sidebar( array(
      'name'          => esc_html__( 'Footer Sidebar One', 'colornews' ),
      'id'            => 'colornews_footer_sidebar_one',
      'description'   => __( 'Shows widgets in the Footer Sidebar One.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering footer advertisement area
   register_sidebar( array(
      'name'          => esc_html__( 'Footer Sidebar Two', 'colornews' ),
      'id'            => 'colornews_footer_sidebar_two',
      'description'   => __( 'Shows widgets in the Footer Sidebar Two.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // registering footer advertisement area
   register_sidebar( array(
      'name'          => esc_html__( 'Footer Sidebar Three', 'colornews' ),
      'id'            => 'colornews_footer_sidebar_three',
      'description'   => __( 'Shows widgets in the Footer Sidebar Three.', 'colornews' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title title-block-wrap clearfix"><span class="block-title"><span>',
      'after_title'   => '</span></span></h3>',
   ) );

   // Our custom made widgets.
   register_widget( 'colornews_728x90_advertisement_widget' );
   register_widget( 'colornews_300x250_advertisement_widget' );
   register_widget( 'colornews_125x125_advertisement_widget' );
   // featured posts widgets
   register_widget( 'colornews_featured_post_style_one_widget' );
   register_widget( 'colornews_featured_post_style_two_widget' );
   register_widget( 'colornews_featured_post_style_three_widget' );
   register_widget( 'colornews_featured_post_style_four_widget' );
   register_widget( 'colornews_random_posts_widget' );
   register_widget( 'colornews_popular_posts_widget' );
   register_widget( 'colornews_custom_tag_widget' );
}

add_action( 'widgets_init', 'colornews_widgets_init' );

// Require for TG: 728x90 Advertisement.
require COLORNEWS_WIDGETS_DIR . '/colornews-728x90-advertisement-widget.php';

// Require for TG: 300x250 Advertisement.
require COLORNEWS_WIDGETS_DIR . '/colornews-300x250-advertisement-widget.php';

// Require for TG: 125x125 Advertisement.
require COLORNEWS_WIDGETS_DIR . '/colornews-125x125-advertisement-widget.php';

// Require for TG: Featured Post (Style 1).
require COLORNEWS_WIDGETS_DIR . '/colornews-featured-post-style-one-widget.php';

// Require for TG: Featured Post (Style 2).
require COLORNEWS_WIDGETS_DIR . '/colornews-featured-post-style-two-widget.php';

// Require for TG: Featured Post (Style 3).
require COLORNEWS_WIDGETS_DIR . '/colornews-featured-post-style-three-widget.php';

// Require for TG: Featured Post (Style 4).
require COLORNEWS_WIDGETS_DIR . '/colornews-featured-post-style-four-widget.php';

// Require for TG: Random Posts Widget.
require COLORNEWS_WIDGETS_DIR . '/colornews-random-posts-widget.php';

// Require for TG: Popular Posts Widget.
require COLORNEWS_WIDGETS_DIR . '/colornews-popular-posts-widget.php';

// Require for TG: Custom Tag Widget.
require COLORNEWS_WIDGETS_DIR . '/colornews-custom-tag-widget.php';

