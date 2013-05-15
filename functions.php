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
	$content_width = 790; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

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
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

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
	//add_theme_support( 'post-thumbnails' );

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
}
endif; // foundation4blogtheme_setup
add_action( 'after_setup_theme', 'foundation4blogtheme_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function foundation4blogtheme_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'foundation4blogtheme_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'foundation4blogtheme_register_custom_background' );

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
		wp_enqueue_style( 'foundation4blogtheme-style', get_stylesheet_uri(), array(), '20130514' );
		wp_enqueue_style( 'ie8-grid-foundation-4', get_template_directory_uri() . '/ie8-grid-foundation-4.css', array( 'foundation4blogtheme-style' ), '20130514' );
		$wp_styles->add_data( 'ie8-grid-foundation-4', 'conditional', 'lt IE 9' );
	
		wp_enqueue_script( 'jquery' );
		// foundation4
		wp_enqueue_script( 'custom.modernizr', get_template_directory_uri() . '/javascripts/vendor/custom.modernizr.js', array(), 'Foundation4', true );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/javascripts/foundation/foundation.js', array(), 'Foundation4', true );
		// foundation4 alert
		// wp_enqueue_script( 'foundation.alerts', get_template_directory_uri() . '/javascripts/foundation/foundation.alerts.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 clearing
		wp_enqueue_script( 'foundation.clearing', get_template_directory_uri() . '/javascripts/foundation/foundation.clearing.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 cookie
		// wp_enqueue_script( 'foundation.cookie', get_template_directory_uri() . '/javascripts/foundation/foundation.cookie.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 dropdown
		// wp_enqueue_script( 'foundation.dropdown', get_template_directory_uri() . '/javascripts/foundation/foundation.dropdown.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 forms
		// wp_enqueue_script( 'foundation.forms', get_template_directory_uri() . '/javascripts/foundation/foundation.forms.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 joyride
		// wp_enqueue_script( 'foundation.joyride', get_template_directory_uri() . '/javascripts/foundation/foundation.joyride.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 magellan
		// wp_enqueue_script( 'foundation.magellan', get_template_directory_uri() . '/javascripts/foundation/foundation.magellan.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 orbit
		// wp_enqueue_script( 'foundation.orbit', get_template_directory_uri() . '/javascripts/foundation/foundation.orbit.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 placeholder
		// wp_enqueue_script( 'foundation.placeholder', get_template_directory_uri() . '/javascripts/foundation/foundation.placeholder.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 reveal
		// wp_enqueue_script( 'foundation.reveal', get_template_directory_uri() . '/javascripts/foundation/foundation.reveal.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 section
		// wp_enqueue_script( 'foundation.section', get_template_directory_uri() . '/javascripts/foundation/foundation.section.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 tooltips
		// wp_enqueue_script( 'foundation.tooltips', get_template_directory_uri() . '/javascripts/foundation/foundation.tooltips.js', array( 'foundation' ), 'Foundation4', true );
		// foundation4 topbar
		wp_enqueue_script( 'foundation.topbar', get_template_directory_uri() . '/javascripts/foundation/foundation.topbar.js', array( 'foundation' ), 'Foundation4', true );
	
	
		wp_enqueue_script( 'foundation4blogtheme-skip-link-focus-fix', get_template_directory_uri() . '/javascripts/skip-link-focus-fix.js', array(), '20130115', true );
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'foundation4blogtheme-keyboard-image-navigation', get_template_directory_uri() . '/javascripts/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'foundation4blogtheme_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );
