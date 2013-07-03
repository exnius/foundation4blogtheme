<?php
/**
 * The template for displaying search forms in foundation4blogtheme
 *
 * @package foundation4blogtheme
 */
?>
<form role="search" method="get" class="search-form row collapse" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="columns small-8">
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'foundation4blogtheme' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'foundation4blogtheme' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'foundation4blogtheme' ); ?>" />
	</label>
	<div class="columns small-4"><input type="submit" class="search-submit button prefix" value="<?php echo esc_attr_x( 'Search', 'submit button', 'foundation4blogtheme' ); ?>" /></div>
</form>
