<?php 
/**
 * Header file for JB WP React theme.
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<div class="loading-aniamte"><div class="lds-ripple"><div></div><div></div></div></div>
		<div id="page" class="site">
			<?php get_template_part('templates/header/site', 'header'); ?>
			<div id="content" class="site-content">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">