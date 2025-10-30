<?php
/**
 * Front page template reusing the intro layout structure.
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'intro' );
    endwhile;
endif;

get_footer();
