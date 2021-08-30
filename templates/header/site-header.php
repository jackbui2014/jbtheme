<?php
/**
 *
 * Site header 
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= true === get_theme_mod( 'display_title_and_tagline', true ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>
<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?> animate__animated animate__fadeInDown" role="banner">
	<?php get_template_part( 'templates/header/site', 'branding' ); ?>
	<?php get_template_part( 'templates/header/site', 'nav' ); ?>

</header><!-- #masthead -->