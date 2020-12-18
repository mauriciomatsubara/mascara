<?php
namespace AIOSEO\Plugin\Pro\Admin;

use AIOSEO\Plugin\Common\Admin as CommonAdmin;

/**
 * WP Site Health class.
 *
 * @since 4.0.0
 */
class SiteHealth extends CommonAdmin\SiteHealth {
	/**
	 * Class Constructor.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		parent::__construct();

		add_action( 'wp_ajax_health-check-aioseo-test_connection', [ $this, 'testCheckConnection' ] );
	}

	/**
	 * Add AIOSEO WP Site Health tests.
	 *
	 * @since 4.0.0
	 *
	 * @param  array $tests The current filters array.
	 * @return array
	 */
	public function registerTests( $tests ) {
		$tests = parent::registerTests( $tests );

		$tests['direct']['aioseo_license'] = [
			'label' => __( 'AIOSEO License', 'aioseo-pro' ),
			'test'  => [ $this, 'testCheckLicense' ],
		];

		$tests['async']['aioseo_connection'] = [
			'label' => __( 'AIOSEO Connection', 'aioseo-pro' ),
			'test'  => 'aioseo_test_connection',
		];

		return $tests;
	}

	/**
	 * Check if the license is properly set up.
	 *
	 * @since 4.0.0
	 *
	 * @return array A results array for the test.
	 */
	public function testCheckLicense() {
		// Translators: 1 - The plugin name ("All in One SEO").
		$label       = sprintf( __( 'Your %1$s license key is valid.', 'aioseo-pro' ), AIOSEO_PLUGIN_SHORT_NAME );
		$status      = 'good';
		// Translators: 1 - The license type.
		$description = sprintf( __( 'Your license key type for this site is %1$s.', 'aioseo-pro' ), '<strong>' . ucfirst( aioseo()->license->getLicenseLevel() ) . '</strong>' );
		$actions     = '';

		if ( ! aioseo()->license->isActive() ) {
			// Translators: 1 - The plugin name ("All in One SEO").
			$label  = sprintf( __( '%1$s is not licensed', 'aioseo-pro' ), AIOSEO_PLUGIN_SHORT_NAME );
			$status = 'critical';
			// Translators: 1 - The plugin name ("All in One SEO").
			$description = sprintf( __( '%1$s is not licensed which means you can\'t access automatic updates, and other advanced features', 'aioseo-pro' ), AIOSEO_PLUGIN_SHORT_NAME );
			$actions     = sprintf(
				'<p><a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a></p>',
				add_query_arg( 'page', 'aioseo-settings', admin_url( 'admin.php' ) ),
				__( 'Add License now', 'aioseo-pro' )
			);
		}

		return [
			'label'       => $label,
			'status'      => $status,
			'badge'       => [
				'label' => AIOSEO_PLUGIN_SHORT_NAME,
				'color' => 'blue',
			],
			'description' => $description,
			'test'        => 'aioseo_license',
			'actions'     => $actions
		];
	}

	/**
	 * Checks if there are errors communicating with aioseo.com.
	 *
	 * @since 4.0.0
	 *
	 * @return array A results array for the test.
	 */
	public function testCheckConnection() {
		$label  = __( 'Can connect to aioseo.com correctly', 'aioseo-pro' );
		$status = 'good';
		// Translators: 1 - The plugin name ("All in One SEO").
		$description = sprintf( __( 'The %1$s API is reachable and no connection issues have been detected.', 'aioseo-pro' ), AIOSEO_PLUGIN_SHORT_NAME );

		$url      = aioseo()->license->getUrl() . 'ping/';
		$params   = [
			'sslverify'  => defined( 'AIOSEO_DEV_VERSION' ) ? false : true,
			'timeout'    => 2,
			'user-agent' => 'AIOSEO/' . AIOSEO_VERSION,
			'body'       => '',
		];
		$response = wp_remote_get( $url, $params );

		if ( is_wp_error( $response ) || $response['response']['code'] < 200 || $response['response']['code'] > 300 ) {
			$status = 'critical';
			// Translators: 1 - The plugin name ("All in One SEO").
			$label       = sprintf( __( 'The %1$s server is not reachable.', 'aioseo-pro' ), AIOSEO_PLUGIN_SHORT_NAME );
			$description = __( 'Your server is blocking external requests to aioseo.com, please check your firewall settings or contact your host for more details.', 'aioseo-pro' );

			if ( is_wp_error( $response ) ) {
				// Translators: 1 - The description of the error.
				$description .= ' ' . sprintf( __( 'Error message: %1$s', 'aioseo-pro' ), $response->get_error_message() );
			}
		}

		wp_send_json_success( [
			'label'       => $label,
			'status'      => $status,
			'badge'       => [
				'label' => AIOSEO_PLUGIN_SHORT_NAME,
				'color' => 'blue',
			],
			'description' => $description,
			'test'        => 'aioseo_connection'
		] );
	}

