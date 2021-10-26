<?php
/**
 *
 * Site branding template
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );
$show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
$header_class = $show_title ? 'site-title' : 'screen-reader-text';
$whitelogo    = get_theme_mod( 'jb_white_logo' );
?>
<?php if ( has_custom_logo() && $show_title ) : ?>
	<div class="site-logo">
		<?php if ( ! empty( $whitelogo ) ) : ?>
			<a href="<?php echo esc_attr( get_home_url() ); ?>"><img src="<?php echo esc_attr( $whitelogo ); ?>" class="white-logo" atl="<?php esc_attr_e( 'White logo', 'jbprovider' ); ?>" /></a>
		<?php endif; ?>
		<?php echo wp_kses_post( get_custom_logo() ); ?>
	</div>
<?php endif; ?>
