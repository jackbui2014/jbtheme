<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package    JB
 * @subpackage jbtheme
 * @since      1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
global $jb_show_full_class;
$jb_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area default-max-width <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?> <?php echo esc_attr( $jb_show_full_class ); ?>">

	<?php
	if ( have_comments() ) :
		;
		?>
		<h2 class="comments-title">
		<?php if ( '1' === $jb_comment_count ) : ?>
			<?php esc_html_e( '1 comment', 'jbtheme' ); ?>
			<?php else : ?>
				<?php
				printf(
				/* translators: %s: Comment count number. */
					esc_html( _nx( '%s comment', '%s comments', $jb_comment_count, 'Comments title', 'jbtheme' ) ),
					esc_html( number_format_i18n( $jb_comment_count ) )
				);
				?>
			<?php endif; ?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
		<?php
		wp_list_comments(
			array(
				'avatar_size' => 60,
				'style'       => 'ol',
				'short_ping'  => true,
			)
		);
		?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'before_page_number' => esc_html__( 'Page', 'jbtheme' ) . ' ',
				'mid_size'           => 0,
				'prev_text'          => sprintf(
					'<span class="nav-prev-text">%s</span>',
					esc_html__( 'Older comments', 'jbtheme' )
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">%s</span>',
					esc_html__( 'Newer comments', 'jbtheme' )
				),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jbtheme' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'logged_in_as'       => null,
			'title_reply'        => esc_html__( 'Leave a comment', 'jbtheme' ),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		)
	);
	?>

</div><!-- #comments -->
