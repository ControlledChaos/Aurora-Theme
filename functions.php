<?php
/**
 * Aurora Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aurora_Theme
 */

define( 'AURORA_THEME_VERSION', '1.0.0' );
define( 'AURORA_THEME_PATH', trailingslashit( get_template_directory() ) );
define( 'AURORA_THEME_URL', trailingslashit( get_template_directory_uri() ) );

add_action( 'after_setup_theme', 'aurora_theme_setup' );
/**
 * Set up theme defaults and registers support for various theme features.
 */
function aurora_theme_setup() {
	
	// Load the theme translation files.
	load_theme_textdomain( 'aurora-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress generate the title tags.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register a primary and social menu.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'aurora-theme' ),
		'social' => esc_html__( 'Social', 'aurora-theme' ),
	) );

	// Use HTML5 where possible.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aurora_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}

add_action( 'after_setup_theme', 'aurora_theme_content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aurora_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aurora_theme_content_width', 640 );
}

add_action( 'widgets_init', 'aurora_theme_widgets_init' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aurora_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aurora-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'aurora-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'wp_enqueue_scripts', 'aurora_theme_scripts' );
/**
 * Enqueue scripts and styles.
 */
function aurora_theme_scripts() {

	// Main theme CSS.
	wp_enqueue_style(
		'aurora-theme-style',
		AURORA_THEME_URL . 'dist/style.css',
		AURORA_THEME_VERSION
	);

	// Theme script bundle.
	wp_enqueue_script(
		'aurora-theme-navigation',
		AURORA_THEME_URL . '/dist/bundle.js',
		array(),
		AURORA_THEME_VERSION,
		true
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
