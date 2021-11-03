<?php
/**
 * Default page template
 *
 * @package    JB
 * @subpackage jbapp
 * @since      1.0
 */

global $post, $wp_query;
$jb_blog_layout      = get_theme_mod( 'jb_blog_layout' );
$jb_blog_fullwith    = get_theme_mod( 'jb_blog_fullwith' );
$jb_blog_showsidebar = get_theme_mod( 'jb_blog_showsidebar' );
$container_cl        = 'container';
$content_cl          = 'col-md-12 col-sm-12';
if ( 'fullwidth' === $jb_blog_fullwith ) :
	$container_cl = 'container-fluid';
endif;
if ( 'nosidebar' !== $jb_blog_showsidebar ) :
	$content_cl = 'col-md-9 col-sm-12';
endif;
get_header(); ?>
<?php get_template_part( 'templates/content/blog-header' ); ?>
<div class="<?php echo esc_attr( $container_cl ); ?>">
	<div class="row">
		<?php if ( 'leftsidebar' === $jb_blog_showsidebar ) : ?>
			<div class="col-md-3 col-sm-12">
			<?php get_sidebar(); ?>
			</div>
			<?php
		endif;
		?>
		<div class="<?php echo esc_attr( $content_cl ); ?>">
		<?php if ( have_posts() ) : ?>
			<?php
			if ( 'grid' === $jb_blog_layout ) :
				get_template_part( 'templates/content/archive-grid' );
			else :
				get_template_part( 'templates/content/archive-list' );
			endif;
			jb_pagination( $wp_query );
			?>
			<?php
		else :
			get_template_part( 'templates/content/content-none' );
		endif;
		?>
		</div>
		<?php if ( 'rightsidebar' === $jb_blog_showsidebar ) : ?>
			<div class="col-md-3 col-sm-12">
			<?php get_sidebar(); ?>
			</div>
			<?php
		endif;
		?>
	</div>
</div>
<?php
get_footer();
