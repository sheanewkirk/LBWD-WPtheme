<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package LBWD_Starter_2018
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lbwd_starter_2018_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'lbwd_starter_2018_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function lbwd_starter_2018_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'lbwd_starter_2018_pingback_header' );



/**
* Add page slug to body class, love this - Credit: Starkers Wordpress Theme
 */

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');



/**
 * Remove related videos at end of all Youtube embeds
 */


function lbwd_starter_2018_youtube_no_related($html,$url,$args){
$url_string = parse_url($url, PHP_URL_QUERY);
parse_str($url_string, $id);
if (isset($id['v'])) {
return '<iframe width="'.$args['width'].'" height="'.$args['height'].'" src="http://www.youtube.com/embed/'.$id['v'].'?rel=0" frameborder="0" allowfullscreen></iframe>';
}
return $html;
}
add_filter('oembed_result','lbwd_starter_2018_youtube_no_related',10,3);



/**
 * Open all external links in new tab
 */

function lbwd_starter_2018_change_target($content){
	return preg_replace_callback('/<a[^>]+/', 'lbwd_starter_2018_target_callback', $content);
}

function lbwd_starter_2018_target_callback($matches){
	$link = $matches[0];
	$mu_url = get_bloginfo('url');

	if (strpos($link, 'target') === false){
    	$link = preg_replace("%(href=['|\"](?!(mailto:|$mu_url)).+['|\"])%i", 'target="_blank" $1', $link);
	}elseif (preg_match("%href=['|\"](?!(mailto:|$mu_url)).+['|\"]%i", $link)){
    	$link = preg_replace('/target=["|\'](?!_blank).+[\'|"]/i', 'target="_blank"', $link);
}
	return $link;
}
add_filter('the_content', 'lbwd_starter_2018_change_target');


/**
 * Add favicon to admin & login
 */

function add_site_favicon() {
	echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/img/icons/favicon.ico" />';
}
  
add_action('login_head', 'add_site_favicon');
add_action('admin_head', 'add_site_favicon');


/**
 * Registers an editor stylesheet for the theme.
 */

function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'mce-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


/**
 * Adds a Featured Image column to the admin post screens.
 */

// GET FEATURED IMAGE
function lbwd_starter_2018_get_admin_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
        return $post_thumbnail_img[0];
    }
}
// ADD NEW COLUMN
function lbwd_starter_2018_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function lbwd_starter_2018_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = lbwd_starter_2018_get_admin_image($post_ID);
        if ($post_featured_image) {
            echo '<img style="width:50px;height:50px;" src="' . $post_featured_image . '" />';
        }
    }
}
add_filter('manage_posts_columns', 'lbwd_starter_2018_columns_head');
add_action('manage_posts_custom_column', 'lbwd_starter_2018_columns_content', 10, 2);


/**
 * Add responsive container to embeds
 */

function lbwd_starter_2018_responsive_embeds( $content ) {
	$content = preg_replace( "/<object/Si", '<div class="video-container"><object', $content );
	$content = preg_replace( "/<\/object>/Si", '</object></div>', $content );
	
	/**
	 * Added iframe filtering, iframes are bad.
	 */
	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="video-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
	$content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );
	return $content;
}
add_filter( 'the_content', 'lbwd_starter_2018_responsive_embeds' );




/**
 * Adds the option for columns back to the Screen Options.
 */

function lbwd_starter_2018_dashboard_columns() {
    add_screen_option(
        'layout_columns',
        array(
            'max'     => 4,
            'default' => 2
        )
    );
}
add_action( 'admin_head-index.php', 'lbwd_starter_2018_dashboard_columns' );


/**
 * Custom View Article link to Post
 */

function lbwd_starter_2018_view_article($more)
{
    global $post;
    return '... <a class="read-more" href="' . get_permalink($post->ID) . '">' . __('Read More', 'lbwd-starter-2018') . '</a>';
}
add_filter('excerpt_more', 'lbwd_starter_2018_view_article'); // Add 'View Article' button instead of [...] for Excerpts


/**
 * Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
 */

function lbwd_starter_2018_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
add_action('init', 'lbwd_starter_2018_pagination'); // Add our default Pagination


/**
 * Font Awesome
 */

//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css'); 
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

/**
 * Disable XMLRPC.php features
 */

//add_filter(‘xmlrpc_enabled’, ‘__return_false’);
