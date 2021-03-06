<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Cache\Pool;

use Inpsyde\MultilingualPress\Cache\Driver\CacheDriver;
use Inpsyde\MultilingualPress\Cache\Item\CacheItem;
use Inpsyde\MultilingualPress\Cache\Item\WPCacheItem;

/**
 * @package Inpsyde\MultilingualPress\Cache\Pool
 * @since   3.0.0
 */
final class WPCachePool implements CachePool {

	/**
	 * @var string
	 */
	private $namespace;

	/**
	 * @var CacheDriver
	 */
	private $driver;

	/**
	 * @var CacheItem[]
	 */
	private $items = [];

	/**
	 * @param string      $namespace Cache pool namespace.
	 * @param CacheDriver $driver    Cache pool driver.
	 */
	public function __construct( string $namespace, CacheDriver $driver ) {

		$this->namespace = $namespace;

		$this->driver = $driver;
	}

	/**
	 * Return pool namespace.
	 *
	 * @return string
	 */
	public function namespace(): string {

		return $this->namespace;
	}

	/**
	 * Check if the cache pool is for network.
	 *
	 * @return bool
	 */
	public function is_network(): bool {

		return $this->driver->is_network();
	}

	/**
	 * Fetches a value from the cache.
	 *
	 * @param string $key The unique key of item in the cache.
	 *
	 * @return CacheItem The cache item identified by given key.
	 */
	public function item( string $key ): CacheItem {

		if ( ! array_key_exists( $key, $this->items ) ) {
			$this->items[ $key ] = new WPCacheItem( $this->driver, $this->namespace . $key );
		}

		return $this->items[ $key ];
	}

	/**
	 * Fetches a value from the cache.
	 *
	 * The difference between `$pool->get($key)` and `$pool->item($key)->value()` is that the latter could return
	 * a cached value even if expired, and it is responsibility of the caller check for that if necessary.
	 * Moreover, `get()` also has a default param that is returned in case cache is a miss or is expired.
	 *
	 * @param string     $key     The unique key of item in the cache.
	 * @param mixed|null $default Default value to return if the key does not exist.
	 *
	 * @return mixed The value of the item from the cache, or $default in case of cache miss.
	 */
	public function get( string $key, $default = null ) {

		$item = $this->item( $key );

		if ( ! $item->is_hit() || $item->is_expired() ) {
			return $default;
		}

		return $item->value();
	}

	/**
	 * Fetches a value from the cache.
	 *
	 * The "bulk" version of `get()`.
	 *
	 * @param string[]   $keys    The unique keys of item in the cache.
	 * @param mixed|null $default Default value to assign to each item if the key does not exist.
	 *
	 * @return array The value of the item from the cache, or $default in case of cache miss.
	 */
	public function get_many( array $keys, $default = null ): array {

		$values = [];
		foreach ( $keys as $key ) {
			$values[ $key ] = $this->get( $key, $default );
		}

		return $values;
	}

	/**
	 * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
	 *
	 * @param string   $key   The key of the item to store.
	 * @param mixed    $value Optional. The value of the item to store, must be serializable. Defaults to null.
	 * @param null|int $ttl   Optional. The TTL value of item.
	 *
	 * @return CacheItem The cache item just wrote to
	 */
	public function set( string $key, $value = null, int $ttl = null ): CacheItem {

		$item = $this->item( $key );
		if ( null !== $ttl ) {
			$item->live_for( $ttl );
		}
		$item->set( $value );

		return $item;
	}

	/**
	 * Delete an item from the cache by its unique key.
	 *
	 * @param string $key The unique cache key of the item to delete.
	 *
	 * @return bool True if the item was successfully removed. False if there was an error.
	 */
	public function delete( string $key ): bool {

		if ( $this->item( $key )->delete() ) {
			unset( $this->items[ $key ] );

			return true;
		}

		return false;
	}

	/**
	 * Determines whether an item is present in the cache.
	 *
	 * A true outcome does not provide warranty the value is not expired.
	 *
	 * @param string $key The cache item key.
	 *
	 * @return bool
	 */
	public function has( string $key ): bool {

		return $this->item( $key )->is_hit();
	}
}
