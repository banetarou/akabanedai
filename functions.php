<?php
/**
 * Theme setup and asset loading for the Akabane custom intro layout.
 *
 * @package Akabane_Custom
 */

function akabane_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'align-wide' );
    add_theme_support(
        'html5',
        array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' )
    );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/custom.css' );
}
add_action( 'after_setup_theme', 'akabane_theme_setup' );

function akabane_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'akabane' ),
        )
    );
}
add_action( 'after_setup_theme', 'akabane_register_menus' );

function akabane_enqueue_assets() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'akabane-style', get_stylesheet_uri(), array(), $theme_version );
    wp_enqueue_style(
        'akabane-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array( 'akabane-style' ),
        $theme_version
    );

    wp_enqueue_script(
        'akabane-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        $theme_version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'akabane_enqueue_assets' );
