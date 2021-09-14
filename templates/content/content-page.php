<?php
/**
 *
 * The page content template
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
global $show_full_class;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content <?php echo $show_full_class; ?>">
				<?php the_content(); ?>
		</div>
	</div>
	
</article>