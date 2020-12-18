<?php
namespace AIOSEO\Plugin\Pro\Migration;

// phpcs:disable WordPress.Arrays.ArrayDeclarationSpacing.AssociativeArrayFound

/**
 * Migrates the Video Sitemap settings from V3.
 *
 * @since 4.0.0
 */
class GeneralSettings {

	/**
	 * Class constructor.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		$settings = [
			'aiosp_ga_track_outbound_links' => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackOutboundLinks' ] ],
			'aiosp_ga_link_attribution'     => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'enhancedLinkAttribution' ] ],
			'aiosp_ga_enhanced_ecommerce'   => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'enhancedEcommerce' ] ],
			'aiosp_ga_track_outbound_forms' => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackOutboundForms' ] ],
			'aiosp_ga_track_events'         => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackEvents' ] ],
			'aiosp_ga_track_url_changes'    => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackUrlChanges' ] ],
			'aiosp_ga_track_visibility'     => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackVisibility' ] ],
			'aiosp_ga_track_media_query'    => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackMediaQueries' ] ],
			'aiosp_ga_track_impressions'    => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackImpressions' ] ],
			'aiosp_ga_track_scroller'       => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackScrollbar' ] ],
			'aiosp_ga_track_social'         => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackSocial' ] ],
			'aiosp_ga_track_clean_url'      => [ 'type' => 'boolean', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'trackCleanUrl' ] ],
			'aiosp_gtm_container_id'        => [ 'type' => 'string', 'newOption' => [ 'webmasterTools', 'googleAnalytics', 'gtmContainerId' ] ],
		];

		aioseo()->migration->helpers->mapOldToNew( $settings, aioseo()->migration->oldOptions );
	}
}