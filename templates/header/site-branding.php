<?php 
/**
 *
 * Site branding template
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );
$show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
$header_class = $show_title ? 'site-title' : 'screen-reader-text';
$whitelogo = get_theme_mod('jb_white_logo');
?>
<?php if ( has_custom_logo() && $show_title ) : ?>
	<div class="site-logo">
		<?php if( !empty($whitelogo) ): ?>
			<a href="<?php echo get_home_url(); ?>"><img src="<?php echo $whitelogo; ?>" class="white-logo" atl="<?php _e('White logo', 'jbtheme'); ?>" /></a>
		<?php endif; ?>
		<?php echo get_custom_logo(); ?>
		
	</div>
<?php endif; ?>
