<?php
/**
 * @package foundation4blogtheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
		<?php if ( 'post' == get_post_type() ) : ?>

		<div id="postedon" class="entry-meta">
			<?php foundation4blogtheme_posted_on(); ?>
			<?php if ( comments_open() ) : ?>
				<i class="genericon genericon-comment"></i>
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'foundation4blogtheme' ) . '</span>', __( '1 Comment', 'foundation4blogtheme' ), __( '% Comments', 'foundation4blogtheme' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'foundation4blogtheme' ), ' <span class="edit-link"><i class="genericon genericon-edit"></i>', '</span>' ); ?>
		</div><!-- #postedon.entry-meta -->

		<div id="postedcategory" class="entry-meta"><i class="genericon genericon-category"></i><?php the_category(', '); ?></div><!-- #postedcategory.entry-meta -->
		<?php
			$tag_list = get_the_tag_list( '', __( ', ', 'foundation4blogtheme' ) );
			if ( '' != $tag_list ) {
		?>
		<div id="postedtag" class="entry-meta"><?php echo ' <i class="genericon genericon-tag"></i>' . $tag_list; ?></div><!-- #postedtag.entry-meta -->
		<?php
			}
		?>

		<?php else : ?>

		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'foundation4blogtheme' ), '<span class="edit-link"><i class="genericon genericon-edit"></i>', '</span>' ); ?>
		</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <i class="genericon genericon-next"></i>', 'foundation4blogtheme' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'foundation4blogtheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
