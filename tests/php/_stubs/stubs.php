<?php # -*- coding: utf-8 -*-

defined( 'HOUR_IN_SECONDS' ) || define( 'HOUR_IN_SECONDS', 3600 );

if ( ! class_exists( WP_Widget::class ) ) {
	class WP_Widget {

	}
}

if ( ! class_exists( Requests::class ) ) {
	class Requests {

		const HEAD = 'HEAD';

		public static $static_calls = [];

		public static function __callStatic( $name, array $args = [] ) {

			if ( empty( self::$static_calls[ $name ] ) ) {
				self::$static_calls[ $name ] = [];
			}

			self::$static_calls[ $name ][] = $args;
		}
	}
}

