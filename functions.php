<?php
/**
 * jb-wp-react's functions and definitions
 *
 * @package jb-wp-react
 * @since jb-wp-react 1.0
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
    load_theme_textdomain( 'jbdomain', get_template_directory() . '/languages' );
 
    /**
     * Add default posts and comments RSS feed links to <head>.
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for post thumbnails and featured images.
     */
    add_theme_support( 'post-thumbnails' );
 
    /**
     * Add support for two custom navigation menus.
     */
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'jbdomain' ),
        'secondary' => __('Secondary Menu', 'jbdomain' )
    ) );
 
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
//require get_template_directory() . '/inc/index.php';
if( !function_exists('jb_register_styles_scripts')):
	/**
	 * Register and Enqueue Styles.
	 */
	function jb_register_styles_scripts() {

		$theme_version = wp_get_theme()->get( 'Version' );
		//Enqueue style files
		wp_enqueue_style( 'jb-style', get_template_directory_uri().'/assets/css/main.min.css', array(), $theme_version );

		// Add print CSS.
		wp_enqueue_style( 'jb-print-style', get_template_directory_uri() . '/assets/css/print.css', null, $theme_version, 'print' );

		//Enqueue JS files
		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'jb-script', get_template_directory_uri() . '/assets/js/index.js', array('wp-element'), $theme_version, true );
		wp_script_add_data( 'jb-script', 'async', true );


	}
endif;
add_action( 'wp_enqueue_scripts', 'jb_register_styles_scripts' );
if( !function_exists('jb_admin_register_styles_scripts')):
	/**
	 * Register and Enqueue Styles.
	 */
	function jb_admin_register_styles_scripts() {

		$theme_version = wp_get_theme()->get( 'Version' );
		wp_enqueue_script( 'jb-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('wp-element'), $theme_version, true );
		wp_script_add_data( 'jb-admin-script', 'async', true );


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

if( !function_exists('jb_menus')){
	/**
	 * Register navigation menus uses wp_nav_menu in five places.
	 */
	function jb_menus() {

		$locations = array(
			'primary'  => __( 'Desktop Horizontal Menu', 'jbdomain' ),
			'expanded' => __( 'Desktop Expanded Menu', 'jbdomain' ),
			'mobile'   => __( 'Mobile Menu', 'jbdomain' ),
			'footer'   => __( 'Footer Menu', 'jbdomain' ),
			'social'   => __( 'Social Menu', 'jbdomain' ),
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

			}
		}

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
					'name'        => __( 'Footer #1', 'jbdomain' ),
					'id'          => 'sidebar-1',
					'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'jbdomain' ),
				)
			)
		);

		// Footer #2.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #2', 'jbdomain' ),
					'id'          => 'sidebar-2',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbdomain' ),
				)
			)
		);

	}
endif;
add_action( 'widgets_init', 'jb_sidebar_registration' );
