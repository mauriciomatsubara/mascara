<?php
namespace AIOSEO\Plugin\Pro\Api;

use AIOSEO\Plugin\Common\Api as CommonApi;
use AIOSEO\Plugin\Pro\Models;

/**
 * Route class for the API.
 *
 * @since 4.0.0
 */
class Settings extends CommonApi\Settings {
	/**
	 * Imports settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function importSettings( $request ) {
		$response = parent::importSettings( $request );
		$file     = $request->get_file_params()['file'];
		$wpfs     = aioseo()->helpers->wpfs();
		$contents = $wpfs->get_contents( $file['tmp_name'] );
		if ( ! empty( $file['type'] ) && 'application/json' === $file['type'] ) {
			// Since this could be any file, we need to pretend like every variable here is missing.
			$contents = json_decode( $contents, true );
			if ( empty( $contents ) ) {
				return new \WP_REST_Response( [
					'success' => false
				], 400 );
			}

			if ( ! empty( $contents['postOptions'] ) ) {
				foreach ( $contents['postOptions'] as $postType => $postData ) {
					// Terms.
					if ( ! empty( $postData['terms'] ) ) {
						foreach ( $postData['terms'] as $term ) {
							unset( $term['id'] );
							$theTerm = Models\Term::getTerm( $term['term_id'] );
							$theTerm->set( $term );
							$theTerm->save();
						}
					}
				}
			}
		}

		$response->data['license'] = [
			'isActive'   => aioseo()->license->isActive(),
			'isExpired'  => aioseo()->license->isExpired(),
			'isDisabled' => aioseo()->license->isDisabled(),
			'isInvalid'  => aioseo()->license->isInvalid(),
			'expires'    => aioseo()->internalOptions->internal->license->expires
		];

		return $response;
	}
}