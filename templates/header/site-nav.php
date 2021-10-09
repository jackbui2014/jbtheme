<?php
/**
 *
 * Site nav template
 *
 * @package JB
 * @subpackage jbtheme
 * @since 1.0
 */

?>
<?php
if ( is_front_page() ) :
	$cl = 'navbar-dark';
else :
	$cl = 'navbar-light';
endif;
?>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="navbar navbar-expand-lg primary-navigation <?php echo esc_attr( $cl ); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'jbtheme' ); ?>">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu-wrapper navbar-nav',
					'container_class' => 'primary-menu-container',
					'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
					'fallback_cb'     => false,
				)
			);
			?>
		</div>
	</nav><!-- #site-navigation -->
<?php endif; ?>
