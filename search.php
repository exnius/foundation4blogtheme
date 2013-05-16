<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package foundation4blogtheme
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'foundation4blogtheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<?php // Pagination by WP SiteManager. http://www.wp-sitemanager.com/usage/pagenavi/ ?>
				<?php if ( class_exists( 'WP_SiteManager_page_navi' ) ) : ?>
					<div class="pagination-centered">
						<?php WP_SiteManager_page_navi::page_navi('elm_class=pagination&current_format=<a href="#">%d</a>'); ?>
					</div>
				<?php else : ?>
					<?php foundation4blogtheme_content_nav( 'nav-below' ); ?>
				<?php endif; ?>
			<?php endif; ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>