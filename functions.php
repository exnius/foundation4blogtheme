<?php
/**
 * foundation4blogtheme functions and definitions
 *
 * @package foundation4blogtheme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 553; /* pixels */

if ( ! function_exists( 'foundation4blogtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function foundation4blogtheme_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on foundation4blogtheme, use a find and replace
	 * to change 'foundation4blogtheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'foundation4blogtheme', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'foundation4blogtheme' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'foundation4blogtheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // foundation4blogtheme_setup
add_action( 'after_setup_theme', 'foundation4blogtheme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function foundation4blogtheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'foundation4blogtheme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'foundation4blogtheme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function foundation4blogtheme_scripts() {
	if ( ! is_admin() ) {
		global $wp_styles;
		
		$theme_data = wp_get_theme();
		$theme_version = $theme_data->get('Version');

		wp_enqueue_style( 'foundation4blogtheme-style', get_stylesheet_uri(), array( 'foundation4' ), $theme_version );

		// Genericons
		$genericons_version = '2.09';
		wp_enqueue_style( 'foundation4blogtheme-genericons', get_template_directory_uri() . '/genericons.css', array( 'foundation4blogtheme-style' ), $genericons_version );

		// Foundation4
		$foundation4_version = '4.3.1';

		wp_enqueue_style( 'foundation4', get_template_directory_uri() . '/foundation.css', array(), $foundation4_version );
		wp_enqueue_style( 'ie8-grid-foundation-4', get_template_directory_uri() . '/ie8-grid-foundation-4.min.css', array( 'foundation4' ), $foundation4_version );
		$wp_styles->add_data( 'ie8-grid-foundation-4', 'conditional', 'lt IE 9' );

		// Modernizr acts as a shim for HTML5 elements for older browsers as well as detection for mobile devices.
		wp_enqueue_script( 'custom.modernizr', get_template_directory_uri() . '/js/vendor/custom.modernizr.js', array(), $foundation4_version );

		// or individually
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation/foundation.js', array('jquery'), $foundation4_version, true );
		// foundation4 alert
		// wp_enqueue_script( 'foundation.alerts', get_template_directory_uri() . '/js/foundation/foundation.alerts.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 clearing
		wp_enqueue_script( 'foundation.clearing', get_template_directory_uri() . '/js/foundation/foundation.clearing.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 cookie
		// wp_enqueue_script( 'foundation.cookie', get_template_directory_uri() . '/js/foundation/foundation.cookie.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 dropdown
		// wp_enqueue_script( 'foundation.dropdown', get_template_directory_uri() . '/js/foundation/foundation.dropdown.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 forms
		// wp_enqueue_script( 'foundation.forms', get_template_directory_uri() . '/js/foundation/foundation.forms.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 Interchange
		// wp_enqueue_script( 'foundation.interchange', get_template_directory_uri() . '/js/foundation/foundation.interchange.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 joyride
		// wp_enqueue_script( 'foundation.joyride', get_template_directory_uri() . '/js/foundation/foundation.joyride.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 magellan
		// wp_enqueue_script( 'foundation.magellan', get_template_directory_uri() . '/js/foundation/foundation.magellan.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 orbit
		// wp_enqueue_script( 'foundation.orbit', get_template_directory_uri() . '/js/foundation/foundation.orbit.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 placeholder
		// wp_enqueue_script( 'foundation.placeholder', get_template_directory_uri() . '/js/foundation/foundation.placeholder.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 reveal
		// wp_enqueue_script( 'foundation.reveal', get_template_directory_uri() . '/js/foundation/foundation.reveal.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 section
		// wp_enqueue_script( 'foundation.section', get_template_directory_uri() . '/js/foundation/foundation.section.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 tooltips
		// wp_enqueue_script( 'foundation.tooltips', get_template_directory_uri() . '/js/foundation/foundation.tooltips.js', array( 'foundation' ), $foundation4_version, true );
		// foundation4 topbar
		wp_enqueue_script( 'foundation.topbar', get_template_directory_uri() . '/js/foundation/foundation.topbar.js', array( 'foundation' ), $foundation4_version, true );

		// @since _s
		wp_enqueue_script( 'foundation4blogtheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'foundation4blogtheme-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'foundation4blogtheme_scripts' );


/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * WordPress.com-specific functions and definitions.
 */
//require get_template_directory() . '/inc/wpcom.php';
