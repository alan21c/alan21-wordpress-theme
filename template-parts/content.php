<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alan21
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php alan21_post_thumbnail(); ?>
	
	<a class="secondary-thumbnail" href="<?php echo esc_url(get_permalink())?>">
		<?php if (class_exists('MultiPostThumbnails')) :
			MultiPostThumbnails::the_post_thumbnail(
				get_post_type(),
				'secondary-image'
			);
		endif; ?>
	</a>
	
	<header class="entry-header">
		
		<?php
		if ( !is_singular() ) :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		else :
			the_title( '<h1 class="entry-title">', '</h1>' );
			
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					alan21_posted_on();
					alan21_posted_by();
					?>
				</div><!-- .entry-meta -->
			
			<?php endif;
		endif; ?>
		
	</header><!-- .entry-header -->
	
	<?php if ( is_singular() ) : ?>
	
		<div class="entry-content">
			<?php
			
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'alan21' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alan21' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php alan21_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
