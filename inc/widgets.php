<?php
/**
 * Widget
 *
 * The widget file
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

if ( ! function_exists( 'jb_sidebar_registration' ) ) {
	/**
	 * Register widget areas.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function jb_sidebar_registration() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = array(
			'before_title'  => '<h4 class="widget-title title">',
			'after_title'   => '</h4>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
		);
		// Blog sidebar.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Blog sidebar', 'jbprovider' ),
					'id'          => 'sidebar-blog',
					'description' => __( 'Widgets in this area will be displayed in blog pages.', 'jbprovider' ),
				)
			)
		);

		// Footer #1.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #1', 'jbprovider' ),
					'id'          => 'sidebar-1',
					'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'jbprovider' ),
				)
			)
		);

		// Footer #2.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #2', 'jbprovider' ),
					'id'          => 'sidebar-2',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbprovider' ),
				)
			)
		);

		// Footer #3.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #3', 'jbprovider' ),
					'id'          => 'sidebar-3',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbprovider' ),
				)
			)
		);

		// Footer #4.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #4', 'jbprovider' ),
					'id'          => 'sidebar-4',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbprovider' ),
				)
			)
		);

		register_widget( 'JB_Social_Widget' );

	}
}

add_action( 'widgets_init', 'jb_sidebar_registration' );
