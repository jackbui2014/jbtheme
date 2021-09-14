
<?php
/**
 *
 * The post content template
 *
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */
global $show_full_class, $post;
$date =  date(get_option('date_format'), strtotime($post->post_date));
$comments = get_comments_number($post->ID);
$author_name = get_the_author_meta('display_name', $post->post_author);
$cat_html = '';
$categories = get_the_category();
if ( ! empty( $categories ) ):
	foreach( $categories as $key=>$cat):
    	$cat_html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>, ';
	endforeach;
	$cat_html = substr($cat_html, 0, -2);
endif;

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content <?php echo $show_full_class; ?>">
			<div class="row">
				<div class="col-md-9 col-sm-12">
					<h1 class="jb-single-title"><?php the_title();?></h1>
					<?php if ( function_exists('yoast_breadcrumb') ):
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
					endif;
						?>
					<div class="entry-meta post-item-info">
						<ul>
							<li class="post-item-info-date"><i class="far fa-calendar-alt"></i> <?php echo $date; ?>  </li>
							<li class="post-item-info-author"><i class="far fa-user"></i> <?php echo esc_html($author_name); ?>  </li>
							<li class="post-item-info-author"><i class="fas fa-folder-open"></i> <?php echo  $cat_html; ?>  </li>
							<li class="post-item-info-comments"><i class="fas fa-comments"></i><?php echo $comments; ?></li>
						</ul>
					</div>
					<?php if( has_post_thumbnail()): 
						the_post_thumbnail('full');
					endif; ?>
					<?php the_content(); ?>
				</div>
				<div class="col-md-3 col-sm-12">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
	
</article>