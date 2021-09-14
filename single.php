<?php
/**
 * Single template page
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
get_header();

if( have_posts() ):
	while( have_posts()):
		the_post();
		get_template_part('templates/content/content', 'single');
		// If comments are open or there is at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
endif;
get_footer(); ?>