	/**
	 * Checks whether the required settings for our schema markup are set.
	 *
	 * @since 4.0.0
	 *
	 * @return array The test result.
	 */
	public function testCheckPluginUpdate() {
		$updates = new Updates( [
			'pluginSlug' => 'all-in-one-seo-pack-pro',
			'pluginPath' => plugin_basename( AIOSEO_FILE ),
			'version'    => AIOSEO_VERSION,
			'key'        => aioseo()->options->general->licenseKey
		] );

		$shouldUpdate = false;
		$update       = $updates->checkForUpdates();
		if ( isset( $update->new_version ) && version_compare( AIOSEO_VERSION, $update->new_version, '<' ) ) {
			$shouldUpdate = true;
		}

		if ( $shouldUpdate ) {
			return $this->result(
				'aioseo_plugin_update',
				'critical',
				sprintf(
					// Translators: 1 - The plugin short name ("AIOSEO").
					__( '%1$s needs to be updated', 'all-in-one-seo-pack' ),
					AIOSEO_PLUGIN_SHORT_NAME
				),
				sprintf(
					// Translators: 1 - The plugin short name ("AIOSEO").
					__( 'An update is available for %1$s. Upgrade to the latest version to receive all the latest features, bug fixes and security improvements.', 'all-in-one-seo-pack' ),
					AIOSEO_PLUGIN_SHORT_NAME
				),
				$this->actionLink( admin_url( 'plugins.php' ), __( 'Go to Plugins', 'all-in-one-seo-pack' ) )
			);
		}
		return $this->result(
			'aioseo_plugin_update',
			'good',
			sprintf(
				// Translators: 1 - The plugin short name ("AIOSEO").
				__( '%1$s is updated to the latest version', 'all-in-one-seo-pack' ),
				AIOSEO_PLUGIN_SHORT_NAME
			),
			__( 'Fantastic! By updating to the latest version, you have access to all the latest features, bug fixes and security improvements.', 'all-in-one-seo-pack' )
		);
	}

	/**
	 * Returns a list of nofollowed content.
	 *
	 * @since 4.0.0
	 *
	 * @return array $nofollowed A list of nofollowed content.
	 */
	protected function nofollowed() {
		$nofollowed = parent::nofollowed();

		foreach ( aioseo()->helpers->getPublicPostTypes( false, true ) as $postType ) {
			if (
				aioseo()->options->searchAppearance->dynamic->archives->has( $postType['name'] ) &&
				! aioseo()->options->searchAppearance->dynamic->archives->{ $postType['name'] }->advanced->robotsMeta->default &&
				aioseo()->options->searchAppearance->dynamic->archives->{ $postType['name'] }->advanced->robotsMeta->nofollow
			) {
				$nofollowed[] = $postType['label'] . ' ' . __( 'Archives', 'all-in-one-seo-pack' ) . ' (' . $postType['name'] . ')';
			}
		}

		return $nofollowed;
	}

	/**
	 * Returns a list of noindexed content.
	 *
	 * @since 4.0.0
	 *
	 * @return array $noindexed A list of noindexed content.
	 */
	protected function noindexed() {
		$noindexed = parent::noindexed();

		foreach ( aioseo()->helpers->getPublicPostTypes( false, true ) as $postType ) {
			if (
				aioseo()->options->searchAppearance->dynamic->archives->has( $postType['name'] ) &&
				! aioseo()->options->searchAppearance->dynamic->archives->{ $postType['name'] }->advanced->robotsMeta->default &&
				aioseo()->options->searchAppearance->dynamic->archives->{ $postType['name'] }->advanced->robotsMeta->noindex
			) {
				$noindexed[] = $postType['label'] . ' ' . __( 'Archives', 'all-in-one-seo-pack' ) . ' (' . $postType['name'] . ')';
			}
		}

		return $noindexed;
	}
}