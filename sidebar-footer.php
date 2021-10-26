<?php
/**
 * JB Provider's functions and definitions
 *
 * @package JB
 * @subpackage jbprovider
 * @since 1.0
 */

$jb_active_sidebars = apply_filters( 'jb_active_sidebars', array( 'sidebar-1', 'sidebar-2', 'sidebar-3', 'sidebar-4' ) );
if ( false === $jb_active_sidebars ) {
	return;
}
$cols = (int) 12 / count( $jb_active_sidebars );
$cls  = apply_filters( 'jb_footer_widget_class', 'col-12 col-md-' . $cols . ' col-xs-12 ' );
?>
<div class="main-footer animate__animated fadeInUp" data-scroll>
<div class="container">
<div class="row">
		<?php
		foreach ( $jb_active_sidebars as $footer_sidebar ) :
			echo '<div class="' . esc_attr( $cls ) . '">';
			dynamic_sidebar( $footer_sidebar );
			echo '</div> <!-- end .footer-widget -->';
		endforeach;
		?>
</div>
</div> <!-- #footer-widgets -->
</div>    <!-- .container -->
