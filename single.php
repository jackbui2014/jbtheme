<?php
/**
 * Single template page
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/content/blog-header' );
		get_template_part( 'templates/content/content', 'single' );
	endwhile;
endif;
get_footer();
