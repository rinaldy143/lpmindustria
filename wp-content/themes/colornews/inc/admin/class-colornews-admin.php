<?php
/**
 * ColorNews Admin Class.
 *
 * @author  ThemeGrill
 * @package ColorNews
 * @since 1.0.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ColorNews_Admin' ) ) :

	/**
	 * ColorNews_Admin Class.
	 */
	class ColorNews_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'colornews-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), COLORNEWS_THEME_VERSION );

			wp_enqueue_script( 'colornews-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), COLORNEWS_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&colornews-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'colornews' ),
				'nonce'    => wp_create_nonce( 'colornews_demo_import_nonce' ),
			);

			wp_localize_script( 'colornews-plugin-install-helper', 'colornewsRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new ColorNews_Admin();
