<?php
	/**
	 *
	 * The JB_Metabox class file
	 *
	 * @package JB
	 * @subpackage jbapp
	 * @since 1.0
	 */

if ( ! class_exists( 'JB_Mettabox' ) ) {
	/**
	 *
	 * The JB_Metabox class for all posts/pages metabox
	 *
	 * @package JB
	 * @subpackage jbapp
	 * @since 1.0
	 */
	class JB_Metabox extends JB_Settings {

		/**
		 * Metabox Title
		 *
		 * @var string $title is the meta field title.
		 */
		protected $title = '';

		/**
		 * Metabox ID
		 *
		 * @var string $slug is the slug.
		 */
		protected $slug = '';

		/**
		 * Array of post types for which we allow the metabox
		 *
		 * @var array $post_type is the list of post type will be shown.
		 */
		protected $post_types = array();

		/**
		 * Post ID used to save or retrieve the settings
		 *
		 * @var integer $post_id is the id of post.
		 */
		protected $post_id = 0;

		/**
		 * Metabox context
		 *
		 * @var string $context is the context of the meta box.
		 */
		protected $context = '';

		/**
		 * Metabox priority
		 *
		 * @var string priority is the priority of metabox.
		 */
		protected $priority = '';

		/**
		 *
		 * The contructor of JB_Metabox class
		 *
		 * @param string $title is the meta box title.
		 * @param string $slug is the slug of the meta box.
		 * @param array  $post_types is list of post types.
		 * @param string $context is the context of the meta box.
		 * @param string $priority is the priority of the meta box.
		 */
		public function __construct( $title, $slug, $post_types = array( 'post' ), $context = 'advanced', $priority = 'default' ) {

			if ( empty( $slug ) || empty( $context ) || empty( $priority ) ) {
				return;
			}

			if ( empty( $title ) ) {
				$this->title = ucfirst( $slug );
			}

			if ( empty( $post_types ) ) {
				return;
			}

			$this->title       = $title;
			$this->slug        = $slug;
			$this->post_types  = $post_types;
			$this->settings_id = $this->slug;
			$this->context     = $context;
			$this->priority    = $priority;

			add_action( 'add_meta_boxes', array( $this, 'register' ) );
			add_action( 'save_post', array( $this, 'save_meta_settings' ) );

		}
		/**
		 *
		 * Register metabox
		 *
		 * @param string $post_type is the post type for register meta box.
		 */
		public function register( $post_type ) {
			if ( in_array( $post_type, $this->post_types, true ) ) {
				add_meta_box( $this->slug, $this->title, array( $this, 'render' ), $post_type );
			}
		}

		/**
		 *
		 * Render metabox
		 *
		 * @param mixed $post is the post post object.
		 */
		public function render( $post ) {
			$this->post_id = $post->ID;
			$this->init_settings();

			wp_nonce_field( 'metabox_' . $this->slug, 'metabox_' . $this->slug . '_nonce' );
			echo '<table class="form-table">';
			$this->render_fields( 'general' );
			echo '</table>';
		}

		/**
		 * Get the settings from the database
		 *
		 * @return void
		 */
		public function init_settings() {

			$post_id        = $this->post_id;
			$this->settings = array();
			foreach ( $this->fields as $tab_key => $tab ) {

				foreach ( $tab as $name => $field ) {
						$value                                        = get_post_meta( $post_id, $name, true );
						$this->fields[ $tab_key ][ $name ]['default'] = $value;

				}
			}
		}

		/**
		 *
		 * Save meta settings function
		 *
		 * @param integer $post_id is the id of post for saving.
		 */
		public function save_meta_settings( $post_id ) {

			if ( ! empty( $_POST[ 'metabox_' . esc_attr( $this->slug ) . '_nonce' ] ) ) {
				$nonce = sanitize_text_field( wp_unslash( $_POST[ 'metabox_' . esc_attr( $this->slug ) . '_nonce' ] ) );
			} else {
				return $post_id;
			}

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'metabox_' . $this->slug ) ) {
				return $post_id;
			}

			/*
			* If this is an autosave, our form has not been submitted,
			* so we don't want to do anything.
			*/
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			// Check the user's permissions.
			if ( ! empty( $_POST['post_type'] ) && 'page' === sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}

			$this->post_id = $post_id;
			// Verify that the nonce is valid.
			if ( wp_verify_nonce( $nonce, 'metabox_' . $this->slug ) ) {

				$this->save_settings( $_POST );
			}
		}

			/**
			 * Save settings from POST
			 *
			 * @param mixed $postdata is the $_POST data.
			 */
		public function save_settings( $postdata ) {
			$this->posted_data = $postdata;
			if ( empty( $this->settings ) ) {
				$this->init_settings();
			}
			foreach ( $this->fields as $tab => $tab_data ) {
				foreach ( $tab_data as $name => $field ) {
					$value = $this->{ 'validate_' . $field['type'] }( $name );
					update_post_meta( $this->post_id, $name, $value );
				}
			}
		}
	}
}
