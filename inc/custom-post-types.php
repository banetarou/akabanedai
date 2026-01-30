<?php
/**
 * Custom post type registrations for the Akabanedai theme.
 */

/**
 * Register custom post types for the left column showcase.
 */
function akabane_register_custom_post_types() {
    register_post_type(
        'project',
        array(
            'labels'            => array(
                'name'          => __( 'Projects', 'minimal-gallery' ),
                'singular_name' => __( 'Project', 'minimal-gallery' ),
            ),
            'public'            => true,
            'has_archive'       => true,
            'menu_position'     => 5,
            'menu_icon'         => 'dashicons-format-gallery',
            'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug'       => 'project',
                'with_front' => false,
            ),
        )
    );

    register_post_type(
        'family',
        array(
            'labels'            => array(
                'name'          => __( 'Family', 'minimal-gallery' ),
                'singular_name' => __( 'Family Item', 'minimal-gallery' ),
            ),
            'public'            => true,
            'has_archive'       => true,
            'menu_position'     => 6,
            'menu_icon'         => 'dashicons-images-alt2',
            'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug'       => 'family',
                'with_front' => false,
            ),
        )
    );

    register_post_type(
        'about',
        array(
            'labels'            => array(
                'name'          => __( 'About', 'minimal-gallery' ),
                'singular_name' => __( 'About Entry', 'minimal-gallery' ),
            ),
            'public'            => true,
            'has_archive'       => true,
            'menu_position'     => 7,
            'menu_icon'         => 'dashicons-admin-users',
            'supports'          => array( 'title', 'editor', 'excerpt' ),
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug'       => 'about',
                'with_front' => false,
            ),
        )
    );

    register_post_type(
        'blog',
        array(
            'labels'            => array(
                'name'          => __( 'Blog', 'minimal-gallery' ),
                'singular_name' => __( 'Blog Entry', 'minimal-gallery' ),
            ),
            'public'            => true,
            'has_archive'       => true,
            'menu_position'     => 8,
            'menu_icon'         => 'dashicons-edit',
            'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug'       => 'blog',
                'with_front' => false,
            ),
        )
    );
}
add_action( 'init', 'akabane_register_custom_post_types' );
