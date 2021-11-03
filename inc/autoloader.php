<?php
/**
 *
 * The autoload function
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

if ( ! function_exists( 'jb_auto_load' ) ) {
	/**
	 *
	 * The autoload function
	 *
	 * @param string $classname is the name of class to be load.
	 *
	 * @package JB
	 * @subpackage jbapp
	 * @since 1.0
	 */
	function jb_auto_load( $classname = '' ) {
		// Regular.
		$class     = str_replace( '\\', DIRECTORY_SEPARATOR, strtolower( $classname ) );
		$classpath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_ireplace( '_', '-', $class ) . '.php';

		// WordPress.
		$parts   = explode( '\\', $classname );
		$class   = 'class-' . str_ireplace( '_', '-', strtolower( array_pop( $parts ) ) );
		$folders = strtolower( implode( DIRECTORY_SEPARATOR, $parts ) );
		$wppath  = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $folders . DIRECTORY_SEPARATOR . $class . '.php';

		if ( file_exists( $classpath ) ) {
			get_template_part( $classpath );
		} elseif ( file_exists( $wppath ) ) {
			get_template_part( $wppath );
		}

	}
}
spl_autoload_register( 'jb_auto_load' );
