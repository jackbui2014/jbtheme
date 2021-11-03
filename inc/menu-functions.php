<?php
/**
 *
 * Menu functions file.
 *
 * @package    JB
 * @subpackage jbapp
 * @since      1.0
 */

/**
 * Add a button to top-level menu items that has sub-menus.
 * An icon is added using CSS depending on the value of aria-expanded.
 *
 * @since 1.0
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 *
 * @return string Nav menu item start element.
 */
function jb_add_sub_menu_toggle( $output, $item, $depth, $args ) {
	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add toggle button.
		$output .= '<button class="sub-menu-toggle" aria-expanded="false" >';
		$output .= '<i class="fas fa-chevron-down"></i>';
		$output .= '<span class="screen-reader-text">' . esc_html__( 'Open menu', 'jbapp' ) . '</span>';
		$output .= '</button>';
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'jb_add_sub_menu_toggle', 10, 4 );

