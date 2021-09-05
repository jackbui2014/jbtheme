<?php
/**
 * Default page template
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
		$template_name = get_post_type();
		get_template_part('templates/content/content', $template_name);
	endwhile;
endif;
get_footer(); ?>