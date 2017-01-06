<?php # -*- coding: utf-8 -*-

namespace Inpsyde\MultilingualPress;

use BadMethodCallException;
use Inpsyde\MultilingualPress\Common\Admin\SitesListTableColumn;
use Inpsyde\MultilingualPress\Installation\SystemChecker;
use Inpsyde\MultilingualPress\Module\ActivationAwareModuleServiceProvider;
use Inpsyde\MultilingualPress\Module\ModuleServiceProvider;
use Inpsyde\MultilingualPress\Service\BootstrappableServiceProvider;
use Inpsyde\MultilingualPress\Service\Container;
use Inpsyde\MultilingualPress\Service\ServiceProvider;

/**
 * MultilingualPress front controller.
 *
 * @package Inpsyde\MultilingualPress
 * @since   3.0.0
 */
final class MultilingualPress {

	/**
	 * @var Container
	 */
	private static $container;

	/**
	 * @var BootstrappableServiceProvider[]
	 */
	private $bootstrappables = [];

	/**
	 * @var bool
	 */
	private $is_bootstrapped = false;

	/**
	 * @var ModuleServiceProvider[]
	 */
	private $modules = [];

	/**@todo Migrate from old 'mlp_version' option.
	 * @var string
	 */
	private $version_option = 'multilingualpress_version';

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 3.0.0
	 *
	 * @param Container $container Container object.
	 */
	public function __construct( Container $container ) {

		if ( ! static::$container ) {
			static::$container = $container;
		}
	}

	/**
	 * Resolve a shared value or factory callback from the container.
	 *
	 * @since 3.0.0
	 *
	 * @param string $name The name of a value or factory callback.
	 *
	 * @return mixed The value or factory callback.
	 *
	 * @throws BadMethodCallException if called too early.
	 */
	public static function resolve( $name ) {

		if ( ! static::$container instanceof Container ) {
			throw new BadMethodCallException( sprintf(
				'Cannot resolve "%s". MultilingualPress has not yet been initialised.',
				$name
			) );
		}

		return static::$container[ $name ];
	}

	/**
	 * Registers the given service provider.
	 *
	 * @since 3.0.0
	 *
	 * @param ServiceProvider $provider Service provider object.
	 *
	 * @return static MultilingualPress instance.
	 */
	public function register_service_provider( ServiceProvider $provider ) {

		$provider->register( static::$container );

		if ( $provider instanceof BootstrappableServiceProvider ) {
			$this->bootstrappables[] = $provider;

			if ( $provider instanceof ModuleServiceProvider ) {
				$this->modules[] = $provider;
			}
		}

		return $this;
	}

	/**
	 * Bootstraps MultilingualPress.
	 *
	 * @since 3.0.0
	 *
	 * @return bool Whether or not MultilingualPress was bootstrapped successfully.
	 *
	 * @throws BadMethodCallException if called on a MultilingualPress instance that has already been bootstrapped.
	 */
	public function bootstrap() {

		if ( $this->is_bootstrapped ) {
			throw new BadMethodCallException(
				'Cannot bootstrap a MultilingualPress instance that has already been bootstrapped.'
			);
		}

		/**
		 * Fires right before MultilingualPress gets bootstrapped.
		 *
		 * Hook here to register custom service providers.
		 *
		 * @since 3.0.0
		 *
		 * @param static $multilingualpress MultilingualPress instance.
		 */
		do_action( 'multilingualpress.bootstrap', $this );

		static::$container->lock();

		// TODO: Eventually remove the following block.
		class_exists( 'Mlp_Load_Controller' ) or require __DIR__ . '/inc/autoload/Mlp_Load_Controller.php';
		new \Mlp_Load_Controller( static::$container['multilingualpress.properties']->plugin_dir_path() . '/src/inc' );

		if ( ! $this->check_installation() ) {
			return false;
		}

		$this->bootstrap_service_providers();

		$needs_modules = $this->needs_modules();
		if ( $needs_modules ) {
			/**
			 * Fires right before MultilingualPress registers any modules.
			 *
			 * @since 3.0.0
			 */
			do_action( 'multilingualpress.register_modules' );

			$this->register_modules();
		}

		unset( $this->modules );

		static::$container->bootstrap();

		$this->is_bootstrapped = true;

		// TODO: Eventually remove/refactor according to new architecure as soon as the old controller got replaced.
		class_exists( 'Multilingual_Press' ) or require __DIR__ . '/inc/Multilingual_Press.php';
		$old_controller = new \Multilingual_Press( static::$container );
		$old_controller->prepare_plugin_data();

		if ( $needs_modules ) {
			load_plugin_textdomain( 'multilingual-press' );

			if ( is_admin() ) {
				$this->bootstrap_admin();
			} else {
				$this->bootstrap_front_end();
			}

			// TODO: Refactor according to new architecure.
			$old_controller->setup();
		}

		return true;
	}

