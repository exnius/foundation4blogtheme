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
				<span class="sep"> | </span>
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'foundation4blogtheme' ) . '</span>', __( '1 Comment', 'foundation4blogtheme' ), __( '% Comments', 'foundation4blogtheme' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'foundation4blogtheme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</div><!-- #postedon.entry-meta -->

		<div id="postedin" class="entry-meta">
			<?php _e( 'Categories: ', 'foundation4blogtheme' ); the_category(', '); ?>
			<?php
				$tag_list = get_the_tag_list( '', __( ', ', 'foundation4blogtheme' ) );
				if ( '' != $tag_list ) {
					echo '<span class="sep"> | </span>';
					echo __( 'Tags: ', 'foundation4blogtheme' ) . $tag_list;
				}
			?>
		</div><!-- #postedin.entry-meta -->

		<?php else : ?>

		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'foundation4blogtheme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'foundation4blogtheme' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'foundation4blogtheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
