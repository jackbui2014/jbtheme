<?php
spl_autoload_register(
	function( $classname ) {

		// Regular
		$class     = str_replace( '\\', DIRECTORY_SEPARATOR, strtolower( $classname ) );
		$classpath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_ireplace( '_', '-', $class ) . '.php';

		// WordPress
		$parts   = explode( '\\', $classname );
		$class   = 'class-' . str_ireplace( '_', '-', strtolower( array_pop( $parts ) ) );
		$folders = strtolower( implode( DIRECTORY_SEPARATOR, $parts ) );
		$wppath  = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $folders . DIRECTORY_SEPARATOR . $class . '.php';

		if ( file_exists( $classpath ) ) {
			  include_once $classpath;
		} elseif ( file_exists( $wppath ) ) {
			include_once $wppath;
		}

	}
);