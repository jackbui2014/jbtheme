<?php
/**
 *
 * The default content template
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

global $show_full_class;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content <?php echo esc_attr( $show_full_class ); ?>">
				<?php the_content(); ?>
		</div>
	</div>
</article>
