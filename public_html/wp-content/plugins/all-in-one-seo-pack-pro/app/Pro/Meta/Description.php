<?php
namespace AIOSEO\Plugin\Pro\Meta;

use \AIOSEO\Plugin\Common\Meta as CommonMeta;

/**
 * Handles the description.
 *
 * @since 4.0.0
 */
class Description extends CommonMeta\Description {
	/**
	 * Returns the description for the current page.
	 *
	 * @since 4.0.0
	 *
	 * @param  WP_Post|WP_Term $post    The post object (optional).
	 * @param  boolean                  $default Whether we want the default value, not the post one.
	 * @return string                            The page description.
	 */
	public function getDescription( $post = null, $default = false ) {
		if ( ! is_category() && ! is_tag() && ! is_tax() ) {
			return parent::getDescription( $post, $default );
		}
		$term = $post ? $post : get_queried_object();
		return $this->getTermDescription( $term, $default );
	}

	/**
	 * Returns the term description.
	 *
	 * @since 4.0.0
	 *
	 * @param  WP_Term $term    The term object.
	 * @param  boolean $default Whether we want the default value, not the post one.
	 * @return string           The term description.
	 */
	public function getTermDescription( $term, $default = false ) {
		$metaData = aioseo()->meta->metaData->getMetaData( $term );

		$description = '';
		if ( ! empty( $metaData->description ) && ! $default ) {
			$description = $this->prepareDescription( $metaData->description );
		}

		if (
			! $description &&
			in_array( 'autogenerateDescriptions', aioseo()->internalOptions->deprecatedOptions, true ) &&
			! aioseo()->options->deprecated->searchAppearance->advanced->autogenerateDescriptions
		) {
			return $description;
		}

		$options = aioseo()->options->noConflict();
		if ( ! $description && $options->searchAppearance->dynamic->taxonomies->has( $term->taxonomy ) ) {
			$description = $this->prepareDescription( aioseo()->options->searchAppearance->dynamic->taxonomies->{$term->taxonomy}->metaDescription, false, $default );
		}
		return $description ? $description : $this->prepareDescription( wp_strip_all_tags( term_description( $term->term_id ) ), false, $default );
	}
}