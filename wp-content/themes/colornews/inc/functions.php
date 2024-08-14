<?php
/**
 * ColorNews functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage ColorNews
 * @since      ColorNews 1.0
 */

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'colornews_fonts_url' ) ) {
	// Using google font
	// creating the function for adding the google font url
	function colornews_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		// applying the translators for the Google Fonts used
		/* Translators: If there are characters in your language that are not
		 * supported by Roboto, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'colornews' ) ) {
			$fonts[] = 'Roboto:400,300,700,900';
		}

		// ready to enqueue Google Font
		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => 'swap',
				),
				'//fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
}
// completion of enqueue for the google font

function colornews_scripts() {
	// use of enqueued google fonts
	wp_enqueue_style( 'colornews-google-fonts', colornews_fonts_url(), array(), null );

	wp_enqueue_style( 'colornews-style', get_stylesheet_uri() );

	wp_enqueue_style( 'colornews-fontawesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.4.0' );

	//Register bxSlider js file for slider.
	wp_register_script( 'colornews-bxslider', COLORNEWS_JS_URL . '/jquery.bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );

	if ( get_theme_mod( 'colornews_primary_sticky_menu', 0 ) == 1 ) {
		wp_enqueue_script( 'colornews-sticky-menu', COLORNEWS_JS_URL . '/sticky/jquery.sticky.js', array( 'jquery' ), '20150708', true );
	}

	if ( get_theme_mod( 'colornews_breaking_news', 0 ) == 1 ) {
		wp_enqueue_script( 'colornews-tickerme', COLORNEWS_JS_URL . '/tickerme/tickerme.min.js', array( 'jquery' ), '20150708', true );
	}

	// register magnific popup
	wp_register_script( 'colornews-magnific-popup', COLORNEWS_JS_URL . '/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '20150714', true );
	wp_register_style( 'colornews-featured-image-popup-css', COLORNEWS_JS_URL . '/magnific-popup/magnific-popup.css', array(), '20150714' );

	if ( get_theme_mod( 'colornews_featured_image_popup', 0 ) == 1 ) {
		wp_enqueue_script( 'colornews-magnific-popup' );
		wp_enqueue_style( 'colornews-featured-image-popup-css' );
	}

	// enqueueing fitvids for responsive videos
	wp_enqueue_script( 'colornews-fitvids', COLORNEWS_JS_URL . '/fitvids/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

	// enqueueing our custom script code
	wp_enqueue_script( 'colornews-custom', COLORNEWS_JS_URL . '/custom.js', array( 'colornews-bxslider' ), '20150708', true );

	wp_enqueue_script( 'colornews-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'html5shiv', COLORNEWS_JS_URL . '/html5shiv.js', array(), '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lte IE 8' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'colornews_scripts' );

function colornews_block_editor_styles() {
	wp_enqueue_style( 'colornews-editor-googlefonts', '//fonts.googleapis.com/css?family=Roboto:400,300,700,900' );
	wp_enqueue_style( 'colornews-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css' );
}

add_action( 'enqueue_block_editor_assets', 'colornews_block_editor_styles', 1, 1 );


// function to enqueue the image uploader script
function colornews_image_uploader() {
	wp_enqueue_media();
	wp_enqueue_script( 'colornews-widget-image-upload', COLORNEWS_JS_URL . '/image-uploader.js', false, '20150708', true );
}

add_action( 'admin_enqueue_scripts', 'colornews_image_uploader' );

/****************************************************************************************/

add_filter( 'excerpt_length', 'colornews_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function colornews_excerpt_length( $length ) {
	return 24;
}

add_filter( 'excerpt_more', 'colornews_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function colornews_continue_reading() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of WordPress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be full from thumbnail to be used in WordPress gallery as a default size
 */
function colornews_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts(
		array(
			'size' => 'colornews-featured-image',
		),
		$atts
	);

	$out['size'] = $atts['size'];

	return $out;
}

add_filter( 'shortcode_atts_gallery', 'colornews_gallery_atts', 10, 3 );

/****************************************************************************************/

add_filter( 'body_class', 'colornews_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function colornews_body_class( $classes ) {
	global $post;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colornews_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colornews_page_layout', true );
	}
	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}
	$colornews_default_layout = get_theme_mod( 'colornews_default_layout', 'right_sidebar' );

	$colornews_default_page_layout = get_theme_mod( 'colornews_default_page_layout', 'right_sidebar' );
	$colornews_default_post_layout = get_theme_mod( 'colornews_default_single_posts_layout', 'right_sidebar' );

	if ( $layout_meta == 'default_layout' ) {
		if ( is_page() ) {
			if ( $colornews_default_page_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $colornews_default_page_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $colornews_default_page_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $colornews_default_page_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( is_single() ) {
			if ( $colornews_default_post_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $colornews_default_post_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $colornews_default_post_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $colornews_default_post_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( $colornews_default_layout == 'right_sidebar' ) {
			$classes[] = '';
		} elseif ( $colornews_default_layout == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $colornews_default_layout == 'no_sidebar_full_width' ) {
			$classes[] = 'no-sidebar-full-width';
		} elseif ( $colornews_default_layout == 'no_sidebar_content_centered' ) {
			$classes[] = 'no-sidebar';
		}
	} elseif ( $layout_meta == 'right_sidebar' ) {
		$classes[] = '';
	} elseif ( $layout_meta == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$classes[] = 'no-sidebar-full-width';
	} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
		$classes[] = 'no-sidebar';
	}

	if ( get_theme_mod( 'colornews_site_layout', 'boxed_layout' ) == 'wide_layout' ) {
		$classes[] = 'wide';
	} elseif ( get_theme_mod( 'colornews_site_layout', 'boxed_layout' ) == 'boxed_layout' ) {
		$classes[] = 'boxed-layout';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'colornews_sidebar_select' ) ) :
	/**
	 * Function to select the sidebar
	 */
	function colornews_sidebar_select() {
		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colornews_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colornews_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}
		$colornews_default_layout = get_theme_mod( 'colornews_default_layout', 'right_sidebar' );

		$colornews_default_page_layout = get_theme_mod( 'colornews_default_page_layout', 'right_sidebar' );
		$colornews_default_post_layout = get_theme_mod( 'colornews_default_single_posts_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $colornews_default_page_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $colornews_default_page_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			}
			if ( is_single() ) {
				if ( $colornews_default_post_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $colornews_default_post_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $colornews_default_layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $colornews_default_layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/**************************************************************************************/

/*
 * Category Color Options
 */
if ( ! function_exists( 'colornews_category_color' ) ) :
	function colornews_category_color( $wp_category_id ) {
		$args     = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$category = get_categories( $args );
		foreach ( $category as $category_list ) {
			$color = get_theme_mod( 'colornews_category_color_' . $wp_category_id );

			return $color;
		}
	}
endif;

/**************************************************************************************/

/*
 * Category Color Display Settings
 */
if ( ! function_exists( 'colornews_colored_category_return' ) ) :
	function colornews_colored_category_return( $display ) {
		global $post;
		$categories = get_the_category();
		$separator  = '&nbsp;';
		$output     = '';
		if ( $categories ) {
			$output .= '<div class="category-collection">';
			foreach ( $categories as $category ) {
				$color_code = colornews_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<span class="cat-links"><a href="' . get_category_link( $category->term_id ) . '" style="background:' . colornews_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">' . $category->cat_name . '</a></span>' . $separator;
				} else {
					$output .= '<span class="cat-links"><a href="' . get_category_link( $category->term_id ) . '"  rel="category tag">' . $category->cat_name . '</a></span>' . $separator;
				}
			}
			$output .= '</div>';
			if ( $display == 0 ) {
				$output = trim( $output, $separator );
			}
			if ( $display == 1 ) {
				echo trim( $output, $separator );
			}
		}
		if ( $display == 0 ) {
			return $output;
		}
	}
endif;

/**************************************************************************************/

/*
 * Breaking News/Latest Posts ticker section in the header
 */
if ( ! function_exists( 'colornews_breaking_news' ) ) :
	function colornews_breaking_news() {
		$get_featured_posts = new WP_Query(
			array(
				'posts_per_page'      => 5,
				'post_type'           => 'post',
				'ignore_sticky_posts' => true,
			)
		);
		?>
		<div id="breaking-news" class="clearfix">
			<div class="tg-container">
				<div class="tg-inner-wrap">
					<div class="breaking-news-wrapper clearfix">
						<div class="breaking-news-title"><?php _e( 'Breaking News:', 'colornews' ); ?></div>
						<ul id="typing">
							<?php
							while ( $get_featured_posts->have_posts() ) :
								$get_featured_posts->the_post();
								?>
								<li>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		// Reset Post Data
		wp_reset_query();
	}
endif;

/**************************************************************************************/

/*
 * Display the date in the header
 */
if ( ! function_exists( 'colornews_date_display' ) ) :
	function colornews_date_display() {
		if ( get_theme_mod( 'colornews_date_display', 0 ) == 1 ) {
			?>
			<div class="date-in-header">
				<?php
				if ( get_theme_mod( 'colornews_date_display_type', 'theme_default' ) == 'theme_default' ) {
					echo date_i18n( 'l, F j, Y' );
				} elseif ( get_theme_mod( 'colornews_date_display_type', 'theme_default' ) == 'wordpress_date_setting' ) {
					echo date_i18n( get_option( 'date_format' ) );
				}
				?>
			</div>
			<?php
		}
	}
endif;

/**************************************************************************************/

/*
 * Random Post in menu
 */
if ( ! function_exists( 'colornews_random_post' ) ) :
	function colornews_random_post() {
		$get_random_post = new WP_Query(
			array(
				'posts_per_page'      => 1,
				'post_type'           => 'post',
				'ignore_sticky_posts' => true,
				'orderby'             => 'rand',
			)
		);
		?>
		<div class="random-post share-wrap">
			<?php
			while ( $get_random_post->have_posts() ) :
				$get_random_post->the_post();
				?>
				<a href="<?php the_permalink(); ?>" title="<?php _e( 'View a random post', 'colornews' ); ?>" class="share-icon"><i class="fa fa-random"></i></a>
			<?php endwhile; ?>
		</div><!-- .random-post.share-wrap end -->
		<?php
		// Reset Post Data
		wp_reset_query();
	}
endif;

/****************************************************************************************/

add_action( 'wp_head', 'colornews_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function colornews_custom_css() {
	$colornews_internal_css = '';
	$primary_color          = get_theme_mod( 'colornews_primary_color', '#dc3522' );
	if ( $primary_color != '#dc3522' ) {
		$colornews_internal_css .= ' .home-slider-wrapper .slider-btn a:hover,.random-hover-link a:hover{background:' . $primary_color . ';border:1px solid ' . $primary_color . '}#site-navigation ul>li.current-menu-ancestor,#site-navigation ul>li.current-menu-item,#site-navigation ul>li.current-menu-parent,#site-navigation ul>li:hover,.block-title,.bottom-header-wrapper .home-icon a:hover,.home .bottom-header-wrapper .home-icon a,.breaking-news-title,.bttn:hover,.carousel-slider-wrapper .bx-controls a,.cat-links a,.category-menu,.category-menu ul.sub-menu,.category-toggle-block,.error,.home-slider .bx-pager a.active,.home-slider .bx-pager a:hover,.navigation .nav-links a:hover,.post .more-link:hover,.random-hover-link a:hover,.search-box,.search-icon:hover,.share-wrap:hover,button,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover{background:' . $primary_color . '}a{color:' . $primary_color . '}.entry-footer a:hover{color:' . $primary_color . '}#bottom-footer .copy-right a:hover,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#top-footer .widget li:hover:before,.below-entry-meta span:hover a,.below-entry-meta span:hover i,.caption-title a:hover,.comment .comment-reply-link:hover,.entry-btn a:hover,.entry-title a:hover,.num-404,.tag-cloud-wrap a:hover,.top-menu-wrap ul li.current-menu-ancestor>a,.top-menu-wrap ul li.current-menu-item>a,.top-menu-wrap ul li.current-menu-parent>a,.top-menu-wrap ul li:hover>a,.widget a:hover,.widget a:hover::before{color:' . $primary_color . '}#top-footer .block-title{border-bottom:1px solid ' . $primary_color . '}#site-navigation .menu-toggle:hover,.sub-toggle{background:' . $primary_color . '}.colornews_random_post .random-hover-link a:hover{background:' . $primary_color . ' none repeat scroll 0 0;border:1px solid ' . $primary_color . '}#site-title a:hover{color:' . $primary_color . '}a#scroll-up i{color:' . $primary_color . '}.page-header .page-title{border-bottom:3px solid ' . $primary_color . ';color:' . $primary_color . '}@media (max-width: 768px) {    #site-navigation ul > li:hover > a, #site-navigation ul > li.current-menu-item > a,#site-navigation ul > li.current-menu-ancestor > a,#site-navigation ul > li.current-menu-parent > a {background:' . $primary_color . '}}';
	}

	if ( ! empty( $colornews_internal_css ) ) {
		echo '<!-- ' . get_bloginfo( 'name' ) . ' Internal Styles -->';
		?>
		<style type="text/css"><?php echo $colornews_internal_css; ?></style>
											<?php
	}
}

/**************************************************************************************/

add_action( 'colornews_footer_copyright', 'colornews_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'colornews_footer_copyright' ) ) :

	function colornews_footer_copyright() {

		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="https://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'colornews' ) . '" rel="nofollow"><span>' . esc_html__( 'WordPress', 'colornews' ) . '</span></a>';

		$tg_link = '<a href="https://themegrill.com/themes/colornews" target="_blank" title="' . esc_attr__( 'ColorNews', 'colornews' ) . '" rel="nofollow"><span>' . esc_html__( 'ColorNews', 'colornews' ) . '</span></a>';

		$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'colornews' ), date( 'Y' ), $site_link ) . '&nbsp;' . sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'colornews' ), $tg_link, 'ThemeGrill' ) . ' ' . sprintf( esc_html__( 'Powered by %s.', 'colornews' ), $wp_link );

		$colornews_footer_copyright = '<div class="copy-right">' . $default_footer_value . '</div>';

		echo $colornews_footer_copyright;
	}

endif;

/****************************************************************************************/
// Filter the get_header_image_tag() for option of adding the link back to home page option
function colornews_header_image_markup( $html, $header, $attr ) {
	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		if ( get_theme_mod( 'colornews_header_image_link', 0 ) == 1 ) {
			$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
		}

		$output .= '<div class="header-image-wrap"><img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"></div>';

		if ( get_theme_mod( 'colornews_header_image_link', 0 ) == 1 ) {
			$output .= '</a>';
		}
	}

	return $output;
}

