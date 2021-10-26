<?php
/**
 * Template part for displaying page header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

global $post;
$jb_blog_fullwith = get_theme_mod( 'jb_blog_fullwith' );
$container_cl     = 'container';
if ( 'fullwidth' === $jb_blog_fullwith ) :
	$container_cl = 'container-fluid';
endif;
?>
<div class="jb-page-header">
<div class="page-header-inner <?php echo esc_attr( $container_cl ); ?>">
	<?php
	if ( is_archive() ) :
		$description = get_the_archive_description();
		?>
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) :
						yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		endif;
		?>
		<?php if ( $description ) : ?>
	<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
	<?php endif; ?>
	<?php elseif ( is_singular( 'post' ) ) : ?>
	<h2 class="page-title"><?php esc_html_e( 'BLOG SINGLE', 'jbprovider' ); ?></h2>
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) :
						yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		endif;
	elseif ( is_search() ) :
		$keyword = get_query_var( 's', '' );
		?>
		<?php /* translators: %s: search term */ ?>
		<h2 class="page-title"><?php echo sprintf( esc_html__( 'Search results for: %s ', 'jbprovider' ), esc_html( $keyword ) ); ?></h2>
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) :
							yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
			endif;
			?>
			<?php
	else :
		?>
		<h2 class="page-title"><?php esc_html_e( 'BLOGs', 'jbprovider' ); ?></h2>
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) :
						yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		endif;
		?>
	<?php endif; ?>
</div>
</div>
