<?php
/**
 * Theme setup declaring HTML5 support and registering assets for the gallery layout.
 */
function minimal_gallery_setup() {
    add_theme_support(
        'html5',
        array(
            'gallery',
            'caption',
            'search-form',
            'comment-form',
            'comment-list',
        )
    );

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'minimal-gallery' ),
        )
    );
}
add_action( 'after_setup_theme', 'minimal_gallery_setup' );

/**
 * Define the global content width to align embeds with the design width.
 */
function minimal_gallery_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'minimal_gallery_content_width', 900 );
}
add_action( 'after_setup_theme', 'minimal_gallery_content_width', 0 );

/**
 * Enqueue the main stylesheet for the theme.
 */
function minimal_gallery_enqueue_assets() {
    wp_enqueue_style( 'minimal-gallery-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'minimal_gallery_enqueue_assets' );

/**
 * Output a simple list of top-level pages when no custom menu is assigned.
 */
function minimal_gallery_primary_menu_fallback() {
    echo '<ul id="primary-menu" class="menu menu-fallback">';
    wp_list_pages(
        array(
            'title_li' => '',
            'depth'    => 1,
        )
    );
    echo '</ul>';
}
