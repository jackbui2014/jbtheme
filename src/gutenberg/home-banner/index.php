<?php
/**
 *
 * Render dynamic home banner block
 *
 *
 * @package JB
 * @subpackage jb-wp-react
 * @since 1.0
 */
if ( !function_exists('home_banner_render_block') ){

	/**
	 *
	 * Render home banner block.
	 *
	 * @since 1.0
	 *
	 *
	 * @param Array $attributes 
	 * @param String $content
	 * @return String block content
	 */
	function home_banner_render_block($attributes, $content ){
		$bg = '';
		if( !empty($attributes['background_url']) ):
			$bg = 'style="background-image:url(\'' . $attributes['background_url'] . '\');"';
		endif;
		@ob_start(); ?>
		<div class="home-banner" <?php echo $bg; ?>>
			alsdfjladf
			adfajdflasfd
			lajfd
		</div>	
	<?php 
		return ob_get_clean();
	}
}

if( !function_exists('home_banner_register_block') ){

	/**
	 *
	 *Register action after all plugins have loaded
	 */
	function home_banner_register_block(){
		if( function_exists('register_block_type') ){
			register_block_type(
				'jbgutenberg/home-banner',
				array(
					'render_callback'=>'home_banner_render_block'
				)
			);
		}
	}
}
add_action('init', 'home_banner_register_block');