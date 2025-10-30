<?php
/**
 * Page template for static content within the gallery layout.
 */
get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-item' ); ?>>
        <div class="gallery-caption">
            <h1 class="gallery-title"><?php the_title(); ?></h1>
            <div class="gallery-description page-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
    <?php
endwhile;

get_footer();
