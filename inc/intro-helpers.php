<?php
/**
 * Helper functions used to structure intro style pages.
 */

if ( ! function_exists( 'minimal_gallery_split_intro_content' ) ) {
    /**
     * Convert a block of formatted content into structured sections that match the intro layout.
     *
     * @param string $content The formatted HTML content after applying the_content filters.
     *
     * @return array{intro:string,sections:array<int,array{heading:string,body:string}>}
     */
    function minimal_gallery_split_intro_content( $content ) {
        $content = trim( (string) $content );

        if ( '' === $content ) {
            return array(
                'intro'    => '',
                'sections' => array(),
            );
        }

        $pattern  = '~(<h2[^>]*>.*?</h2>)~is';
        $segments = preg_split( $pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );

        $intro = '';
        if ( $segments && stripos( $segments[0], '<h2' ) !== 0 ) {
            $intro = trim( array_shift( $segments ) );
        }

        $sections = array();

        while ( $segments ) {
            $heading = array_shift( $segments );
            $body    = '';

            if ( $segments && stripos( $segments[0], '<h2' ) !== 0 ) {
                $body = trim( array_shift( $segments ) );
            }

            $sections[] = array(
                'heading' => minimal_gallery_format_intro_heading( $heading ),
                'body'    => $body,
            );
        }

        return array(
            'intro'    => $intro,
            'sections' => $sections,
        );
    }
}

if ( ! function_exists( 'minimal_gallery_format_intro_heading' ) ) {
    /**
     * Append the intro section heading class to a heading string.
     *
     * @param string $heading_html Heading HTML string.
     *
     * @return string
     */
    function minimal_gallery_format_intro_heading( $heading_html ) {
        $heading_html = trim( (string) $heading_html );

        if ( '' === $heading_html ) {
            return '';
        }

        $class_name = 'page-intro__section-title';

        $double_quote_position = stripos( $heading_html, 'class="' );
        if ( false !== $double_quote_position ) {
            $insert_position = $double_quote_position + 7;
            return substr_replace( $heading_html, $class_name . ' ', $insert_position, 0 );
        }

        $single_quote_position = stripos( $heading_html, "class='" );
        if ( false !== $single_quote_position ) {
            $insert_position = $single_quote_position + 7;
            return substr_replace( $heading_html, $class_name . ' ', $insert_position, 0 );
        }

        $tag_position = stripos( $heading_html, '<h2' );

        if ( false === $tag_position ) {
            return $heading_html;
        }

        return substr_replace( $heading_html, '<h2 class="' . $class_name . '"', $tag_position, 3 );
    }
}
