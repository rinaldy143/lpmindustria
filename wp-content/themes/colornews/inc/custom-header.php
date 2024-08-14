<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package ThemeGrill
 * @subpackage ColorNews
 * @since ColorNews 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 */
function colornews_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'colornews_custom_header_args', array(
		'default-image'				=> '',
		'header-text'				=> '',
		'default-text-color'		=> '',
		'width'						=> 1400,
		'height'					=> 400,
		'flex-width'				=> true,
		'flex-height'				=> true,
		'wp-head-callback'			=> '',
		'admin-head-callback'		=> '',
		'video'						=> true,
		'admin-preview-callback'	=> 'colornews_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'colornews_custom_header_setup' );

if ( ! function_exists( 'colornews_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function colornews_admin_header_image() { ?>
	<div id="headimg">
		<?php if ( function_exists( 'the_custom_header_markup' ) ) {
			the_custom_header_markup();
		} else {
			if ( get_header_image() ) : ?>
				<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
			<?php endif;
		} ?>
	</div>
	<?php
}
endif; // colornews_admin_header_image