	/**
	 * Checks (and adapts) the current MultilingualPress installation.
	 *
	 * @return bool Whether or not MultilingualPress is installed properly.
	 */
	private function check_installation() {

		$system_checker = static::$container['multilingualpress.system_checker'];

		$installation_check = $system_checker->check_installation();

		if ( SystemChecker::PLUGIN_DEACTIVATED === $installation_check ) {
			return false;
		}

		if ( SystemChecker::INSTALLATION_OK === $installation_check ) {
			$type_factory = static::$container['multilingualpress.type_factory'];

			$installed_version = $type_factory->create_version_number( [
				get_network_option( null, $this->version_option ),
			] );

			$current_version = $type_factory->create_version_number( [
				static::$container['multilingualpress.properties']->version(),
			] );

			switch ( $system_checker->check_version( $installed_version, $current_version ) ) {
				case SystemChecker::INSTALLATION_OK:
					return true;

				case SystemChecker::NEEDS_INSTALLATION:
					static::$container['multilingualpress.installer']->install();
					break;

				case SystemChecker::NEEDS_UPGRADE:
					static::$container['multilingualpress.network_plugin_deactivator']->deactivate_plugins( [
						'disable-acf.php',
						'mlp-wp-seo-compat.php',
					] );

					static::$container['multilingualpress.updater']->update( $installed_version );
					break;
			}

			update_network_option( null, $this->version_option, $current_version );
		}

		return true;
	}

	/**
	 * Bootstraps all registered bootstrappable service providers.
	 *
	 * @return void
	 */
	private function bootstrap_service_providers() {

		array_walk( $this->bootstrappables, function ( BootstrappableServiceProvider $provider ) {

			$provider->bootstrap( static::$container );
		} );

		unset( $this->bootstrappables );
	}

	/**
	 * Checks if the current request needs MultilingualPress to register any modules.
	 *
	 * @return bool Whether or not MultilingualPress should register any modules.
	 */
	private function needs_modules() {

		if ( is_network_admin() || in_array( $GLOBALS['pagenow'], [ 'admin-ajax.php', 'admin-post.php' ], true ) ) {
			return true;
		}

		return array_key_exists(
			get_current_blog_id(),
			// TODO: Don't hardcode the option, and also maybe even check some other way.
			(array) get_network_option( null, 'inpsyde_multilingual', [] )
		);
	}

	/**
	 * Registers all modules.
	 *
	 * @return void
	 */
	private function register_modules() {

		$module_manager = static::$container['multilingualpress.module_manager'];

		array_walk(
			$this->modules,
			function ( ModuleServiceProvider $provider ) use ( $module_manager ) {

				if (
					$provider->register_module( $module_manager )
					&& $provider instanceof ActivationAwareModuleServiceProvider
				) {

					$provider->activate();
				}
			}
		);
	}

	/**
	 * Wires up all admin-specific things.
	 *
	 * @return void
	 */
	private function bootstrap_admin() {

		global $pagenow;

		if ( 'sites.php' === $pagenow ) {
			$this->register_sites_list_table_columns();
		}
	}

	/**
	 * Registers columns for the list table on the Sites page in the Network Admin.
	 *
	 * @return void
	 */
	private function register_sites_list_table_columns() {

		( new SitesListTableColumn(
			'multilingualpress.relationships',
			__( 'Relationships', 'multilingual-press' ),
			function ( $id, $site_id ) {

				switch_to_blog( $site_id );
				$sites = \Inpsyde\MultilingualPress\get_available_language_names();
				restore_current_blog();
				unset( $sites[ $site_id ] );

				return $sites
					? '<div class="mlp_interlinked_blogs">' . join( '<br>', array_map( 'esc_html', $sites ) ) . '</div>'
					: __( 'none', 'multilingual-press' );
			}
		) )->register();

		( new SitesListTableColumn(
			'multilingualpress.site_language',
			__( 'Site Language', 'multilingual-press' ),
			function ( $id, $site_id ) {

				$language = \Inpsyde\MultilingualPress\get_site_language( $site_id );

				return '' === $language
					? __( 'none', 'multilingual-press' )
					: sprintf(
						'<div class="mlp_site_language">%s</div>',
						esc_html( \Inpsyde\MultilingualPress\get_language_by_http_name(
							str_replace( '_', '-', $language )
						) )
					);
			}
		) )->register();
	}

	/**
	 * Wires up all front-end-specific things.
	 *
	 * @return void
	 */
	private function bootstrap_front_end() {

		// TODO: Move parts from the old controller to here.
	}
}