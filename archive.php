<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package foundation4blogtheme
 */

get_header(); ?>

	<section id="primary" class="content-area columns small-12 large-7">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							_e( 'Author Archives', 'foundation4blogtheme' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'foundation4blogtheme' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'foundation4blogtheme' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'foundation4blogtheme' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'foundation4blogtheme' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'foundation4blogtheme');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'foundation4blogtheme' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'foundation4blogtheme' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'foundation4blogtheme' );

						else :
							_e( 'Archives', 'foundation4blogtheme' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description ">%s</div>', $term_description );
					endif;

					if ( is_author() ) : the_post(); ?>
					<div class="author-info panel">
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
						</div><!-- .author-avatar -->

						<div class="author-description">
						<h3 class="author-name vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author_meta( 'display_name' ); ?>" rel="me"><?php the_author_meta( 'display_name' ); ?></a></h3>
						<?php
							$user_url = get_the_author_meta( 'user_url' );
							if ( ! empty( $user_url ) ) : ?>
						<div class="author-url"><a href="<?php the_author_meta( 'user_url' ); ?>" targer="blank" rel="author"><?php the_author_meta( 'user_url' ); ?></a></div>
						<?php endif; ?>
						<?php // show an optional user data
							$user_description = get_the_author_meta( 'description' );
							if ( ! empty( $user_description ) ) :
								echo '<div class="user_description">' . nl2br( esc_html( $user_description ) ) . "</div>\n";
						 endif; ?>
						</div><!-- .author-description -->
					</div><!-- .author-info panel -->
						<?
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

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

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>