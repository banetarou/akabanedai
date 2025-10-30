<?php
/**
 * Theme setup declaring HTML5 support for the gallery layout.
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

}
add_action( 'after_setup_theme', 'minimal_gallery_setup' );

// アイキャッチ画像を有効化
function akabane_theme_supports() {
    add_theme_support( 'post-thumbnails' );

    // タイトルタグサポート
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'akabane_theme_supports' );

// ナビゲーションメニュー登録
function akabane_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'akabane' ),
        )
    );
}
add_action( 'after_setup_theme', 'akabane_register_menus' );

/**
 * Define the global content width to align embeds with the design width.
 */
function minimal_gallery_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'minimal_gallery_content_width', 1200 );
}
add_action( 'after_setup_theme', 'minimal_gallery_content_width', 0 );

/**
 * Enqueue the main stylesheet for the theme.
 */
function minimal_gallery_enqueue_assets() {
    wp_enqueue_style( 'minimal-gallery-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'minimal_gallery_enqueue_assets' );
