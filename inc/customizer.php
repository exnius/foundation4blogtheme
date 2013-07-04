<?php
/**
 * foundation4blogtheme Theme Customizer
 *
 * @package foundation4blogtheme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function foundation4blogtheme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'foundation4blogtheme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function foundation4blogtheme_customize_preview_js() {
	wp_enqueue_script( 'foundation4blogtheme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'foundation4blogtheme_customize_preview_js' );

/**
 * テーマのプロパティ名を取得
 * @param   String  キー
 * @return  String  プロパティ名
 */

function get_theme_option_name( $key = null ) {
	if ( !empty( $key ) ) {
		return 'theme_mods_'.get_stylesheet().'['.$key.']';
	} else {
		return 'theme_mods_'.get_stylesheet();
	}
}

function foundation4blogtheme_customize_setup( $wp_customize ) {

	/**
	 * customize for Header.
	 */
	$wp_customize->add_section( 'foundation4blogtheme_header_scheme', array(
		'title'    => __('Header Scheme', 'foundation4blogtheme'),
		'priority' => 200,
	));

	// = Color Picker for header background color.
	$wp_customize->add_setting( get_theme_option_name( 'header_bg_color' ), array(
		'default'           => '2ba6cb',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, get_theme_option_name( 'header_bg_color' ), array(
		'label'    => __('Background Color', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_header_scheme',
		'settings' => get_theme_option_name( 'header_bg_color' ),
	)));

	// = Color Picker for header text color.
	$wp_customize->add_setting( get_theme_option_name( 'header_text_color' ) , array(
		'default'           => 'ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, get_theme_option_name( 'header_text_color' ), array(
		'label'    => __('Text Color', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_header_scheme',
		'settings' => get_theme_option_name( 'header_text_color' )	,
	)));

	// = header logo.
	$wp_customize->add_setting( get_theme_option_name( 'logo_image' ), array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, get_theme_option_name( 'logo_image' ), array(
		'label'    => __('Logo Image', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_header_scheme',
		'settings' => get_theme_option_name( 'logo_image' )
	)));

	/**
	 * customize for footer.
	 */
	$wp_customize->add_section( 'foundation4blogtheme_footer_scheme', array(
		'title'    => __('Footer Scheme', 'foundation4blogtheme'),
		'priority' => 210,
	));

	// = Text Input for Copyright
	$wp_customize->add_setting( get_theme_option_name( 'footer_text' ), array(
		'default'           => '&copy; ' . esc_html( get_bloginfo( 'name', 'display' ) ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( get_theme_option_name( 'footer_text' ), array(
		'label'      => __('Copyright', 'foundation4blogtheme'),
		'section'    => 'foundation4blogtheme_footer_scheme',
		'settings'   => get_theme_option_name( 'footer_text' ),
	));

	// = Color Picker for footer background color.
	$wp_customize->add_setting( get_theme_option_name( 'footer_bg_color' ), array(
		'default'           => '333333',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, get_theme_option_name( 'footer_bg_color' ), array(
		'label'    => __('Background Color', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_footer_scheme',
		'settings' => get_theme_option_name( 'footer_bg_color' ),
	)));

	// = Color Picker for footer text color.
	$wp_customize->add_setting( get_theme_option_name( 'footer_text_color' ) , array(
		'default'           => 'cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, get_theme_option_name( 'footer_text_color' ), array(
		'label'    => __('Text Color', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_footer_scheme',
		'settings' => get_theme_option_name( 'footer_text_color' )	,
	)));

	// = Color Picker for footer link color.
	$wp_customize->add_setting( get_theme_option_name( 'footer_link_color' ) , array(
		'default'           => 'ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, get_theme_option_name( 'footer_link_color' ), array(
		'label'    => __('Link Color', 'foundation4blogtheme'),
		'section'  => 'foundation4blogtheme_footer_scheme',
		'settings' => get_theme_option_name( 'footer_link_color' )	,
	)));

}
add_action( 'customize_register', 'foundation4blogtheme_customize_setup' );

/**
 * テーマ編集反映
 */
// wp_print_stylesアクションにフックしてスタイルを追加
add_action( 'wp_head', 'foundation4blogtheme_customize_style' );
function foundation4blogtheme_customize_style() {
	// get_theme_modsでテーマのプロパティを取得（theme_mods_テーマスラッグの値が返される）
	$options = get_theme_mods();
	?>
	<style type="text/css" id="foundation4blogtheme_customize_style">
		<?php if ( !empty( $options['header_bg_color'] ) ) : ?>
		.site-header {
			background-color: <?php echo esc_html( $options['header_bg_color'] ); ?>;
		}
		<?php endif; ?>
		<?php if ( !empty( $options['header_text_color'] ) ) : ?>
		.site-header, .site-header a, .site-description {
			color: <?php echo esc_html( $options['header_text_color'] ); ?>;
		}
		<?php endif; ?>
		<?php if ( !empty( $options['footer_bg_color'] ) ) : ?>
		.site-footer {
			background-color: <?php echo esc_html( $options['footer_bg_color'] ); ?>;
		}
		<?php endif; ?>
		<?php if ( !empty( $options['footer_text_color'] ) ) : ?>
		.site-footer {
			color: <?php echo esc_html( $options['footer_text_color'] ); ?>;
		}
		<?php endif; ?>
		<?php if ( !empty( $options['footer_link_color'] ) ) : ?>
		.site-footer a {
			color: <?php echo esc_html( $options['footer_link_color'] ); ?>;
		}
		<?php endif; ?>
	</style>
<?php
}

