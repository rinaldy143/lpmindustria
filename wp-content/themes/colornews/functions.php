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


function custom_slider_navigation_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var slider = $('.bxslider').bxSlider({
                mode: 'horizontal',
                controls: false,  // Menonaktifkan kontrol default
                pager: false,
                auto: true,  // Menjaga autoplay tetap aktif
                pause: 4000, // Waktu jeda antara perpindahan slide
                speed: 500  // Kecepatan perpindahan slide
            });

            // Menambahkan kontrol navigasi di dalam gambar
            $('.bxslider').after(
                '<div class="slider-controls">' +
                '<a href="#" class="slider-prev"><i class="fa fa-angle-left"></i></a>' +
                '<a href="#" class="slider-next"><i class="fa fa-angle-right"></i></a>' +
                '</div>'
            );

            $('.slider-prev').click(function(e) {
                e.preventDefault();
                slider.goToPrevSlide();
            });

            $('.slider-next').click(function(e) {
                e.preventDefault();
                slider.goToNextSlide();
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_slider_navigation_script');

function custom_slider_navigation_sidebar_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.bxslider-sidebar').each(function(index) {
                var slider = $(this).bxSlider({
                    mode: 'horizontal',
                    controls: false,
                    pager: false,
                    auto: true,
                    pause: 4000,
                    speed: 500
                });

                // Menambahkan kontrol navigasi di dalam gambar
                $(this).after(
                    '<div class="slider-controls slider-controls-' + index + '">' +
                    '<a href="#" class="slider-prev slider-prev-' + index + '"><i class="fa fa-angle-left"></i></a>' +
                    '<a href="#" class="slider-next slider-next-' + index + '"><i class="fa fa-angle-right"></i></a>' +
                    '</div>'
                );

                $('.slider-prev-' + index).click(function(e) {
                    e.preventDefault();
                    slider.goToPrevSlide();
                });

                $('.slider-next-' + index).click(function(e) {
                    e.preventDefault();
                    slider.goToNextSlide();
                });
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_slider_navigation_sidebar_script');

function the_breadcrumb() {
    if (!is_home()) {
        echo '<nav aria-label="breadcrumb" class="mr-1"><ol class="breadcrumb mr-1">';
        
        // Menampilkan breadcrumb dengan Breadcrumb YoastSEO
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<ul class="breadcrumb-item">', '</ul>');
        } else {
            // Custom breadcrumb untuk kasus tanpa kategori
            global $post;
            $categories = get_the_category($post->ID);

            if (empty($categories)) {
                echo '<ul class="breadcrumb-item active" aria-current="page">Uncategorized</ul>';
            } else {
                foreach ($categories as $category) {
                    echo '<ul class="breadcrumb-item mr-1"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></ul>';
                }
                echo '<ul class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</ul>';
            }
        }

        echo '</ol></nav>';
    }
}


add_filter('wpseo_canonical', 'yoast_custom_canonical_pagination');

function yoast_custom_canonical_pagination($canonical) {
    if (is_paged()) {
        $page_url = get_pagenum_link(1);
        return $page_url;
    }
    return $canonical;
}

function custom_copy_link_script() {
    // Daftarkan script kosong untuk dijadikan wadah
    wp_register_script('copy-link-script', '');

    // JavaScript untuk menyalin link dan menampilkan popup
    $inline_script = "
    document.addEventListener('DOMContentLoaded', function() {
        var copyButton = document.getElementById('link-copy');
        var popup = document.getElementById('copyPopup');

        copyButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Buat elemen textarea untuk menampung URL sementara
            var tempInput = document.createElement('textarea');
            tempInput.value = window.location.href;
            document.body.appendChild(tempInput);

            // Pilih teks di dalam textarea dan salin ke clipboard
            tempInput.select();
            document.execCommand('copy');

            // Hapus textarea sementara
            document.body.removeChild(tempInput);

            // Tampilkan popup notifikasi bahwa URL telah disalin
            popup.innerText = 'Link copied!';
            popup.style.display = 'block';

            // Sembunyikan popup setelah 2 detik
            setTimeout(function() {
                popup.style.display = 'none';
            }, 2000);
        });
    });
    ";

    // Masukkan JavaScript ke dalam halaman
    wp_add_inline_script('copy-link-script', $inline_script);

    // Enqueue script
    wp_enqueue_script('copy-link-script');
}
add_action('wp_enqueue_scripts', 'custom_copy_link_script');

