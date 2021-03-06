<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Translation\Post;

use Inpsyde\MultilingualPress\API\ContentRelations;

use function Inpsyde\MultilingualPress\site_exists;

/**
 * Permission checker to be used to either permit or prevent access to posts.
 *
 * @package Inpsyde\MultilingualPress\Translation\Post
 * @since   3.0.0
 */
class RelationshipPermission {

	/**
	 * @var ContentRelations
	 */
	private $content_relations;

	/**
	 * @var int[][]
	 */
	private $related_posts = [];

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 3.0.0
	 *
	 * @param ContentRelations $content_relations Content relations API object.
	 */
	public function __construct( ContentRelations $content_relations ) {

		$this->content_relations = $content_relations;
	}

	/**
	 * Checks if the current user can edit (or create) a post in the site with the given ID that is related to given
	 * post in the current site.
	 *
	 * @since 3.0.0
	 *
	 * @param \WP_Post $post            Post object in the current site.
	 * @param int      $related_site_id Related site ID.
	 *
	 * @return bool Whether or not the related post of the given post in the given site is editable.
	 */
	public function is_related_post_editable( \WP_Post $post, int $related_site_id ): bool {

		if ( ! site_exists( $related_site_id ) ) {
			return false;
		}

		$post_type = get_post_type_object( $post->post_type );
		if ( ! $post_type instanceof \WP_Post_Type ) {
			return false;
		}

		$related_post_id = $this->get_related_post_id( $post, $related_site_id );
		if ( $related_post_id ) {
			return current_user_can_for_blog( $related_site_id, $post_type->cap->edit_post, $related_post_id );
		}

		return current_user_can_for_blog( $related_site_id, $post_type->cap->edit_others_posts );
	}

	/**
	 * Returns the ID of the post in the site with the given ID that is related to given post in the current site.
	 *
	 * @param \WP_Post $post            Post object in the current site.
	 * @param int      $related_site_id Related site ID.
	 *
	 * @return int Post ID, or 0.
	 */
	private function get_related_post_id( \WP_Post $post, int $related_site_id ): int {

		$related_posts = $this->get_related_posts( (int) $post->ID );
		if ( empty( $related_posts[ $related_site_id ] ) ) {
			return 0;
		}

		// This is just to be extra careful in case the post has been deleted via MySQL etc.
		$related_post = get_blog_post( $related_site_id, $related_posts[ $related_site_id ] );

		return $related_post ? (int) $related_post->ID : 0;
	}

	/**
	 * Returns an array with the IDs of all related posts for the post with the given ID.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return int[] The array with site IDs as keys and post IDs as values.
	 */
	private function get_related_posts( int $post_id ): array {

		if ( array_key_exists( $post_id, $this->related_posts ) ) {
			return $this->related_posts[ $post_id ];
		}

		$this->related_posts[ $post_id ] = $this->content_relations->get_relations(
			get_current_blog_id(),
			$post_id,
			ContentRelations::CONTENT_TYPE_POST
		);

		return $this->related_posts[ $post_id ];
	}
}