function colornews_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'colornews_header_image_markup', 10, 3 );
}

add_action( 'colornews_header_image_markup_render', 'colornews_header_image_markup_filter' );

/****************************************************************************************/

if ( ! function_exists( 'colornews_render_header_image' ) ) :
	/**
	 * Shows the small info text on top header part
	 */
	function colornews_render_header_image() {
		if ( function_exists( 'the_custom_header_markup' ) ) {
			do_action( 'colornews_header_image_markup_render' );
			the_custom_header_markup();
		} else {
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) {
				if ( get_theme_mod( 'colornews_header_image_link', 0 ) == 1 ) {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php } ?>
				<div class="header-image-wrap">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
				<?php if ( get_theme_mod( 'colornews_header_image_link', 0 ) == 1 ) { ?>
					</a>
					<?php
				}
			}
		}
	}
endif;

/**************************************************************************************/

/*
 * Display the related posts
 */
if ( ! function_exists( 'colornews_related_posts_function' ) ) {

	function colornews_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);
		// Related by categories
		if ( get_theme_mod( 'colornews_related_posts', 'categories' ) == 'categories' ) {

			$cats = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod( 'colornews_related_posts', 'categories' ) == 'tags' ) {

			$tags = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}

}

/**************************************************************************************/

/*
 * Creating Social Menu
 */

