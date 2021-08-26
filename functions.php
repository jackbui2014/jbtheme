<?php
/**
 * jbtheme's functions and definitions
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 * change the post expert length
 * 
 */

if ( ! function_exists( 'jb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function jb_setup() {
 
    /**
     * Make theme available for translation.
     * Translations can be placed in the /languages/ directory.
     */
    load_theme_textdomain( 'jbtheme', get_template_directory() . '/languages' );
 
    /**
     * Add default posts and comments RSS feed links to <head>.
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for post thumbnails and featured images.
     */
    add_theme_support( 'post-thumbnails' );

    /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
 
 
    /**
     * Enable support for the following post formats:
     * aside, gallery, quote, image, and video
     */
    add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );

}
endif; // jb_setup
add_action( 'after_setup_theme', 'jb_setup' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/index.php';
if( !function_exists('jb_register_styles_scripts')):
	/**
	 * Register and Enqueue Styles.
	 */
	function jb_register_styles_scripts() {

		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/all.min.css', array(), $theme_version );
		//Enqueue style files
		wp_enqueue_style( 'jb-style', get_template_directory_uri().'/assets/css/main.css', array(), $theme_version );

		// Add print CSS.
		wp_enqueue_style( 'jb-print-style', get_template_directory_uri() . '/assets/css/print.css', null, $theme_version, 'print' );

		//Enqueue JS files
		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'jb-bootstrap', get_template_directory_uri() . '/assets/js/lib/bootstrap.js', array( 'jquery'), $theme_version, true );
		wp_enqueue_script( 'jb-script', get_template_directory_uri() . '/assets/js/index.js', array('wp-element', 'jquery', 'jb-bootstrap'), $theme_version, true );
		wp_script_add_data( 'jb-script', 'async', true );


	}
endif;
add_action( 'wp_enqueue_scripts', 'jb_register_styles_scripts' );
if( !function_exists('jb_admin_register_styles_scripts')):
	/**
	 * Register and Enqueue Styles.
	 */
	function jb_admin_register_styles_scripts() {

		// $theme_version = wp_get_theme()->get( 'Version' );
		// wp_enqueue_script( 'jb-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('wp-element', 'wp-blocks', 'wp-i18n', 'wp-block-editor', 'wp-components'), $theme_version, true );
		// wp_script_add_data( 'jb-admin-script', 'async', true );


	}
endif;
add_action( 'admin_enqueue_scripts', 'jb_admin_register_styles_scripts' );
if( !function_exists('jb_skip_link_focus_fix')):
	/**
	 * Fix skip link focus in IE11.
	 *
	 * This does not enqueue the script because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * @link https://git.io/vWdr2
	 */
	function jb_skip_link_focus_fix() {
		// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
		</script>
		<?php
	}
endif;
add_action( 'wp_print_footer_scripts', 'jb_skip_link_focus_fix' );

