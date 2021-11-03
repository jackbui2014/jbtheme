<?php
/**
 *
 * The JB_Settings class file
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

if ( ! class_exists( 'JB_Settings' ) ) {
	/**
	 *
	 * The JB_Settings class file
	 *
	 * @package JB
	 * @subpackage jbapp
	 * @since 1.0
	 */
	abstract class JB_Settings {
		/**
		 * ID of the settings
		 *
		 * @var string
		 */
		public $settings_id = '';
		/**
		 *
		 * Tabs for the settings page
		 *
		 * @var array
		 */
		public $tabs = array(
			'general' => 'General',
		);
		/**
		 * Settings from database
		 *
		 * @var array
		 */
		protected $settings = array();
		/**
		 * Array of fields for the general tab
		 * array(
		 *  'tab_slug' => array(
		 *      'field_name' => array(),
		 *      ),
		 *  )
		 *
		 * @var array
		 */
		protected $fields = array();
		/**
		 * Data gotten from POST
		 *
		 * @var array
		 */
		protected $posted_data = array();

		/**
		 * Get the settings from the database
		 *
		 * @return void
		 */
		public function init_settings() {
			$this->settings = (array) get_option( $this->settings_id );
			foreach ( $this->fields as $tab_key => $tab ) {

				foreach ( $tab as $name => $field ) {

					if ( isset( $this->settings[ $name ] ) ) {
						$this->fields[ $tab_key ][ $name ]['default'] = $this->settings[ $name ];
					}
				}
			}
		}
		/**
		 * Save settings from POST
		 *
		 * @param array $postdata data.
		 */
		public function save_settings( $postdata ) {
			$this->posted_data = $postdata;
			if ( empty( $this->settings ) ) {
				$this->init_settings();
			}
			foreach ( $this->fields as $tab => $tab_data ) {
				foreach ( $tab_data as $name => $field ) {

					$this->settings[ $name ] = $this->{ 'validate_' . $field['type'] }( $name );

				}
			}

			update_option( $this->settings_id, $this->settings );
		}
		/**
		 * Gets and option from the settings API, using defaults if necessary to prevent undefined notices.
		 *
		 * @param  string $key key.
		 * @param  mixed  $empty_value value.
		 * @return mixed  The value specified for the option or a default value for the option.
		 */
		public function get_option( $key, $empty_value = null ) {
			if ( empty( $this->settings ) ) {
				$this->init_settings();
			}
			// Get option default if unset.
			if ( ! isset( $this->settings[ $key ] ) ) {
				$form_fields = $this->fields;
				foreach ( $this->tabs as $tab_key => $tab_title ) {
					if ( isset( $form_fields[ $tab_key ][ $key ] ) ) {
						$this->settings[ $key ] = isset( $form_fields[ $tab_key ][ $key ]['default'] ) ? $form_fields[ $tab_key ][ $key ]['default'] : '';

					}
				}
			}
			if ( ! is_null( $empty_value ) && empty( $this->settings[ $key ] ) && '' === $this->settings[ $key ] ) {
				$this->settings[ $key ] = $empty_value;
			}
			return $this->settings[ $key ];
		}

		/**
		 * Validate text field
		 *
		 * @param  string $key name of the field.
		 * @return string $text next.
		 */
		public function validate_text( $key ) {
			$text = $this->get_option( $key );
			if ( isset( $this->posted_data[ $key ] ) ) {
				$text = wp_kses_post( trim( stripslashes( $this->posted_data[ $key ] ) ) );
			}
			return $text;
		}
		/**
		 * Validate textarea field
		 *
		 * @param  string $key name of the field.
		 * @return string
		 */
		public function validate_textarea( $key ) {
			$text = $this->get_option( $key );

			if ( isset( $this->posted_data[ $key ] ) ) {
				$text = wp_kses(
					trim( stripslashes( $this->posted_data[ $key ] ) ),
					array_merge(
						array(
							'iframe' => array(
								'src'   => true,
								'style' => true,
								'id'    => true,
								'class' => true,
							),
						),
						wp_kses_allowed_html( 'post' )
					)
				);
			}
			return $text;
		}
		/**
		 * Validate WPEditor field
		 *
		 * @param  string $key name of the field.
		 * @return string $text text.
		 */
		public function validate_wpeditor( $key ) {
			$text = $this->get_option( $key );

			if ( isset( $this->posted_data[ $key ] ) ) {
				$text = wp_kses(
					trim( stripslashes( $this->posted_data[ $key ] ) ),
					array_merge(
						array(
							'iframe' => array(
								'src'   => true,
								'style' => true,
								'id'    => true,
								'class' => true,
							),
						),
						wp_kses_allowed_html( 'post' )
					)
				);
			}
			return $text;
		}
		/**
		 * Validate select field
		 *
		 * @param  string $key name of the field.
		 * @return string $value value.
		 */
		public function validate_select( $key ) {
			$value = $this->get_option( $key );
			if ( isset( $this->posted_data[ $key ] ) && ! is_array( $this->posted_data[ $key ] ) ) {
				$value = stripslashes( $this->posted_data[ $key ] );
			} else {
				$value = $this->posted_data[ $key ];
			}
			return $value;
		}
		/**
		 * Validate radio
		 *
		 * @param  string $key name of the field.
		 * @return string $value .
		 */
		public function validate_radio( $key ) {
			$value = $this->get_option( $key );
			if ( isset( $this->posted_data[ $key ] ) ) {
				$value = stripslashes( $this->posted_data[ $key ] );
			}
			return $value;
		}
		/**
		 * Validate checkbox field
		 *
		 * @param  string $key name of the field.
		 * @return string $status status.
		 */
		public function validate_checkbox( $key ) {
			$status = '';
			if ( isset( $this->posted_data[ $key ] ) && ( 1 === (int) $this->posted_data[ $key ] ) ) {
				$status = '1';
			}
			return $status;
		}

		/**
		 * Adding fields
		 *
		 * @param array  $array options for the field to add.
		 * @param string $tab   tab for which the field is.
		 */
		public function add_field( $array, $tab = 'general' ) {
			$allowed_field_types = array(
				'text',
				'textarea',
				'wpeditor',
				'select',
				'radio',
				'checkbox',
			);
			// If a type is set that is now allowed, don't add the field.
			if ( ! empty( $array['type'] ) && ! in_array( $array['type'], $allowed_field_types, true ) ) {
				return;
			}
			$defaults = array(
				'name'        => '',
				'title'       => '',
				'default'     => '',
				'placeholder' => '',
				'type'        => 'text',
				'options'     => array(),
				'default'     => '',
				'desc'        => '',
			);
			$array    = array_merge( $defaults, $array );
			if ( empty( $array['name'] ) ) {
				return;
			}
			foreach ( $this->fields as $tabs ) {
				if ( isset( $tabs[ $array['name'] ] ) ) {
					return new WP_Error( 'There is alreay a field with name ' . $array['name'] );
				}
			}
			// If there are options set, then use the first option as a default value.
			if ( ! empty( $array['options'] ) && empty( $array['default'] ) ) {
				$array_keys       = array_keys( $array['options'] );
				$array['default'] = $array_keys[0];
			}
			if ( ! isset( $this->fields[ $tab ] ) ) {
				$this->fields[ $tab ] = array();
			}
			$this->fields[ $tab ][ $array['name'] ] = $array;
		}

		/**
		 * Adding tab
		 *
		 * @param array $array options.
		 */
		public function add_tab( $array ) {
			$defaults = array(
				'slug'  => '',
				'title' => '',
			);
			$array    = array_merge( $defaults, $array );
			if ( empty( $array['slug'] ) || empty( $array['title'] ) ) {
				return;
			}
			$this->tabs[ $array['slug'] ] = $array['title'];
		}

		/**
		 * Rendering fields
		 *
		 * @param  string $tab slug of tab.
		 * @return void void.
		 */
		public function render_fields( $tab ) {
			if ( ! isset( $this->fields[ $tab ] ) ) {
				echo '<p>' . esc_attr__( 'There are no settings on these page.', 'jbapp' ) . '</p>';
				return;
			}
			foreach ( $this->fields[ $tab ] as $name => $field ) {

				$this->{ 'render_' . $field['type'] }( $field );
			}
		}


		/**
		 * Render text field
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_text( $field ) {

			?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
				</th>
				<td>
					<input type="<?php echo esc_attr( $field['type'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" id="<?php echo esc_attr( $field['name'] ); ?>" value="<?php echo esc_attr( $field['default'] ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />   
					<?php
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . esc_attr( $field['desc'] ) . '</p>';
					}
					?>
				</td>
			</tr>

			<?php
		}
		/**
		 * Render textarea field
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_textarea( $field ) {
			?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
				</th>
				<td>
					<textarea name="<?php echo esc_attr( $field['name'] ); ?>" id="<?php echo esc_attr( $field['name'] ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" ><?php echo esc_html( $field['default'] ); ?></textarea>   
					<?php
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
					}
					?>
				</td>
			</tr>

			<?php
		}
		/**
		 * Render WPEditor field
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_wpeditor( $field ) {

			?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo wp_kses_post( $field['title'] ); ?></label>
				</th>
				<td>
					<?php wp_editor( $field['default'], $field['name'], array( 'wpautop' => false ) ); ?>
					<?php
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
					}
					?>
				</td>
			</tr>

			<?php
		}
		/**
		 * Render select field
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_select( $field ) {
			if ( ! empty( $field['object_type'] ) && 'post' === $field['object_type'] && ! empty( $field['default'] ) ) {
				if ( is_array( $field['default'] ) ) {
					foreach ( $field['default'] as $key => $value ) {
						$p = get_post( $value );
						if ( isset( $p->ID ) ) {
							$field['options'][ $p->ID ] = $p->post_title;
						}
					}
				} else {
					$p = get_post( $default );
					if ( isset( $p->ID ) ) {
						$field['options'][ $p->ID ] = $p->post_title;
					}
				}
				$field['options'] = array_unique( $options );
			}
			if ( null === $field['multiple'] || ! $field['multiple'] ) :
				?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo wp_kses_post( $field['title'] ); ?></label>
				</th>
				<td>
					<select name="<?php echo esc_attr( $field['name'] ); ?>" id="<?php echo esc_attr( $field['name'] ); ?>" class="<?php echo esc_attr( $field['classes'] ); ?>" >
						<?php
						foreach ( $field['options'] as $value => $text ) {
							echo '<option ' . selected( $field['default'], $value, false ) . ' value="' . esc_attr( $value ) . '">' . esc_attr( $text ) . '</option>';
						}
						?>
					</select>
					<?php
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
					}
					?>
				</td>
			</tr>

				<?php
			else :
				?>
				<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo wp_kses_post( $field['title'] ); ?></label>
				</th>
				<td>                
					<select name="<?php echo esc_attr( $field['name'] ); ?>[]" id="<?php echo esc_attr( $field['name'] ); ?>" class="<?php echo esc_attr( $field['classes'] ); ?>" multiple>
						<?php
						foreach ( $field['options'] as $value => $text ) {
							$selected = '';
							if ( is_array( $field['default'] ) && in_array( $value, $field['default'], true ) ) {
								$selected = 'selected';
							} else {
								if ( $field['default'] === $value ) {
									$selected = 'selected';
								}
							}
							echo '<option ' . esc_attr( $selected ) . ' value="' . esc_attr( $value ) . '">' . wp_kses_post( $text ) . '</option>';
						}
						?>
					</select>
					<?php
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
					}
					?>
				</td>
			</tr>
				<?php
			endif;
		}
		/**
		 * Render radio
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_radio( $field ) {
			$name    = $field['name'] ? $name : '';
			$title   = $field['title'] ? $title : '';
			$options = $options['title'] ? $options : array();
			$desc    = $options['desc'] ? $desc : '';

			?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $name ); ?>"><?php echo wp_kses_post( $title ); ?></label>
				</th>
				<td>
					<?php
					foreach ( $options as $value => $text ) {
						echo '<input name="' . esc_attr( $name ) . '" id="' . esc_attr( $name ) . '" type="' . esc_attr( $type ) . '" ' . checked( $default, $value, false ) . ' value="' . esc_attr( $value ) . '">' . esc_attr( $text ) . '</option><br/>';
					}
					?>
					<?php
					if ( ! empty( $desc ) ) {
						echo '<p class="description">' . wp_kses_post( $desc ) . '</p>';
					}
					?>
				</td>
			</tr>

			<?php
		}
		/**
		 * Render checkbox field
		 *
		 * @param  string $field options.
		 * @return void
		 */
		public function render_checkbox( $field ) {
			?>

			<tr>
				<th>
					<label for="<?php echo esc_attr( $field['name'] ); ?>"><?php echo wp_kses_post( $field['title'] ); ?></label>
				</th>
				<td>
					<input <?php checked( $field['default'], '1', true ); ?> type="<?php echo esc_attr( $field['type'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" id="<?php echo esc_attr( $field['name'] ); ?>" value="1" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" />
					<?php echo esc_attr( $field['desc'] ); ?>
				</td>
			</tr>

			<?php
		}


	}
}
