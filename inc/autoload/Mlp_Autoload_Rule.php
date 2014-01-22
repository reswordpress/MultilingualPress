<?php # -*- coding: utf-8 -*-
/**
 * Specialized auto-load rule for Mlp_Autoload.
 *
 * @author     toscho
 * @since      2013.08.18
 * @version    2013.08.22
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package    MultilingualPress
 * @subpackage Autoload
 */
class Mlp_Autoload_Rule implements Inpsyde_Autoload_Rule_Interface
{
	/**
	 * Path to Inpsyde Suite directory.
	 *
	 * @type string
	 */
	protected $dir;

	/**
	 * Constructor
	 *
	 * @param string $pattern
	 */
	public function __construct( $dir ) {
		$this->dir = $dir;
	}

	/**
	 * Parse class/trait/interface name and load file.
	 *
	 * @param  string $name
	 * @return boolean
	 */
	public function load( $name ) {
		if ( ! $name = $this->prepare_name( $name ) )
			return;

		foreach ( array ( 'core', 'pro' ) as $main_dir ) {

			if ( ! is_dir( "$this->dir/$main_dir" ) )
				continue;

			foreach ( array ( 'controllers', 'models', 'views' ) as $sub_dir ) {

				if ( ! is_dir( "$this->dir/$main_dir/$sub_dir" ) )
					continue;

				$file = "$this->dir/$main_dir/$sub_dir/$name.php";

				if ( file_exists( $file ) ) {
					include $file;
					return;
				}
				//'Mlp_Auto_Update' == $name && print $file . '<br>';
			}
		}
	}

	/**
	 * Check for namespaces and matching file name.
	 *
	 * @param  string $name   The class/interface name.
	 * @return string|boolean The class name or FALSE
	 */
	protected function prepare_name( $name ) {

		$name = trim( $name, '\\' );

		// Our classes are not in a dedicated namespace (yet).
		if ( FALSE !== strpos( $name, '\\' ) )
			return FALSE;

		// Our classes start with "Mlp_" always.
		if ( 0 !== strpos( $name, 'Mlp_' ) && 0 !== strpos( $name, 'Inpsyde_' ) )
			return FALSE;

		return $name;
	}
}