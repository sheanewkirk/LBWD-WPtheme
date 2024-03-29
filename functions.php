<?php
/**
 * LBWD Starter 2018 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package LBWD_Starter_2018
 */

 // CUSTOM FUNCTIONS
	// ==================================================
	require_once get_template_directory() . '/inc/custom-functions.php';

if ( ! function_exists( 'lbwd_starter_2018_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lbwd_starter_2018_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on LBWD Starter 2018, use a find and replace
		 * to change 'lbwd-starter-2018' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lbwd-starter-2018', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        add_image_size('large', 700, '', true); // Large Thumbnail
        add_image_size ('post-thumb', 325,225,array( 'center', 'center' ) ); // Default Post List thumbnail
        add_image_size('medium', 250, '', true); // Medium Thumbnail
        add_image_size('small', 120, '', true); // Small Thumbnail

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'lbwd-starter-2018' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'lbwd_starter_2018_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'lbwd_starter_2018_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lbwd_starter_2018_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'lbwd_starter_2018_content_width', 640 );
}
add_action( 'after_setup_theme', 'lbwd_starter_2018_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lbwd_starter_2018_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lbwd-starter-2018' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lbwd-starter-2018' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lbwd_starter_2018_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lbwd_starter_2018_scripts() {
	wp_enqueue_style( 'lbwd-starter-2018-style', get_stylesheet_uri() );
  	wp_enqueue_style('animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');
	wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/css/bootstrap-grid.min.css', false, '1.0', 'all' );
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css', false, '1.0', 'all' );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );
	wp_enqueue_script( 'lbwd-starter-2018-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'lbwd-starter-2018-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
  	wp_enqueue_script('wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), '', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lbwd_starter_2018_scripts' );
add_action( 'wp_enqueue_scripts', 'lbwd_wow_footer_init');
function lbwd_wow_footer_init() {
	add_action( 'print_footer_scripts', 'wow_init' );
}
//* Add JavaScript before </body>
function wow_init() { ?>
	<script type="text/javascript">
		new WOW().init();
	</script>
<?php }


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Limit Post Revisions
 */
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 10);
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);

/**
 * Gets Rid of Uncategorized Category
 */
 add_filter( 'get_terms', 'ts_get_subcategory_terms', 10, 3 );
 function ts_get_subcategory_terms( $terms, $taxonomies, $args ) {
 $new_terms = array();
 // if it is a product category and on the shop page
 if ( in_array( 'product_cat', $taxonomies ) && is_front_page()) {
 foreach( $terms as $key => $term ) {
 if ( !in_array( $term->slug, array('uncategorized') ) ) { //pass the slug name here
 $new_terms[] = $term;
 }}
 $terms = $new_terms;
 }
 return $terms;
 }
