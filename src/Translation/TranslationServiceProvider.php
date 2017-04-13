<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Translation;

use Inpsyde\MultilingualPress\Common\WordPressRequestContext;
use Inpsyde\MultilingualPress\Service\BootstrappableServiceProvider;
use Inpsyde\MultilingualPress\Service\Container;
use Inpsyde\MultilingualPress\Translation\Post\AllowedPostTypes;
use Inpsyde\MultilingualPress\Translation\Post\MetaBox\UI\AdvancedPostTranslator;
use Inpsyde\MultilingualPress\Translation\Post\MetaBox\UI\SimplePostTranslator;
use Inpsyde\MultilingualPress\Translation\Post\MetaBoxFactory;
use Inpsyde\MultilingualPress\Translation\Post\PostMetaBoxRegistrar;
use Inpsyde\MultilingualPress\Translation\Translator\FrontPageTranslator;
use Inpsyde\MultilingualPress\Translation\Translator\PostTranslator;
use Inpsyde\MultilingualPress\Translation\Translator\PostTypeTranslator;
use Inpsyde\MultilingualPress\Translation\Translator\SearchTranslator;
use Inpsyde\MultilingualPress\Translation\Translator\TermTranslator;

/**
 * Service provider for all translation objects.
 *
 * @package Inpsyde\MultilingualPress\Translation
 * @since   3.0.0
 */
final class TranslationServiceProvider implements BootstrappableServiceProvider {

	/**
	 * Registers the provided services on the given container.
	 *
	 * @since 3.0.0
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	public function register( Container $container ) {

		$this->register_post_translation( $container );

		$this->register_term_translation( $container );

		$this->register_translators( $container );
	}

	/**
	 * Bootstraps the registered services.
	 *
	 * @since 3.0.0
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	public function bootstrap( Container $container ) {

		$this->bootstrap_post_translation( $container );

		$this->bootstrap_term_translation( $container );

		$this->bootstrap_translators( $container );
	}

	/**
	 * Registers the post translation services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function register_post_translation( Container $container ) {

		$container['multilingualpress.allowed_post_types'] = function () {

			return new AllowedPostTypes();
		};

		$container['multilingualpress.post_meta_box_factory'] = function ( Container $container ) {

			return new MetaBoxFactory(
				$container['multilingualpress.site_relations'],
				$container['multilingualpress.content_relations'],
				$container['multilingualpress.allowed_post_types']
			);
		};

		$container['multilingualpress.post_metabox_registrar'] = function ( Container $container ) {

			return new PostMetaBoxRegistrar(
				$container['multilingualpress.post_meta_box_factory'],
				$container['multilingualpress.relationship_permission'],
				$container['multilingualpress.server_request'],
				$container['multilingualpress.nonce_factory']
			);
		};
	}

	/**
	 * Registers the term translation services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function register_term_translation( Container $container ) {

		// TODO
	}

	/**
	 * Registers the translator services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function register_translators( Container $container ) {

		$container['multilingualpress.front_page_translator'] = function ( Container $container ) {

			return new FrontPageTranslator(
				$container['multilingualpress.type_factory']
			);
		};

		$container['multilingualpress.post_translator'] = function ( Container $container ) {

			return new PostTranslator(
				$container['multilingualpress.type_factory']
			);
		};

		$container['multilingualpress.post_type_translator'] = function ( Container $container ) {

			return new PostTypeTranslator(
				$container['multilingualpress.type_factory']
			);
		};

		$container['multilingualpress.search_translator'] = function ( Container $container ) {

			return new SearchTranslator(
				$container['multilingualpress.type_factory']
			);
		};

		$container['multilingualpress.term_translator'] = function ( Container $container ) {

			return new TermTranslator(
				$container['multilingualpress.type_factory'],
				$container['multilingualpress.wpdb']
			);
		};
	}

	/**
	 * Bootstraps all post translation services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function bootstrap_post_translation( Container $container ) {

		$box_registrar = $container['multilingualpress.post_metabox_registrar'];

		$ui_registry = $container['multilingualpress.metabox_ui_registry'];

		$ui_registry->register_ui(
			new AdvancedPostTranslator(
				$container['multilingualpress.content_relations'],
				$container['multilingualpress.asset_manager'],
				$container['multilingualpress.server_request']
			),
			$box_registrar
		);

		$ui_registry->register_ui( new SimplePostTranslator(), $box_registrar );

		add_action( 'admin_init', function () use ( $ui_registry, $box_registrar ) {

			$box_registrar->register_meta_boxes();
		}, 0 );

		add_action( PostMetaBoxRegistrar::ACTION_INIT_META_BOXES, function () use ( $ui_registry, $box_registrar ) {

			$box_registrar->with_ui( $ui_registry->selected_ui( $box_registrar ) );
		}, 0 );

		if ( 'POST' === $container['multilingualpress.server_request']->server_value( 'REQUEST_METHOD' ) ) {
			$request_globals_manipulator = $container['multilingualpress.request_globals_manipulator'];

			add_action( 'mlp_before_post_synchronization', [ $request_globals_manipulator, 'clear_data' ] );
			add_action( 'mlp_after_post_synchronization', [ $request_globals_manipulator, 'restore_data' ] );
		}
	}

	/**
	 * Bootstraps all term translation services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function bootstrap_term_translation( Container $container ) {

		if ( 'POST' === $container['multilingualpress.server_request']->server_value( 'REQUEST_METHOD' ) ) {
			$request_globals_manipulator = $container['multilingualpress.request_globals_manipulator'];

			add_action( 'mlp_before_term_synchronization', [ $request_globals_manipulator, 'clear_data' ] );
			add_action( 'mlp_after_term_synchronization', [ $request_globals_manipulator, 'restore_data' ] );
		}
	}

	/**
	 * Bootstraps the translator services.
	 *
	 * @param Container $container Container object.
	 *
	 * @return void
	 */
	private function bootstrap_translators( Container $container ) {

		$translations = $container['multilingualpress.translations'];

		$translations->register_translator(
			$container['multilingualpress.front_page_translator'],
			WordPressRequestContext::TYPE_FRONT_PAGE
		);

		$translations->register_translator(
			$container['multilingualpress.post_translator'],
			WordPressRequestContext::TYPE_SINGULAR
		);

		$translations->register_translator(
			$container['multilingualpress.post_type_translator'],
			WordPressRequestContext::TYPE_POST_TYPE_ARCHIVE
		);

		$translations->register_translator(
			$container['multilingualpress.search_translator'],
			WordPressRequestContext::TYPE_SEARCH
		);

		$translations->register_translator(
			$container['multilingualpress.term_translator'],
			WordPressRequestContext::TYPE_TERM_ARCHIVE
		);
	}
}
