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

?>
<div class="row">
<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content/post-item' );
endwhile;
?>
</div>
