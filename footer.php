<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LBWD_Starter_2018
 */

?>

	<!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="footer-widgets"><?php dynamic_sidebar( 'footer-widgets' ); ?></div>
		<div class="site-info">
            &copy; <?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><br>
			<span>Designed by <a href="http://www.longbeachwebdesign.com" title="Long Beach, CA Website Design, Ecommerce, Website Hosting, & Graphics" target="_blank">LBWD</a></span>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!--external links in new window-->
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
$('a').each(function() {
var a = new RegExp('/' + window.location.host + '/');
if(!a.test(this.href)) {
$(this).click(function(event) {
event.preventDefault();
event.stopPropagation();
window.open(this.href, '_blank');
});
}
});
});
//]]>
</script>

</body>
</html>