if ( ! function_exists( 'colornews_social_menu' ) ) {
	function colornews_social_menu() {
		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'social',
					'container'       => 'div',
					'container_id'    => 'menu-social',
					'container_class' => 'login-signup-wrap',
					'depth'           => 1,
					'fallback_cb'     => false,
					'items_wrap'      => '<ul>%3$s</ul>',
				)
			);
		}
	}
}

/**************************************************************************************/

if ( ! function_exists( 'colornews_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function colornews_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'colornews' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'colornews' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 74 );
						printf(
							'<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'colornews' ) . '</span>' : ''
						);
						printf(
							'<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
							sprintf( __( '%1$s at %2$s', 'colornews' ), get_comment_date(), get_comment_time() )
						);
						printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
						edit_comment_link();
						?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'colornews' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'reply_text' => __( 'Reply', 'colornews' ),
									'after'      => '',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);
						?>
					</section><!-- .comment-content -->

				</article><!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'colornews_entry_meta' ) ) :
	/**
	 * Shows meta information of post.
	 */
	function colornews_entry_meta() {
		if ( 'post' == get_post_type() ) :
			echo '<div class="below-entry-meta">';
			?>

			<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
																															<?php
																															_e( 'Posted By: ', 'colornews' );
																															echo esc_html( get_the_author() );
																															?>
						</a></span></span>

			<?php
			if ( ! post_password_required() && comments_open() ) {
				?>
				<span class="comments"><?php comments_popup_link( __( '<i class="fa fa-comment"></i> 0 Comment', 'colornews' ), __( '<i class="fa fa-comment"></i> 1 Comment', 'colornews' ), __( '<i class="fa fa-comments"></i> % Comments', 'colornews' ) ); ?></span>
				<?php
			}
			$tags_list = get_the_tag_list( '<span class="tag-links"><i class="fa fa-tags"></i>', __( ', ', 'colornews' ), '</span>' );
			if ( $tags_list ) {
				echo $tags_list;
			}

			edit_post_link( __( 'Edit', 'colornews' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );

			echo '</div>';
		endif;
	}
endif;

/****************************************************************************************/

/*
 * Support for Google updated/published date
 */
if ( ! function_exists( 'colornews_published_date' ) ) :

	function colornews_published_date() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		printf(
			__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'colornews' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string
		);
	}

