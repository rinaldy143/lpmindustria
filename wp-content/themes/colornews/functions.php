<?php
/**
 * ColorNews functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 *
 * @uses       add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses       register_nav_menu() To add support for navigation menu.
 * @uses       set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package    ThemeGrill
 * @subpackage ColorNews
 * @since      ColorNews 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 715;
}

/**
 * $content_width global variable adjustment as per layout option.
 */
function colornews_content_width() {
	global $post;
	global $content_width;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colornews_page_layout', true );
	}
	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}
	$colornews_default_layout = get_theme_mod( 'colornews_default_layout', 'right_sidebar' );

	if ( $layout_meta == 'default_layout' ) {
		if ( $colornews_default_layout == 'no_sidebar_full_width' ) {
			$content_width = 1100; /* pixels */
		} else {
			$content_width = 715; /* pixels */
		}
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$content_width = 1100; /* pixels */
	} else {
		$content_width = 715; /* pixels */
	}
}

add_action( 'template_redirect', 'colornews_content_width' );

if ( ! function_exists( 'colornews_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function colornews_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ColorNews, use a find and replace
		 * to change 'colornews' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'colornews', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Gutenberg layout support.
		add_theme_support( 'align-wide' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Responsive embeds support.
		add_theme_support( 'responsive-embeds' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Adds the support for the Custom Logo introduced in WordPress 4.5
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Cropping the images to different sizes to be used in the theme
		add_image_size( 'colornews-big-slider', 1070, 470, true );
		add_image_size( 'colornews-big-slider-thumb', 184, 109, true );
		add_image_size( 'colornews-featured-post-medium', 345, 265, true );
		add_image_size( 'colornews-featured-post-small', 115, 73, true );
		add_image_size( 'colornews-random-posts', 215, 215, true );
		add_image_size( 'colornews-featured-image', 715, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'colornews' ),
			'social'   => esc_html__( 'Social Menu', 'colornews' ),
			'category' => esc_html__( 'Category Menu', 'colornews' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'chat',
			'status',
			'audio',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'colornews_custom_background_args', array(
			'default-color' => '565759',
			'default-image' => get_template_directory_uri() . '/img/bg-pattern.jpg',
		) ) );

		// adding the WooCommerce plugin support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Selective refresh widgets support
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // colornews_setup
add_action( 'after_setup_theme', 'colornews_setup' );

/**
 * Define Directory Location Constants
 */
define( 'COLORNEWS_PARENT_DIR', get_template_directory() );
define( 'COLORNEWS_CHILD_DIR', get_stylesheet_directory() );

define( 'COLORNEWS_INCLUDES_DIR', COLORNEWS_PARENT_DIR . '/inc' );
define( 'COLORNEWS_JS_DIR', COLORNEWS_PARENT_DIR . '/js' );
define( 'COLORNEWS_LANGUAGES_DIR', COLORNEWS_PARENT_DIR . '/languages' );
define( 'COLORNEWS_ADMIN_DIR', COLORNEWS_INCLUDES_DIR . '/admin' );
define( 'COLORNEWS_WIDGETS_DIR', COLORNEWS_INCLUDES_DIR . '/widgets' );
define( 'COLORNEWS_ADMIN_IMAGES_DIR', COLORNEWS_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'COLORNEWS_PARENT_URL', get_template_directory_uri() );
define( 'COLORNEWS_CHILD_URL', get_stylesheet_directory_uri() );

define( 'COLORNEWS_INCLUDES_URL', COLORNEWS_PARENT_URL . '/inc' );
define( 'COLORNEWS_JS_URL', COLORNEWS_PARENT_URL . '/js' );
define( 'COLORNEWS_LANGUAGES_URL', COLORNEWS_PARENT_URL . '/languages' );
define( 'COLORNEWS_ADMIN_URL', COLORNEWS_INCLUDES_URL . '/admin' );
define( 'COLORNEWS_WIDGETS_URL', COLORNEWS_INCLUDES_URL . '/widgets' );
define( 'COLORNEWS_ADMIN_IMAGES_URL', COLORNEWS_ADMIN_URL . '/images' );

/** Load functions */
require_once( COLORNEWS_INCLUDES_DIR . '/custom-header.php' );
require_once( COLORNEWS_INCLUDES_DIR . '/functions.php' );
require_once( COLORNEWS_INCLUDES_DIR . '/customizer.php' );
require_once( COLORNEWS_INCLUDES_DIR . '/template-tags.php' );
require_once( COLORNEWS_INCLUDES_DIR . '/extras.php' );

/** Load required meta boxes */
require_once( COLORNEWS_ADMIN_DIR . '/meta-boxes.php' );

/** Load Widgets and Widgetized Area */
require_once( COLORNEWS_WIDGETS_DIR . '/widgets.php' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Assign the ColorNews version to a variable.
 */
$colornews_theme = wp_get_theme( 'colornews' );

define( 'COLORNEWS_THEME_VERSION', $colornews_theme->get( 'Version' ) );

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-admin.php' );
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-dashboard.php' );
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-notice.php' );
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-welcome-notice.php' );
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-upgrade-notice.php' );
	require( COLORNEWS_ADMIN_DIR . '/class-colornews-theme-review-notice.php' );
}

