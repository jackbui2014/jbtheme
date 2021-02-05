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
			$bg = 'style="background-image:url(\'' . $attributes['background_url'] . '\'); background-repeat: no-repeat; background-size: cover; background-position: center;"';
		endif;
		ob_start(); ?>
		<section class="home-banner" <?php echo $bg; ?>>
			<?php if( !empty($attributes['video_url'])): ?>
			<div class="home-banner-video">
				<iframe allow="autoplay; fullscreen" src="<?php echo $attributes['video_url'];?>?loop=1&autoplay=1&muted&title=0&byline=0portrait=0" id="iframe-video" data-ready="true"></iframe>
			</div>
			<?php endif; ?>
			<div class="home-banner-overlay"></div>
			<div class="container home-banner-wrapper">
				<div class="row">
					<div class="content">
						<?php if( !empty($attributes['banner_title'])): ?>
							<h1 class="home-banner-title"><?php echo $attributes['banner_title'];?></h1>
						<?php endif; ?>
						<?php if( !empty($attributes['banner_subtitle'])): ?>
							<p class="home-banner-subtitle"><?php echo $attributes['banner_subtitle']; ?></p>
						<?php endif; ?>
						<?php if( !empty($attributes['button_link'])): ?>
							<a class="home-banner-button btn btn-main-color" href="<?php echo $attributes['button_link'];?>"><?php echo $attributes['button_text']; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>	
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
				'jbtheme/home-banner',
				array(
					'render_callback'=>'home_banner_render_block'
				)
			);
		}
	}
}
add_action('init', 'home_banner_register_block');