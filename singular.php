<?php
/**
 * Singular page template
 *
 *
 * @package JB
 * @subpackage jb-wp-react
 * @since 1.0
 */
get_header();

if( have_posts() ):
	while( have_posts()):
		the_post();
		get_template_part('templates/content', get_post_type());
	endwhile;
endif;
get_footer(); ?>