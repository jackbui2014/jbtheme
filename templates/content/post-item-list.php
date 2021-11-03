<?php
/**
 *
 * The post item with list layout
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

global $post;
$item_cls    = 'row post-item';
$jb_link     = get_permalink( $post->ID );
$thumbnail   = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
$date        = gmdate( get_option( 'date_format' ), strtotime( $post->post_date ) );
$post_expert = get_the_excerpt( $post->ID );
$jb_comments = get_comments_number( $post->ID );
$content_cl  = 'col-md-8 col-sm-12';
if ( empty( $thumbnail ) ) {
	$content_cl = 'col-md-12 col-sm-12';
}
?>
<div class="<?php echo esc_attr( $item_cls ); ?> animate__animated fadeInUp" data-scroll>
<?php if ( ! empty( $thumbnail ) ) : ?>
	<div class="col-md-4 col-sm-12">
		<div class="post-item-image"><a href="<?php echo esc_attr( $jb_link ); ?> "><img src="<?php echo esc_attr( $thumbnail ); ?>" atl="<?php echo esc_attr( $post->post_title ); ?>" /></a></div>
	</div>
	<?php endif; ?>
	<div class="<?php echo esc_attr( $content_cl ); ?> ">
		<h3 class="post-item-title"><a href="<?php echo esc_attr( $jb_link ); ?> "><?php echo esc_html( $post->post_title ); ?></a></h3>
		<div class="post-item-info">
			<div class="post-item-info-date"><i class="far fa-calendar-alt"></i><?php echo esc_html( $date ); ?>  <span class="seperator-icon">|</span>  </div>
			<div class="post-item-info-comments"><i class="fas fa-comments"></i><?php echo esc_html( $jb_comments ); ?></div>

		</div>
		<div class="post-item-exceprt"><?php echo wp_kses_post( $post_expert ); ?></div>
		<a class="post-item-readmore" href="<?php echo esc_attr( $jb_link ); ?>"><?php esc_html_e( 'Read more', 'jbapp' ); ?></a>
	</div>
</div>
