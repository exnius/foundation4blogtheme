<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package foundation4blogtheme
 */

/**
 * Adds custom classes to the array of body classes.
 */
function foundation4blogtheme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'foundation4blogtheme_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function foundation4blogtheme_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'foundation4blogtheme_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function foundation4blogtheme_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'foundation4blogtheme' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'foundation4blogtheme_wp_title', 10, 2 );

/**
 * wp_nav_menu custom Walker.
 */
class foundation4blogtheme_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0	? str_repeat( "\t", $depth ) : '' ); // code indent
		// build html
		$output .= "\n" . $indent . '<ul class="dropdown">' . "\n";
	}
	
	// add has-dropdown/active classes to li's and links
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( !empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-dropdown';
		}
		$element->classes[] = ($element->current || $element->current_item_ancestor || in_array("current-page-ancestor", $element->classes)) ? 'active' : '';
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	// add <li class="divider"></li>
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
		$class_names = $value = '';
	
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
	
		$class_names = join( ' ', apply_filters( 'foundation4blogtheme_walker_nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
		$id = apply_filters( 'foundation4blogtheme_walker_nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
		$output .= $indent . '<li class="divider"></li><li' . $id . $value . $class_names .'>';
	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		$output .= apply_filters( 'foundation4blogtheme_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
} // end foundation4blogtheme_walker_nav_menu class

/**
 * foundation4blogtheme_page_menu custom Walker.
 */
class foundation4blogtheme_walker_page extends Walker_Page {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0	? str_repeat( "\t", $depth ) : '' ); // code indent
		// build html
		$output .= "\n" . $indent . '<ul class="dropdown">' . "\n";
	}

	// add has-dropdown/active classes to li
	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);

		if ( !empty($args['has_children']) ) $css_class[] = 'has-dropdown';

		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor active';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item active';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent active';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent active';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		// add <li class="divider"></li>
		$output .= $indent . '<li class="divider"></li><li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($date_format, $time);
		}
	}
} // end foundation4blogtheme_walker_nav_menu class

/**
 * Get our wp_nav_menu() fallback, foundation4blogtheme_page_menu().
 */
function foundation4blogtheme_page_menu( $args = array() ) {
	$defaults = array(
		'sort_column' => 'menu_order, post_title',
		'menu_class'  => 'menu',
		'link_before' => '',
		'link_after'  => ''
	);
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'foundation4blogtheme_page_menu_args', $args );
	$menu = '';

	$list_args = $args;

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new foundation4blogtheme_walker_page;

	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul class="' . esc_attr($args['menu_class']). '">' . $menu . '</ul>';

	$menu = apply_filters( 'foundation4blogtheme_page_menu', $menu, $args );

	// output
	echo $menu;
}

/**
 * gallery shortcode overwrite.
 http://notnil-creative.com/blog/archives/969
 */
add_filter('post_gallery', 'foudation4blogtheme_gallery_shortcode', 10, 2);
/* redesign gallery style. originally in wp-includes/media.php */
function foudation4blogtheme_gallery_shortcode($output, $attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'li',
		'icontag'    => '',
		'captiontag' => 'div',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';

	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='{$selector}' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'><ul class='gallery-box small-block-grid-{$columns} clearing-thumbs' data-clearing>\n";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$caption = trim($attachment->post_excerpt) ? wptexturize($attachment->post_excerpt) : '';
		$default_attr = array(
			'data-caption' => $caption,
			'class'	=> "th radius attachment-$size",
		);
		$attachmentimg = wp_get_attachment_image($id, $size, false, $default_attr);

		$link = wp_get_attachment_image_src($id, 'full', false) ;

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "<a href='{$link[0]}'>{$attachmentimg}</a>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption screen-reader-text'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";

	}

	$output .= "</ul></div>\n";

	return $output;
}

/**
 * caoption shortcode overwrite.
 */
add_filter('img_caption_shortcode', 'foudation4blogtheme_img_caption_shortcode', 10, 3);
/* redesign gallery style. originally in wp-includes/media.php */
function foudation4blogtheme_img_caption_shortcode( $val, $attr, $content = null ) {

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption th radius ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
