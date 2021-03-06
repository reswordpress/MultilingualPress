<?php # -*- coding: utf-8 -*-

namespace Inpsyde\MultilingualPress\Translation\Post\MetaBox\Search;

use Inpsyde\MultilingualPress\Translation\Post\RelationshipContext;

/**
 * Interface for all search implementations.
 *
 * @package Inpsyde\MultilingualPress\Translation\Post\MetaBox\Search
 * @since   3.0.0
 */
interface Search {

	/**
	 * Argument name to be used in order to denote the search in requests.
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	const ARG_NAME = 's';

	/**
	 * Hook name.
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	const FILTER_ARGUMENTS = 'multilingualpress.remote_post_search_arguments';

	/**
	 * Returns the latest/best-matching posts with respect to the given context.
	 *
	 * @since 3.0.0
	 *
	 * @param RelationshipContext $context Relationship context data object.
	 *
	 * @return \WP_Post[] The latest/best-matching posts.
	 */
	public function get_posts( RelationshipContext $context ): array;
}
