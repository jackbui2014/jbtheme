<?php
/**
 * The indes file of all
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once dirname( __FILE__ ) . '/autoloader.php';
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/sanitization-callbacks.php';
require_once dirname( __FILE__ ) . '/class-jb-customizer.php';
require_once dirname( __FILE__ ) . '/class-jb-social-widget.php';
require_once dirname( __FILE__ ) . '/widgets.php';
require_once dirname( __FILE__ ) . '/modules/metabox/class-jb-settings.php';
require_once dirname( __FILE__ ) . '/modules/metabox/class-jb-metabox.php';

