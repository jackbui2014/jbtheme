<?php
/**
 * Load dynamic blocks for server-side rendering 
 *
 */
if( !defined('ABSPATH')){
	exit;
}
foreach( glob( dirname( dirname(__FILE__) ).'/src/gutenberg/*/index.php') as $block_logic){
	require_once $block_logic;
}
