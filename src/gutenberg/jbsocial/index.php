<?php
/**
 *
 * Render dynamic home banner block
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
if ( !function_exists('jbsocial_render_block') ){
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
	function jbsocial_render_block($attributes, $content ){
        $fb_url = get_theme_mod('jb_social_fb');
        $twitter_url = get_theme_mod('jb_social_twitter');
        $linkedin_url = get_theme_mod('jb_social_linkedin');
        $google_plus_url = get_theme_mod('jb_social_google_plus');
        $youtube_url = get_theme_mod('jb_social_youtube');
		ob_start(); ?>
        <div class="jb-social-wrapper">                
            <?php if( !empty( $attributes['title']) ):?>
                <h3 class="jbsocial-title section-title"><?php echo $attributes['title']; ?></h3>
            <?php endif; ?>
            <?php if( !empty($attributes['subtitle'])): ?>
            <p class="jbsocial-subtitle section-subtitle">
                <?php echo $attributes['subtitle']; ?>
            </p>
            <?php endif; ?>
            <ul class="jb-social-icons">
                <?php if( !empty($fb_url) ): ?>
                    <li><a href="<?php echo $fb_url; ?>"><i class="fab fa-facebook-square"></i></a></li>
                <?php endif; ?>
                <?php if( !empty($twitter_url) ): ?>
                    <li><a href="<?php echo $twitter_url; ?>"><i class="fab fa-twitter-square"></i></a></li>
                <?php endif; ?>
                <?php if( !empty($linkedin_url) ): ?>
                    <li><a href="<?php echo $linkedin_url; ?>"><i class="fab fa-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if( !empty($google_plus_url) ): ?>
                    <li><a href="<?php echo $google_plus_url; ?>"><i class="fab fa-google-plus-square"></i></a></li>
                <?php endif; ?>
                <?php if( !empty($youtube_url) ): ?>
                    <li><a href="<?php echo $youtube_url; ?>"><i class="fab fa-youtube-square"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
	<?php 
		return ob_get_clean();
	}
}

if( !function_exists('jbsocial_register_block') ){

	/**
	 *
	 *Register action after all plugins have loaded
	 */
	function jbsocial_register_block(){
		if( function_exists('register_block_type') ){
			register_block_type(
				'jbtheme/jbsocial',
				array(
					'render_callback'=>'jbsocial_render_block'
				)
			);
		}
	}
}
add_action('init', 'jbsocial_register_block');