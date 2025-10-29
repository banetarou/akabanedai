<?php
/**
 * achirabe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package achirabe
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function achirabe_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on achirabe, use a find and replace
		* to change 'achirabe' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'achirabe', get_template_directory() . '/languages' );

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
        add_image_size( 'achirabe-showcase', 1440, 810, true );
        add_image_size( 'achirabe-works-square', 600, 600, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'achirabe' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'achirabe_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'achirabe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function achirabe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'achirabe_content_width', 640 );
}
add_action( 'after_setup_theme', 'achirabe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function achirabe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'achirabe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'achirabe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'achirabe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function achirabe_scripts() {
        wp_enqueue_style( 'achirabe-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@400;600&display=swap', array(), null );
        wp_enqueue_style( 'achirabe-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'achirabe-style', 'rtl', 'replace' );

	wp_enqueue_script( 'achirabe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'achirabe_scripts' );

/**
 * Register custom post types.
 */
function achirabe_register_custom_post_types() {
	$works_labels = array(
		'name'                  => _x( 'Works', 'Post Type General Name', 'achirabe' ),
		'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'achirabe' ),
		'menu_name'             => _x( 'Works', 'Admin Menu text', 'achirabe' ),
		'name_admin_bar'        => _x( 'Work', 'Add New on Toolbar', 'achirabe' ),
		'add_new'               => __( 'Add New', 'achirabe' ),
		'add_new_item'          => __( 'Add New Work', 'achirabe' ),
		'new_item'              => __( 'New Work', 'achirabe' ),
		'edit_item'             => __( 'Edit Work', 'achirabe' ),
		'view_item'             => __( 'View Work', 'achirabe' ),
		'all_items'             => __( 'All Works', 'achirabe' ),
		'search_items'          => __( 'Search Works', 'achirabe' ),
		'parent_item_colon'     => __( 'Parent Works:', 'achirabe' ),
		'not_found'             => __( 'No works found.', 'achirabe' ),
		'not_found_in_trash'    => __( 'No works found in Trash.', 'achirabe' ),
		'featured_image'        => __( 'Work Featured Image', 'achirabe' ),
		'set_featured_image'    => __( 'Set work featured image', 'achirabe' ),
		'remove_featured_image' => __( 'Remove work featured image', 'achirabe' ),
		'use_featured_image'    => __( 'Use as work featured image', 'achirabe' ),
		'archives'              => __( 'Work archives', 'achirabe' ),
		'insert_into_item'      => __( 'Insert into work', 'achirabe' ),
		'uploaded_to_this_item' => __( 'Uploaded to this work', 'achirabe' ),
		'filter_items_list'     => __( 'Filter works list', 'achirabe' ),
		'items_list_navigation' => __( 'Works list navigation', 'achirabe' ),
		'items_list'            => __( 'Works list', 'achirabe' ),
	);

	$personal_labels = array(
		'name'                  => _x( 'Personal', 'Post Type General Name', 'achirabe' ),
		'singular_name'         => _x( 'Personal', 'Post Type Singular Name', 'achirabe' ),
		'menu_name'             => _x( 'Personal', 'Admin Menu text', 'achirabe' ),
		'name_admin_bar'        => _x( 'Personal', 'Add New on Toolbar', 'achirabe' ),
		'add_new'               => __( 'Add New', 'achirabe' ),
		'add_new_item'          => __( 'Add New Personal', 'achirabe' ),
		'new_item'              => __( 'New Personal', 'achirabe' ),
		'edit_item'             => __( 'Edit Personal', 'achirabe' ),
		'view_item'             => __( 'View Personal', 'achirabe' ),
		'all_items'             => __( 'All Personal', 'achirabe' ),
		'search_items'          => __( 'Search Personal', 'achirabe' ),
		'parent_item_colon'     => __( 'Parent Personal:', 'achirabe' ),
		'not_found'             => __( 'No personal posts found.', 'achirabe' ),
		'not_found_in_trash'    => __( 'No personal posts found in Trash.', 'achirabe' ),
		'featured_image'        => __( 'Personal Featured Image', 'achirabe' ),
		'set_featured_image'    => __( 'Set personal featured image', 'achirabe' ),
		'remove_featured_image' => __( 'Remove personal featured image', 'achirabe' ),
		'use_featured_image'    => __( 'Use as personal featured image', 'achirabe' ),
		'archives'              => __( 'Personal archives', 'achirabe' ),
		'insert_into_item'      => __( 'Insert into personal post', 'achirabe' ),
		'uploaded_to_this_item' => __( 'Uploaded to this personal post', 'achirabe' ),
		'filter_items_list'     => __( 'Filter personal list', 'achirabe' ),
		'items_list_navigation' => __( 'Personal list navigation', 'achirabe' ),
		'items_list'            => __( 'Personal list', 'achirabe' ),
	);

	register_post_type(
		'works',
		array(
			'labels'             => $works_labels,
			'public'             => true,
			'has_archive'        => true,
			'menu_position'      => 5,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions' ),
			'rewrite'            => array( 'slug' => 'works' ),
			'publicly_queryable' => true,
		)
	);

	register_post_type(
		'personal',
		array(
			'labels'             => $personal_labels,
			'public'             => true,
			'has_archive'        => true,
			'menu_position'      => 6,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions' ),
			'rewrite'            => array( 'slug' => 'personal' ),
			'publicly_queryable' => true,
		)
	);
}
add_action( 'init', 'achirabe_register_custom_post_types' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

