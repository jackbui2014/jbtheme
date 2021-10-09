<?php
/**
 * Load dynamic blocks for server-side rendering 
 */
if(!defined('ABSPATH')) {
    exit;
}
require_once dirname(__FILE__) . '/autoloader.php';
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
require_once dirname(__FILE__) . '/class-jb-customizer.php';
require_once dirname(__FILE__) . '/widgets.php';
require_once dirname(__FILE__) . '/modules/index.php';
foreach( glob(dirname(dirname(__FILE__)).'/src/gutenberg/*/index.php') as $block_logic){
    include_once $block_logic;
}
