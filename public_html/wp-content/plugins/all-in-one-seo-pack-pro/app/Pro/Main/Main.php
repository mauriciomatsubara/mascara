<?php
namespace AIOSEO\Plugin\Pro\Main;

use AIOSEO\Plugin\Common\Main as CommonMain;

/**
 * Main class with methods that are called.
 *
 * @since 4.0.0
 */
class Main extends CommonMain\Main {
	/**
	 * Construct method.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		parent::__construct();

		add_action( 'admin_init', [ $this, 'disableLiteVersion' ], 1 );

		// Ajax methods.
		//add_action( 'wp_ajax_aioseo_ajax_facebook_debug', 'aioseo_ajax_facebook_debug' );
	}

	/**
	 * Deactivate the lite version of AIO.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function disableLiteVersion() {
		if ( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) {
			deactivate_plugins( 'all-in-one-seo-pack/all_in_one_seo_pack.php' );
		}
	}
}