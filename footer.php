<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package foundation4blogtheme
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo"><div class="row">
		<?php do_action( 'foundation4blogtheme_credits' ); ?>
		<div class="site-info columns small-12 large-4">
		<?php
			$options = get_theme_mods();
			$copyright = $options['footer_text'] ? esc_html( $options['footer_text'] ) : "&copy; " . esc_html( get_bloginfo( 'name', 'display' ) ) . ".";
			echo $copyright;
		?>
		</div>
		<div class="theme-info columns small-12 large-8">
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'foundation4blogtheme' ); ?>" rel="generator"><i class="genericon genericon-wordpress"></i> <?php printf( __( 'Proudly powered by %s', 'foundation4blogtheme' ), 'WordPress' ); ?></a>
			<br class="show-for-small"><span class="sep footer-hide-for-small"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'foundation4blogtheme' ), 'foundation4blogtheme', '<a href="http://gatespace.jp/" rel="designer">gatespace</a>' ); ?>
			<br class="show-for-small"><span class="sep footer-hide-for-small"> | </span>
			<?php printf( __( 'Include: %1$s.', 'foundation4blogtheme' ), '<a href="http://foundation.zurb.com/" rel="designer">Foundation 4</a>' ); ?>
		</div><!-- .site-info -->
	</div></footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script>
jQuery(document).ready(function($){
	$(document).foundation('clearing');
	$(document).foundation('topbar', { stickyClass: 'sticky-top-bar' });
});
</script>
</body>
</html>