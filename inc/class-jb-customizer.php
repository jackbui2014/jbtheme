<?php
/**
 *
 * JB_Customizer class file
 *
 * @package    JB
 * @subpackage jbprovider
 * @since      1.0
 */

if ( ! class_exists( 'JB_Customizer' ) ) {
	/**
	 *
	 * JB_Customizer class doc
	 */
	class JB_Customizer {

		/**
		 * This hooks into 'customize_register' (available as of WP 3.4) and allows
		 * you to add new sections and controls to the Theme Customize screen.
		 *
		 * Note: To enable instant preview, we have to actually write a bit of custom
		 * javascript. See live_preview() for more.
		 *
		 * @see   add_action('customize_register',$func)
		 * @param \WP_Customize_Manager $wp_customize custmizer array.
		 * @since JB Provider 1.0
		 */
		public static function register( $wp_customize ) {
			// 1. Define a new section (if desired) to the Theme Customizer
			$wp_customize->add_section(
				'jbtheme_options',
				array(
					'title'       => __( 'JB Provider Options', 'jbprovider' ), // Visible title of section.
					'priority'    => 300, // Determines what order this appears in.
					'capability'  => 'edit_theme_options', // Capability needed to tweak.
					'description' => __( 'Allows you to customize the settings for JB Provider.', 'jbprovider' ), // Descriptive tooltip.
				)
			);

			$wp_customize->add_setting(
				'jb_white_logo', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_image',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Upload_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_white_logo_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'White logo', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_white_logo', // Which setting to load and manipulate (serialized is okay).
						'priority' => 1, // Determines the order this control appears in for the specified section.
						'section'  => 'title_tagline', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
					)
				)
			);

			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_copyright', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '<p>Copyright Â© 2021 JB Provider. All rights reserved. </p>', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_html',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_copyright_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Website copyright', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_copyright', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'textarea',
					)
				)
			);
			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_address', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '<p>Your company address</p>', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_html',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_address_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Address', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_address', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'textarea',
					)
				)
			);

			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_head_scripts', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_scripts',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_head_scripts_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Head scripts', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_head_scripts', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'textarea',
					)
				)
			);
			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_footer_scripts', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_scripts',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_footer_scripts_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Footer scripts', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_footer_scripts', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'textarea',
					)
				)
			);
			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_social_fb', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_url',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_social_fb_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Facebook URL', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_social_fb', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'text',
					)
				)
			);
			// 2. Register new settings to the WP database...
			$wp_customize->add_setting(
				'jb_social_twitter', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_url',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_social_twitter_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Twitter URL', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_social_twitter', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'text',
					)
				)
			);
			$wp_customize->add_setting(
				'jb_social_linkedin', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_url',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_social_linkedin_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Linkedin URL', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_social_linkedin', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'text',
					)
				)
			);

			$wp_customize->add_setting(
				'jb_social_google_plus', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_url',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_social_google_plus_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Google Plus URL', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_social_google_plus', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'text',
					)
				)
			);
			$wp_customize->add_setting(
				'jb_social_youtube', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => '', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_url',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_social_youtube_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Youtube URL', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_social_youtube', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'text',
					)
				)
			);

			$wp_customize->add_setting(
				'jb_blog_layout', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => 'grid', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_select',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_blog_layout_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Blog layout', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_blog_layout', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'select',
						'choices'  => array(
							'grid' => __( 'Grid', 'jbprovider' ),
							'list' => __( 'List', 'jbprovider' ),
						),
					)
				)
			);
			$wp_customize->add_setting(
				'jb_blog_showsidebar', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => 'nosidebar', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_select',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_blog_showsidebar_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Blog sidebar options', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_blog_showsidebar', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'select',
						'choices'  => array(
							'nosidebar'    => __( 'No Sidebar', 'jbprovider' ),
							'leftsidebar'  => __( 'Left Sidebar', 'jbprovider' ),
							'rightsidebar' => __( 'Right Sidebar', 'jbprovider' ),
						),
					)
				)
			);

			$wp_customize->add_setting(
				'jb_blog_fullwith', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record.
				array(
					'default'           => 'default', // Default setting/value to save.
					'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
					'capability'        => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'         => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback' => 'jb_sanitize_select',
				)
			);

			// 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			$wp_customize->add_control(
				new WP_Customize_Control( // Instantiate the color control class.
					$wp_customize, // Pass the $wp_customize object (required).
					'jb_blog_fullwith_id', // Set a unique ID for the control.
					array(
						'label'    => __( 'Blog width options', 'jbprovider' ), // Admin-visible name of the control.
						'settings' => 'jb_blog_fullwith', // Which setting to load and manipulate (serialized is okay).
						'priority' => 10, // Determines the order this control appears in for the specified section.
						'section'  => 'jbtheme_options', // ID of the section this control should render in (can be one of yours, or a WordPress default section).
						'type'     => 'select',
						'choices'  => array(
							'default'   => __( 'Default', 'jbprovider' ),
							'fullwidth' => __( 'Full Width', 'jbprovider' ),
						),
					)
				)
			);

			// 4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

		}

		/**
		 * This will output the custom WordPress settings to the live theme's WP head.
		 *
		 * Used by hook: 'wp_head'
		 *
		 * @see   add_action('wp_head',$func)
		 * @since JB Provider 1.0
		 */
		public static function header_output() {
			?>
		<!--Customizer CSS--> 
		<style type="text/css">
			<?php self::generate_css( '#site-title a', 'color', 'header_textcolor', '#' ); ?> 
			<?php self::generate_css( 'body', 'background-color', 'background_color', '#' ); ?> 
			<?php self::generate_css( 'a', 'color', 'link_textcolor' ); ?>
		</style> 
		<!--/Customizer CSS-->
			<?php
		}

		/**
		 * This outputs the javascript needed to automate the live settings preview.
		 * Also keep in mind that this function isn't necessary unless your settings
		 * are using 'transport'=>'postMessage' instead of the default 'transport'
		 * => 'refresh'
		 *
		 * Used by hook: 'customize_preview_init'
		 *
		 * @see   add_action('customize_preview_init',$func)
		 * @since JB Provider 1.0
		 */
		public static function live_preview() {
			$theme_version = wp_get_theme()->get( 'Version' );
			wp_enqueue_script(
				'jbtheme-themecustomizer', // Give the script a unique ID.
				get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file.
				array( 'jquery', 'customize-preview' ), // Define dependencies.
				$theme_version, // Define a version (optional).
				true // Specify whether to put in footer (leave this true).
			);
		}

		/**
		 * This will generate a line of CSS for use in header output. If the setting
		 * ($mod_name) has no defined value, the CSS will not be output.
		 *
		 * @uses   get_theme_mod()
		 * @param  string $selector CSS selector.
		 * @param  string $style    The name of the CSS *property* to modify.
		 * @param  string $mod_name The name of the 'theme_mod' option to fetch.
		 * @param  string $prefix   Optional. Anything that needs to be output before the CSS property.
		 * @param  string $postfix  Optional. Anything that needs to be output after the CSS property.
		 * @param  bool   $echo     Optional. Whether to print directly to the page (default: true).
		 * @return string Returns a single line of CSS with selectors and a property.
		 * @since  JB Provider 1.0
		 */
		public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
			$return = '';
			$mod    = get_theme_mod( $mod_name );
			if ( ! empty( $mod ) ) {
				$return = sprintf(
					'%s { %s:%s; }',
					$selector,
					$style,
					$prefix . $mod . $postfix
				);
				if ( $echo ) {
					echo wp_kses_post( $return );
				}
			}
			return $return;
		}
	}
}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'JB_Customizer', 'register' ) );

// Output custom CSS to live site.
add_action( 'wp_head', array( 'JB_Customizer', 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen.
add_action( 'customize_preview_init', array( 'JB_Customizer', 'live_preview' ) );
