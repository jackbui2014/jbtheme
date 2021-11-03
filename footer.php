<?php
/**
 *
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @package JB
 * @subpackage jbapp
 * @since 1.0
 */

$copyright      = get_theme_mod( 'jb_copyright' );
$address        = get_theme_mod( 'jb_address' );
$footer_scripts = get_theme_mod( 'jb_footer_scripts' );
?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- #content -->

			<footer id="site-footer" role="contentinfo" class="header-footer-group " >
			<?php get_sidebar( 'footer' ); ?>			
			<div class="small-footer animate__animated fadeInUp" data-scroll>
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="jb-small-footer-left">
								<?php echo wp_kses_post( $copyright ); ?>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="jb-small-footer-right">
								<?php echo wp_kses_post( $address ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			</footer>

		<?php wp_footer(); ?>
		<?php
		echo wp_kses(
			$footer_scripts,
			array(
				'script' => array(
					'async' => array(),
					'src'   => array(),
					'id'    => array(),
				),
				'style'  => array(),
				'link'   => array(
					'rel'  => array(),
					'href' => array(),
					'type' => array(),
				),
				'meta'   => array( 'content' => array() ),
			)
		);
		?>
	</body>
</html>
