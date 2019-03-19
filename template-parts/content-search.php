<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LBWD_Starter_2018
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			lbwd_starter_2018_posted_on();
			lbwd_starter_2018_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

<div class="post-content">
    <div class="entry-thumbnail">
        <?php lbwd_starter_2018_post_thumbnail('thumbnail'); ?>
    </div>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</div>
	<footer class="entry-footer">
		<?php lbwd_starter_2018_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
