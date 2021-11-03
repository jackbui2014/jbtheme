<?php
/**
 * 404 template
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

get_header();
?>
<div class="container">
	<div class="class-404">
	<h1 class="class-404-title">404</h1>
	<p class="class-404-subtitle"><?php esc_html_e( 'Page not found!', 'jbapp' ); ?></p>
	</div>
</div>
<?php
get_footer();
