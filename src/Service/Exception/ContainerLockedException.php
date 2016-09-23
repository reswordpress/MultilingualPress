<?php # -*- coding: utf-8 -*-

namespace Inpsyde\MultilingualPress\Service\Exception;

use Exception;

/**
 * Exception to be thrown when a locked container is to be manipulated.
 *
 * @package Inpsyde\MultilingualPress\Service\Exception
 * @since   3.0.0
 */
class ContainerLockedException extends Exception {

	/**
	 * Returns a new exception object.
	 *
	 * @since 3.0.0
	 *
	 * @param string $name   The name of the value or factory callback.
	 * @param string $action Optional. Action to be perfomed. Defaults to 'set'.
	 *
	 * @return static Exception object.
	 */
	public static function for_name( $name, $action = 'set' ) {

		return new static( sprintf(
			'Cannot %2$s "%1$s". Manipulating a locked container is not allowed.',
			$name,
			trim( $action )
		) );
	}
}
