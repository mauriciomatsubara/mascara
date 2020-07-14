<?php
/**
 * WooCommerce Activity Panel.
 * NOTE: DO NOT edit this file in WooCommerce core, this is generated from woocommerce-admin.
 *
 * @package Woocommerce Admin
 */

namespace Automattic\WooCommerce\Admin\Features;

use Automattic\WooCommerce\Admin\Notes\WC_Admin_Notes;

/**
 * Contains backend logic for the activity panel feature.
 */
class ActivityPanels {
	/**
	 * Class instance.
	 *
	 * @var ActivityPanels instance
	 */
	protected static $instance = null;

	/**
	 * Low Stock Transient Name.
	 */
	const LOW_STOCK_TRANSIENT_NAME = 'woocommerce_admin_low_out_of_stock_count';

	/**
	 * Get class instance.
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Hook into WooCommerce.
	 */
	public function __construct() {
		add_filter( 'woocommerce_admin_get_user_data_fields', array( $this, 'add_user_data_fields' ) );
		// Run after Automattic\WooCommerce\Admin\Loader.
		add_filter( 'woocommerce_components_settings', array( $this, 'component_settings' ), 20 );
		// New settings injection.
		add_filter( 'woocommerce_shared_settings', array( $this, 'component_settings' ), 20 );
		add_action( 'woocommerce_update_product', array( __CLASS__, 'clear_low_out_of_stock_count_transient' ) );
	}

	/**
	 * Adds fields so that we can store activity panel last read and open times.
	 *
	 * @param array $user_data_fields User data fields.
	 * @return array
	 */
	public function add_user_data_fields( $user_data_fields ) {
		return array_merge(
			$user_data_fields,
			array(
				'activity_panel_inbox_last_read',
				'activity_panel_reviews_last_read',
			)
		);
	}

	/**
	 * Determines if there are out of stock or low stock products.
	 *
	 * @return boolean
	 */
	public function has_low_stock_products() {
		global $wpdb;

		// Bail early if store does not manage stock, or Woo version < 3.6 needs lookup tables.
		if (
			'yes' !== get_option( 'woocommerce_manage_stock' ) ||
			version_compare( get_option( 'woocommerce_db_version', null ), '3.6', '<' )
		) {
			return false;
		}

		$low_stock_out_of_stock_count = get_transient( self::LOW_STOCK_TRANSIENT_NAME );

		if ( false === $low_stock_out_of_stock_count ) {
			$low_stock_out_of_stock_count = (int) $wpdb->get_var(
				"SELECT COUNT( product_id )
				FROM {$wpdb->wc_product_meta_lookup} AS lookup
				INNER JOIN {$wpdb->posts} as posts ON lookup.product_id = posts.ID
				WHERE stock_status IN ( 'onbackorder', 'outofstock' )
				AND posts.post_status = 'publish'"
			);
			set_transient( self::LOW_STOCK_TRANSIENT_NAME, $low_stock_out_of_stock_count, HOUR_IN_SECONDS );
		}
		return $low_stock_out_of_stock_count > 0;
	}

	/**
	 * Clears transient for out of stock indicator
	 *
	 * @return boolean
	 */
	public static function clear_low_out_of_stock_count_transient() {
		delete_transient( self::LOW_STOCK_TRANSIENT_NAME );
		return true;
	}

	/**
	 * Add alert count to the component settings.
	 *
	 * @param array $settings Component settings.
	 */
	public function component_settings( $settings ) {
		$settings['alertCount']  = WC_Admin_Notes::get_notes_count( array( 'error', 'update' ), array( 'unactioned' ) );
		$settings['hasLowStock'] = $this->has_low_stock_products();
		return $settings;
	}
}
