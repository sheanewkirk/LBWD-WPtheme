<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LBWD_Starter_2018
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				lbwd_starter_2018_posted_on();
				lbwd_starter_2018_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
<div class="post-content">
    <?php
		if ( is_singular() ) : ?>
    	<div class="entry-content">

		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lbwd-starter-2018' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lbwd-starter-2018' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
			
		<?php else :?>
    
    <?php if ( has_post_thumbnail() ) { ?>
       <div class="entry-thumbnail">
        <?php lbwd_starter_2018_post_thumbnail('thumbnail'); ?>
    </div>
    <?php }
    else {

    }
    ?>

	<div class="entry-content">

		<?php
		the_excerpt( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lbwd-starter-2018' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lbwd-starter-2018' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
<?php	endif;?>
    
</div>
	<footer class="entry-footer">
		<?php lbwd_starter_2018_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
