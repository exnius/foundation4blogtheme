<?php
/**
 * The template for displaying search forms in foundation4blogtheme
 *
 * @package foundation4blogtheme
 */
?>
	<form method="get" id="searchform" class="searchform row collapse" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', 'foundation4blogtheme' ); ?></label>
		<div class="columns small-8"><input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'foundation4blogtheme' ); ?>" /></div>
		<div class="columns small-4"><input type="submit" class="submit button prefix" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'foundation4blogtheme' ); ?>" /></div>
	</form>