endif;

/**************************************************************************************/

/*
 * Creating responsive video for posts/pages
 */
if ( ! function_exists( 'colornews_responsive_video' ) ) :
	function colornews_responsive_video( $html, $url, $attr, $post_ID ) {
		if ( ! current_theme_supports( 'responsive-embeds' ) ) {
			return '<div class="fitvids-video">' . $html . '</div>';
		}

		return $html;
	}

	add_filter( 'embed_oembed_html', 'colornews_responsive_video', 10, 4 );
endif;

/**************************************************************************************/

/*
 * Use of the hooks for Category Color in the archive titles
 */
function colornews_colored_category_title( $title ) {
	$color_value        = colornews_category_color( get_cat_id( $title ) );
	$color_border_value = colornews_category_color( get_cat_id( $title ) );
	if ( ! empty( $color_value ) ) {
		return '<h1 class="page-title category-title" style="border-bottom:3px solid ' . $color_border_value . ';' . 'color:' . $color_value . '">' . $title . '</h1>';
	} else {
		return '<h1 class="page-title">' . $title . '</h1>';
	}
}

function colornews_category_title_function( $category_title ) {
	add_filter( 'single_cat_title', 'colornews_colored_category_title' );
}

add_action( 'colornews_category_title', 'colornews_category_title_function' );

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action( 'woocommerce_before_main_content', 'colornews_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'colornews_wrapper_end', 10 );
add_action( 'woocommerce_sidebar', 'colornews_get_sidebar', 10 );

function colornews_wrapper_start() {
	echo '<div id="main" class="clearfix"><div class="tg-container"><div class="tg-inner-wrap clearfix"><div id="main-content-section clearfix"><div id="primary">';
}

function colornews_wrapper_end() {
	echo '</div>';
}

function colornews_get_sidebar() {
	colornews_sidebar_select();
	echo '</div></div></div></div>';
}

// Displays the site logo
if ( ! function_exists( 'colornews_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function colornews_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}

if ( ! function_exists( 'colornews_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function colornews_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'colornews_pingback_header' );

/**
 * Compare user's current version of plugin.
 */
if ( ! function_exists( 'colornews_plugin_version_compare' ) ) {
	function colornews_plugin_version_compare( $plugin_slug, $version_to_compare ) {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$tdi_user_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $tdi_user_version, $version_to_compare, '<' );
	}
}
