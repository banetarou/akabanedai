<?php
/**
 * akabanedai functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package akabanedai
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
function akabanedai_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on akabanedai, use a find and replace
		* to change 'akabanedai' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'akabanedai', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'akabanedai' ),
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
			'akabanedai_custom_background_args',
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
add_action( 'after_setup_theme', 'akabanedai_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akabanedai_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'akabanedai_content_width', 640 );
}
add_action( 'after_setup_theme', 'akabanedai_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function akabanedai_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'akabanedai' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'akabanedai' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'akabanedai_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function akabanedai_scripts() {
	wp_enqueue_style( 'akabanedai-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'akabanedai-style', 'rtl', 'replace' );

	wp_enqueue_script( 'akabanedai-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'akabanedai_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Register custom post types used by the theme.
 */
function akabanedai_register_post_types() {
        $labels = array(
                'name'                  => _x( 'Works', 'Post Type General Name', 'akabanedai' ),
                'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'akabanedai' ),
                'menu_name'             => _x( 'Works', 'Admin Menu text', 'akabanedai' ),
                'name_admin_bar'        => _x( 'Work', 'Add New on Toolbar', 'akabanedai' ),
                'add_new'               => __( 'Add New', 'akabanedai' ),
                'add_new_item'          => __( 'Add New Work', 'akabanedai' ),
                'new_item'              => __( 'New Work', 'akabanedai' ),
                'edit_item'             => __( 'Edit Work', 'akabanedai' ),
                'view_item'             => __( 'View Work', 'akabanedai' ),
                'all_items'             => __( 'All Works', 'akabanedai' ),
                'search_items'          => __( 'Search Works', 'akabanedai' ),
                'parent_item_colon'     => __( 'Parent Works:', 'akabanedai' ),
                'not_found'             => __( 'No works found.', 'akabanedai' ),
                'not_found_in_trash'    => __( 'No works found in Trash.', 'akabanedai' ),
                'featured_image'        => __( 'Work Image', 'akabanedai' ),
                'set_featured_image'    => __( 'Set work image', 'akabanedai' ),
                'remove_featured_image' => __( 'Remove work image', 'akabanedai' ),
                'use_featured_image'    => __( 'Use as work image', 'akabanedai' ),
                'archives'              => __( 'Work archives', 'akabanedai' ),
                'insert_into_item'      => __( 'Insert into work', 'akabanedai' ),
                'uploaded_to_this_item' => __( 'Uploaded to this work', 'akabanedai' ),
                'filter_items_list'     => __( 'Filter works list', 'akabanedai' ),
                'items_list_navigation' => __( 'Works list navigation', 'akabanedai' ),
                'items_list'            => __( 'Works list', 'akabanedai' ),
        );

        $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'show_in_rest'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'works' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 20,
                'menu_icon'          => 'dashicons-portfolio',
                'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        );

        register_post_type( 'works', $args );
}
add_action( 'init', 'akabanedai_register_post_types' );

/**
 * Register taxonomies used by custom post types.
 */
function akabanedai_register_taxonomies() {
        $labels = array(
                'name'              => _x( 'Work Categories', 'taxonomy general name', 'akabanedai' ),
                'singular_name'     => _x( 'Work Category', 'taxonomy singular name', 'akabanedai' ),
                'search_items'      => __( 'Search Work Categories', 'akabanedai' ),
                'all_items'         => __( 'All Work Categories', 'akabanedai' ),
                'parent_item'       => __( 'Parent Work Category', 'akabanedai' ),
                'parent_item_colon' => __( 'Parent Work Category:', 'akabanedai' ),
                'edit_item'         => __( 'Edit Work Category', 'akabanedai' ),
                'update_item'       => __( 'Update Work Category', 'akabanedai' ),
                'add_new_item'      => __( 'Add New Work Category', 'akabanedai' ),
                'new_item_name'     => __( 'New Work Category Name', 'akabanedai' ),
                'menu_name'         => __( 'Work Categories', 'akabanedai' ),
        );

        $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'work-category' ),
                'show_in_rest'      => true,
        );

        register_taxonomy( 'work_category', array( 'works' ), $args );
}
add_action( 'init', 'akabanedai_register_taxonomies' );

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

