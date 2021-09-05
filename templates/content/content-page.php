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
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	
</article>