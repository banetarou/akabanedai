<?php
/**
 * Page template for static content within the gallery layout.
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-entry' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="entry-image"><?php the_post_thumbnail( 'large' ); ?></div>
            <?php endif; ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;
endif;

get_footer();
