<?php 
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
					'name'        => __( 'Blog sidebar', 'jbtheme' ),
					'id'          => 'sidebar-blog',
					'description' => __( 'Widgets in this area will be displayed in blog pages.', 'jbtheme' ),
				)
			)
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

		// Footer #3.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #3', 'jbtheme' ),
					'id'          => 'sidebar-3',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbtheme' ),
				)
			)
		);

		// Footer #4.
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => __( 'Footer #4', 'jbtheme' ),
					'id'          => 'sidebar-4',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'jbtheme' ),
				)
			)
		);

	}
}

add_action( 'widgets_init', 'jb_sidebar_registration' );