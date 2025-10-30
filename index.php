<?php
/**
 * Index template displaying the vertical gallery of posts.
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-item' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="gallery-image">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>
            <div class="gallery-caption">
                <h2 class="gallery-title"><?php the_title(); ?></h2>
                <div class="gallery-description">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php
    endwhile;
else :
    ?>
    <p><?php esc_html_e( 'No works available at the moment.', 'minimal-gallery' ); ?></p>
    <?php
endif;

get_footer();
