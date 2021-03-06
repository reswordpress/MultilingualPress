<?php # -*- coding: utf-8 -*-

declare( strict_types = 1 );

namespace Inpsyde\MultilingualPress\Module\Exception;

/**
 * Exception to be thrown when a module that does not exist is to be manipulated.
 *
 * @package Inpsyde\MultilingualPress\Module\Exception
 * @since   3.0.0
 */
class InvalidModule extends \Exception {

	/**
	 * Returns a new exception object.
	 *
	 * @since 3.0.0
	 *
	 * @param string $id     Module ID.
	 * @param string $action Optional. Action to be performed. Defaults to 'read'.
	 *
	 * @return InvalidModule Exception object.
	 */
	public static function for_id( string $id, string $action = 'read' ): InvalidModule {

		return new static( sprintf(
			'Cannot %2$s "%1$s". There is no module with this ID.',
			$id,
			$action
		) );
	}
}