if( !function_exists('jb_gutenberg_enqueue')){
	/**
	 * Enqueue Gutenberg
	 *
	 */
	function jb_gutenberg_enqueue(){
		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style(
			'jb-gutenberg-editor-css',
			get_template_directory_uri().'/assets/css/editor.css', 
			array('wp-editor'),
			$theme_version
		);
		wp_enqueue_script(
			'jb-gutenberg-script',
			get_template_directory_uri().'/assets/js/admin.js', 
			array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components'),
			$theme_version
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'jb_gutenberg_enqueue');

if( !function_exists('jb_gutenberg_enqueue_frontend')){
	/**
	 * Enqueue Gutenberg frontend style
	 *
	 */
	function jb_gutenberg_enqueue_frontend(){
		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style(
			'jb-gutenberg-style-css',
			get_template_directory_uri().'/assets/css/style.css', 
			array(),
			$theme_version
		);
		wp_enqueue_script(
			'lib-slick',
			get_template_directory_uri().'/assets/js/lib/slick.js', 
			array('jquery'),
			$theme_version,
			true
		);

		wp_enqueue_script(
			'jb-block',
			get_template_directory_uri().'/assets/js/block.js', 
			array('jquery', 'lib-slick'),
			$theme_version,
			true
		);
	}
}
add_action( 'enqueue_block_assets', 'jb_gutenberg_enqueue_frontend');

if( !function_exists('jb_gutenberg_block_category')){
	/**
	 *
	 *Add JB General gutenberg block category
	 *
	 */
	function jb_gutenberg_block_category($categories){
		return array_merge(
			array(
				array(
					'slug'=> 'jb-general-blocks',
					'title'=> __('JB General Blocks', 'jbtheme')
				),
			),
			$categories
		);
	}

}
add_filter('block_categories', 'jb_gutenberg_block_category');
if( !function_exists('jb_menus')){
	/**
	 * Register navigation menus uses wp_nav_menu in five places.
	 */
	function jb_menus() {

		$locations = array(
			'primary'  => __( 'Primary menu', 'jbtheme' ),
			'second' => __( 'Secondary Menu', 'jbtheme' )
		);
		register_nav_menus( $locations );
	}
}
add_action( 'init', 'jb_menus' );

if( !function_exists('jb_get_custom_logo')):
	/**
	 * Get the information about the logo.
	 *
	 * @param string $html The HTML output from get_custom_logo (core function).
	 *
	 * @return string $html
	 */
	function jb_get_custom_logo( $html ) {

		$logo_id = get_theme_mod( 'custom_logo' );

		if ( ! $logo_id ) {
			return $html;
		}

		$logo = wp_get_attachment_image_src( $logo_id, 'full' );

		if ( $logo ) {
			// For clarity.
			$logo_width  = esc_attr( $logo[1] );
			$logo_height = esc_attr( $logo[2] );

			// If the retina logo setting is active, reduce the width/height by half.
			if ( get_theme_mod( 'retina_logo', false ) ) {
				$logo_width  = floor( $logo_width / 2 );
				$logo_height = floor( $logo_height / 2 );

				$search = array(
					'/width=\"\d+\"/iU',
					'/height=\"\d+\"/iU',
				);

				$replace = array(
					"width=\"{$logo_width}\"",
					"height=\"{$logo_height}\"",
				);

				// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
				if ( strpos( $html, ' style=' ) === false ) {
					$search[]  = '/(src=)/';
					$replace[] = "style=\"height: {$logo_height}px;\" src=";
				} else {
					$search[]  = '/(style="[^"]*)/';
					$replace[] = "$1 height: {$logo_height}px;";
				}

				$html = preg_replace( $search, $replace, $html );
				$html .='<a href="'.get_home_url().'">'.$html.'</a>';

			}
		}
		$html = str_replace('<span ', '<a href="'.get_home_url().'" ', $html);
		$html = str_replace('</span>', '</a>', $html);
		return $html;

	}
endif;

add_filter( 'get_custom_logo', 'jb_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
if( !function_exists('jb_sidebar_registration')):
	/**
	 * Register widget areas.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function jb_sidebar_registration() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = array(
			'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
			'after_title'   => '</h2>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
		);

		// Footer #1.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #1', 'jbtheme' ),
					'id'          => 'sidebar-1',
					'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'jbtheme' ),
				)
			)
		);

		// Footer #2.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #2', 'jbtheme' ),
					'id'          => 'sidebar-2',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbtheme' ),
				)
			)
		);

	}
endif;
add_action( 'widgets_init', 'jb_sidebar_registration' );

if( !function_exists('jb_excerpt_length') ){
	/**
	 * Custom the post expert length
	 *
	 *
	 */
	function jb_excerpt_length(){
		return 30;
	}
}
add_filter( 'excerpt_length', 'jb_excerpt_length', 999 );

if ( ! function_exists( 'jb_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 *
	 *  <snip />
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function jb_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// This is an example of how to include a plugin bundled with a theme.
			// array(
			// 'name'               => 'Advanced Custom Fields', // The plugin name.
			// 'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
			// 'source'             => '', // The plugin source.
			// 'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			// 'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			// 'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			// 'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			// 'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			// 'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			// ),

			// This is an example of how to include a plugin from the WordPress Plugin Repository.
			array(
				'name'     => 'WPForms Lite',
				'slug'     => 'wpforms-lite',
				'required' => false,
			),
			array(
				'name'     => 'Yoast SEO',
				'slug'     => 'wordpress-seo',
				'required' => false,
			),

			// <snip />
		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			/*
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
				'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
				// <snip>...</snip>
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
			*/
		);

		tgmpa( $plugins, $config );

	}
}
add_action( 'tgmpa_register', 'jb_register_required_plugins' );