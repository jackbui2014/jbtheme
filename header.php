<?php
/**
 * Header file for JB WP React theme.
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

global $jb_show_full_class, $jb_show_sidebar, $post;
jb_setup_global_variables( $post->ID );
$head_scripts = get_theme_mod( 'jb_head_scripts' );
?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
		<?php
		echo wp_kses(
			$head_scripts,
			array(
				'script' => array(
					'async' => array(),
					'src'   => array(),
				),
				'style'  => array(),
				'link'   => array(
					'rel'  => array(),
					'href' => array(),
					'type' => array(),
				),
				'meta'   => array( 'content' => array() ),
			)
		);
		?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<div class="loading-aniamte"><div class="lds-ripple"><div></div><div></div></div></div>
		<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jbprovider' ); ?></a>
			<?php get_template_part( 'templates/header/site', 'header' ); ?>
			<div id="content" class="site-content">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
