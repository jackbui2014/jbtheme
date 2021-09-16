<?php
/**
 * Template part for displaying page header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
global $post;
$jb_blog_fullwith = get_theme_mod('jb_blog_fullwith');
$container_cl = 'container';
if( $jb_blog_fullwith == 'fullwidth'):
	$container_cl = 'container-fluid';
endif;
?>
<div class="jb-page-header">
  <div class="page-header-inner <?php echo $container_cl; ?>">
    <?php if( is_archive()): 
      $description = get_the_archive_description();
      ?>
    <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
    <?php if ( function_exists('yoast_breadcrumb') ):
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        endif;
          ?>
    <?php if ( $description ) : ?>
      <div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</div>