<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package foundation4blogtheme
 */
?><!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner"><div class="row">
		<div class="site-branding columns small-12">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div></header><!-- #masthead -->

	<div id="site-navigation" class="site-navigation">
		<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'foundation4blogtheme' ); ?>"><?php _e( 'Skip to content', 'foundation4blogtheme' ); ?></a></div>
		<div class="row"><nav class="navigation-main top-bar" role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'foundation4blogtheme' ); ?> </a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span><?php _e( 'MENU', 'foundation4blogtheme' ); ?></span></a></li>
			</ul>

			<section class="top-bar-section">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="divider"></li>%3$s</ul>',  'menu_class' => 'left', 'fallback_cb' => 'foundation4blogtheme_page_menu', 'walker' => new foundation4blogtheme_walker_nav_menu ) ); ?>
			</section>
		</nav></div><!-- #site-navigation -->
	</div>

	<div id="main" class="site-main">

		<?php // Bread crumb navigation by WP SiteManager. http://www.wp-sitemanager.com/usage/breadcrumb/ ?>
		<?php if ( class_exists( 'WP_SiteManager_bread_crumb' ) ) : ?>
			<?php if ( ! is_front_page() ) : ?>
				<div id="site-breadcrumb" class="site-breadcrumb columns small-12">
					<?php WP_SiteManager_bread_crumb::bread_crumb('elm_class=breadcrumbs'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>