<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Cache;

use Inpsyde\MultilingualPress\Cache\Driver\WPObjectCacheDriver;
use Inpsyde\MultilingualPress\Cache\Server\Server;
use Inpsyde\MultilingualPress\Service\BootstrappableServiceProvider;
use Inpsyde\MultilingualPress\Service\Container;

/**
 * Service provider for all cache objects.
 *
 * @package Inpsyde\MultilingualPress\Cache
 * @since   3.0.0
 */
final class CacheServiceProvider implements BootstrappableServiceProvider {

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

		$container->share( 'multilingualpress.cache_factory', function ( Container $container ) {

			return new CacheFactory( sprintf( 'mlp_%s_', $container['multilingualpress.properties']->version() ) );
		} );

		$container->share( 'multilingualpress.cache_server', function ( Container $container ) {

			return new Server(
				$container['multilingualpress.cache_factory'],
				$container['multilingualpress.cache_server_driver'],
				$container['multilingualpress.cache_server_network_driver']
			);
		} );

		$container->share( 'multilingualpress.cache_server_driver', function () {

			return new WPObjectCacheDriver();
		} );

		$container->share( 'multilingualpress.cache_server_network_driver', function () {

			return new WPObjectCacheDriver( WPObjectCacheDriver::FOR_NETWORK );
		} );
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

		$container['multilingualpress.cache_server']->listen_spawn();
	}
}
