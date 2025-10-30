<?php
/**
 * Page template implementing the two-column intro layout.
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'intro' );
    endwhile;
endif;

get_footer();
