<?php
/**
 * The indes file of all
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

if ( ! class_exists( 'JB_Social_Widget' ) ) {
	/**
	 * Adds JB_Social_Widget widget.
	 */
	class JB_Social_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			parent::__construct(
				'jb_social_widget', // Base ID.
				'JB Social Widget', // Name.
				array( 'description' => __( 'JB Social widget', 'jbprovider' ) ) // Args.
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			$before_widget = $args['before_widget'];
			$before_title  = $args['before_title'];
			$after_title   = $args['after_title'];
			$after_widget  = $args['after_widget'];
			$title         = apply_filters( 'widget_title', $instance['title'] );
			if ( isset( $instance['style_mode'] ) ) {
				$style_mode = $instance['style_mode'];
			} else {
				$style_mode = 'normal';
			}
			echo wp_kses_post( $before_widget );
			if ( ! empty( $title ) ) {
				echo wp_kses_post( $before_title ) . esc_html( $title ) . wp_kses_post( $after_title );
			}
			$fb_url          = get_theme_mod( 'jb_social_fb' );
			$twitter_url     = get_theme_mod( 'jb_social_twitter' );
			$linkedin_url    = get_theme_mod( 'jb_social_linkedin' );
			$google_plus_url = get_theme_mod( 'jb_social_google_plus' );
			$youtube_url     = get_theme_mod( 'jb_social_youtube' );
			$cl              = '';
			if ( 'white' === $style_mode ) :
				$cl = 'jb-social-white';
			endif; ?>
			<div class="jb-social-wrapper <?php echo esc_attr( $cl ); ?>">                
			<ul class="jb-social-icons">
				<?php if ( ! empty( $fb_url ) ) : ?>
					<li><a href="<?php echo esc_attr( $fb_url ); ?>"><i class="fab fa-facebook-square"></i></a></li>
				<?php endif; ?>
				<?php if ( ! empty( $twitter_url ) ) : ?>
					<li><a href="<?php echo esc_attr( $twitter_url ); ?>"><i class="fab fa-twitter-square"></i></a></li>
				<?php endif; ?>
				<?php if ( ! empty( $linkedin_url ) ) : ?>
					<li><a href="<?php echo esc_attr( $linkedin_url ); ?>"><i class="fab fa-linkedin"></i></a></li>
				<?php endif; ?>
				<?php if ( ! empty( $google_plus_url ) ) : ?>
					<li><a href="<?php echo esc_attr( $google_plus_url ); ?>"><i class="fab fa-google-plus-square"></i></a></li>
				<?php endif; ?>
				<?php if ( ! empty( $youtube_url ) ) : ?>
					<li><a href="<?php echo esc_attr( $youtube_url ); ?>"><i class="fab fa-youtube-square"></i></a></li>
				<?php endif; ?>
			</ul>
			</div>
			<?php
			echo wp_kses_post( $after_widget );
		}



		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			if ( isset( $instance['title'] ) ) {
				$title = $instance['title'];
			} else {
				$title = __( 'JB Social', 'jbprovider' );
			}
			if ( isset( $instance['style_mode'] ) ) {
				$style_mode = $instance['style_mode'];
			} else {
				$style_mode = 'normal';
			}
			?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'jbprovider' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'style_mode' ) ); ?>"><?php esc_html_e( 'Style mode:', 'jbprovider' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'style_mode' ) ); ?>" id="<?php echo esc_html( $this->get_field_id( 'style_mode' ) ); ?>" >
			<option value="normal" <?php echo ( 'normal' === $style_mode ) ? 'selected' : ''; ?>><?php esc_html_e( 'Normal', 'jbprovider' ); ?></option>
			<option value="white" <?php echo ( 'white' === $style_mode ) ? 'selected' : ''; ?>><?php esc_html_e( 'White', 'jbprovider' ); ?></option>
			</select>
		</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance               = array();
			$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
			$instance['style_mode'] = ( ! empty( $new_instance['style_mode'] ) ) ? esc_html( $new_instance['style_mode'] ) : 'normal';

			return $instance;
		}

	}
}

