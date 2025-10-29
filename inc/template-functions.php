<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package achirabe
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function achirabe_body_classes( $classes ) {
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
add_filter( 'body_class', 'achirabe_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function achirabe_pingback_header() {
        if ( is_singular() && pings_open() ) {
                printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
        }
}
add_action( 'wp_head', 'achirabe_pingback_header' );

/**
 * Retrieves the public custom post types that should appear in the header navigation.
 *
 * @return array<WP_Post_Type> Array of custom post type objects.
 */
function achirabe_get_custom_post_type_objects() {
        $post_types = get_post_types(
                array(
                        'public'   => true,
                        '_builtin' => false,
                ),
                'objects'
        );

        if ( empty( $post_types ) ) {
                return array();
        }

        return array_filter(
                $post_types,
                static function ( $post_type ) {
                        if ( ! $post_type instanceof WP_Post_Type ) {
                                return false;
                        }

                        if ( empty( $post_type->has_archive ) ) {
                                return false;
                        }

                        return (bool) get_post_type_archive_link( $post_type->name );
                }
        );
}
