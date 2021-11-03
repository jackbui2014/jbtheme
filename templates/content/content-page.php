<?php
/**
 *
 * The page content template
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

global $jb_show_full_class;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content <?php echo esc_attr( $jb_show_full_class ); ?>">
				<?php the_content(); ?>
		</div>
	</div>
</article>
