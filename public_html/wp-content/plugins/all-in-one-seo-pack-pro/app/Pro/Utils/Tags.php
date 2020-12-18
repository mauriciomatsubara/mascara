<?php
namespace AIOSEO\Plugin\Pro\Utils;

use AIOSEO\Plugin\Common\Utils;

/**
 * Class to replace tag values with their data counterparts.
 *
 * @since 4.0.0
 */
class Tags extends Utils\Tags {
	/**
	 * An array of contexts to separate tags.
	 *
	 * @since 4.0.0
	 *
	 * @var array
	 */
	private $proContext = [];

	/**
	 * Add the context for all the post/page types.
	 *
	 * @since 4.0.0
	 *
	 * @return array An array of contextual data.
	 */
	public function getContext() {
		$context = parent::getContext() + $this->proContext;

		// Taxonomies including from CPT's.
		foreach ( aioseo()->helpers->getPublicTaxonomies() as $taxonomy ) {
			if ( 'category' === $taxonomy['name'] ) {
				continue;
			}

			$context[ $taxonomy['name'] . 'Title' ]       = $context['taxonomyTitle'];
			$context[ $taxonomy['name'] . 'Description' ] = $context['taxonomyDescription'];
		}

		return $context;
	}

	/**
	 * Get the default tags for the current term.
	 *
	 * @since 4.0.0
	 *
	 * @param  integer $termId The Term ID.
	 * @return array           An array of tags.
	 */
	public function getDefaultTermTags( $termId ) {
		$term = get_term( $termId );
		return [
			'title'       => aioseo()->meta->title->getTermTitle( $term, true ),
			'description' => aioseo()->meta->description->getTermDescription( $term, true )
		];
	}
}