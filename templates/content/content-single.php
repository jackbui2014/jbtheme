<?php
/**
 *
 * The post content template
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

global $jb_show_full_class, $jb_show_sidebar, $post;
$date        = gmdate( get_option( 'date_format' ), strtotime( $post->post_date ) );
$jb_comments = get_comments_number( $post->ID );
$author_name = get_the_author_meta( 'display_name', $post->post_author );
$cat_html    = '';
$categories  = get_the_category();
if ( ! empty( $categories ) ) :
	foreach ( $categories as $key => $value ) :
		$cat_html .= '<a href="' . esc_url( get_category_link( $value->term_id ) ) . '">' . esc_html( $value->name ) . '</a>, ';
	endforeach;
	$cat_html = substr( $cat_html, 0, -2 );
endif;
$tags_list  = get_the_tag_list( '', ', ', '' );
$sidebar_cl = 'col-md-12 col-sm-12';
$content_cl = 'col-md-12 col-sm-12';
if ( 'leftsidebar' === $jb_show_sidebar || 'rightsidebar' === $jb_show_sidebar ) :
	$sidebar_cl = 'col-md-3 col-sm-12';
	$content_cl = 'col-md-9 col-sm-12';
endif;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content <?php echo esc_attr( $jb_show_full_class ); ?>">
			<div class="row">
				<?php if ( 'leftsidebar' === $jb_show_sidebar ) : ?>
					<div class="<?php echo esc_attr( $sidebar_cl ); ?>">
						<?php get_sidebar(); ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo esc_attr( $content_cl ); ?>">
					<h1 class="jb-single-title"><?php the_title(); ?></h1>
					<div class="entry-meta post-item-info">
						<ul>
							<li class="post-item-info-date"><i class="far fa-calendar-alt"></i> <?php echo esc_html( $date ); ?>  </li>
							<li class="post-item-info-author"><i class="far fa-user"></i> <?php echo esc_html( $author_name ); ?>  </li>
							<li class="post-item-info-cat"><i class="fas fa-folder-open"></i> <?php echo wp_kses_post( $cat_html ); ?>  </li>
							<?php if ( ! empty( $tags_list ) ) : ?>
								<li class="post-item-info-tag"><i class="fas fa-tags"></i> <?php echo wp_kses_post( $tags_list ); ?>  </li>
							<?php endif; ?>
							<li class="post-item-info-comments"><i class="fas fa-comments"></i><?php echo esc_html( $jb_comments ); ?></li>
						</ul>
					</div>
					<?php
					if ( has_post_thumbnail() ) :
						?>
					<div class="jb-post-thumbnail">
						<?php the_post_thumbnail( 'full' ); ?>
					</div>
						<?php
					endif;
					?>
					<?php
					the_content();
					// If comments are open or there is at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>
				<?php if ( 'rightsidebar' === $jb_show_sidebar ) : ?>
				<div class="<?php echo esc_attr( $sidebar_cl ); ?>">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>
