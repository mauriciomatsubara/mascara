<?php
namespace AIOSEO\Plugin\Common\Main;

use AIOSEO\Plugin\Common\Utils;

/**
 * Outputs the Google Analytics to the head.
 *
 * @since 4.0.0
 */
class GoogleAnalytics {
	/**
	 * Retrieves the script to output.
	 *
	 * @since 4.0.0
	 */
	public function canShowScript() {
		$pluginUpgrader = new Utils\PluginUpgraderSilentAjax();
		$miLite         = $pluginUpgrader->pluginSlugs['miLite'];
		$miPro          = $pluginUpgrader->pluginSlugs['miPro'];
		$emLite         = $pluginUpgrader->pluginSlugs['emLite'];
		$emPro          = $pluginUpgrader->pluginSlugs['emPro'];
		$activePlugins  = get_option( 'active_plugins' );

		if (
			in_array( $miLite, $activePlugins, true ) ||
			in_array( $miPro, $activePlugins, true ) ||
			in_array( $emLite, $activePlugins, true ) ||
			in_array( $emPro, $activePlugins, true )
		) {
			return false;
		}

		$googleAnalyticsId = aioseo()->options->webmasterTools->googleAnalytics->id;
		if ( empty( $googleAnalyticsId ) ) {
			return false;
		}

		return ! $this->userIsExcluded();
	}

	/**
	 * Checks if the user is excluded from tracking.
	 *
	 * @since 4.0.0
	 *
	 * @return boolean True if the user is excluded from tracking.
	 */
	public function userIsExcluded() {
		// Check whether we should exclude tracking for specific user roles.
		$excludeUsers = aioseo()->options->webmasterTools->googleAnalytics->excludeUsers;
		if (
			aioseo()->options->webmasterTools->googleAnalytics->advanced &&
			! empty( $excludeUsers ) &&
			is_user_logged_in()
		) {
			$currentUser = wp_get_current_user();
			if ( ! empty( $currentUser ) ) {
				$intersect = array_intersect( $excludeUsers, $currentUser->roles );
				if ( ! empty( $intersect ) ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Get analytics options.
	 *
	 * @since 4.0.0
	 *
	 * @return array An array of options.
	 */
	public function getOptions() {
		$allowLinker       = '';
		$cookieDomain      = '';
		$domain            = '';
		$additionalDomains = '';
		$domainList        = [];
		$advancedOptions   = aioseo()->options->webmasterTools->googleAnalytics->advanced;
		if ( $advancedOptions ) {
			$trackingDomain = aioseo()->options->webmasterTools->googleAnalytics->trackingDomain;
			$cookieDomain   = ! empty( $trackingDomain ) ? aioseo()->helpers->sanitizeDomain( $trackingDomain ) : '';

			if ( aioseo()->options->webmasterTools->googleAnalytics->multipleDomains ) {
				$allowLinker   = '\'allowLinker\': true';
				$optionDomains = aioseo()->options->webmasterTools->googleAnalytics->additionalDomains;
				if ( ! empty( $optionDomains ) ) {
					$additionalDomains = trim( $optionDomains );
					$additionalDomains = preg_split( '/[\s,]+/', $additionalDomains );
					if ( ! empty( $additionalDomains ) ) {
						foreach ( $additionalDomains as $d ) {
							$d = aioseo()->helpers->sanitizeDomain( $d );
							if ( ! empty( $d ) ) {
								$domainList[] = $d;
							}
						}
					}
				}
			}
		}

		if ( ! empty( $cookieDomain ) ) {
			$cookieDomain = esc_js( $cookieDomain );
			$cookieDomain = '\'cookieDomain\': \'' . $cookieDomain . '\'';
		}
		if ( empty( $cookieDomain ) ) {
			$domain = ', \'auto\'';
		}

		$options = [];
		if ( ! empty( $domainList ) ) {
			$options[] = [
				'require',
				'linker'
			];
			$options[] = [
				'linker:autoLink',
				$domainList
			];
		}
		if ( $advancedOptions ) {
			if ( aioseo()->options->webmasterTools->googleAnalytics->displayAdvertiserTracking ) {
				$options[] = [
					'require',
					'displayfeatures'
				];
			}
			if ( aioseo()->options->webmasterTools->googleAnalytics->enhancedEcommerce ) {
				$options[] = [
					'require',
					'ec'
				];
			}
			if ( aioseo()->options->webmasterTools->googleAnalytics->enhancedLinkAttribution ) {
				$options[] = [
					'require',
					'linkid',
					'linkid.js'
				];
			}
			if ( aioseo()->options->webmasterTools->googleAnalytics->anonymizeIp ) {
				$options[] = [
					'set',
					'anonymizeIp',
					true
				];
			}
			if ( aioseo()->options->webmasterTools->googleAnalytics->trackOutboundLinks ) {
				$options[] = [
					'require',
					'outboundLinkTracker'
				];
			}
		}

		$jsOptions = [];
		if ( ! empty( $cookieDomain ) ) {
			$jsOptions[] = $cookieDomain;
		}
		if ( ! empty( $allowLinker ) ) {
			$jsOptions[] = $allowLinker;
		}

		$jsOptions = empty( $jsOptions )
			? ''
			: ', { ' . implode( ',', $jsOptions ) . ' } ';

		return [
			'options'   => $options,
			'domain'    => $domain,
			'jsOptions' => $jsOptions
		];
	}

	/**
	 * Retrieve any attributes needed for the script tag.
	 *
	 * @since 4.0.0
	 *
	 * @return string The attributes as a string.
	 */
	public function getScriptAttributes() {
		return ' ' . trim( preg_replace( '/\s+/', ' ', apply_filters( 'aioseo_ga_attributes', '' ) ) );
	}

	/**
	 * Get the URL for autotrack.js
	 *
	 * @since 4.0.0
	 *
	 * @return string The autotrack.js URL.
	 */
	public function autoTrackUrl() {
		return apply_filters( 'aioseo_google_autotrack', plugin_dir_url( AIOSEO_FILE ) . 'app/Common/Assets/js/autotrack.js' );
	}

	/**
	 * Check if autotrack JS should be included.
	 *
	 * @since 4.0.0
	 *
	 * @return boolean True if so, false if not.
	 */
	public function autoTrack() {
		if ( ! aioseo()->options->webmasterTools->googleAnalytics->advanced ) {
			return false;
		}

		if (
			aioseo()->options->webmasterTools->googleAnalytics->trackOutboundLinks
		) {
			return true;
		}

		return false;
	}
}