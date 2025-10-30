<?php
/**
 * Index template displaying the vertical gallery of posts.
 */
get_header();

if ( have_posts() ) :
    echo '<div class="gallery-main">';

    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-entry fade-up' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="gallery-entry__thumbnail"><?php the_post_thumbnail( 'large' ); ?></figure>
            <?php endif; ?>
            <h2 class="gallery-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="gallery-entry__content"><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;

    echo '</div>';
else :
    ?>
    <p class="no-entries"><?php esc_html_e( 'No posts have been published yet.', 'minimal-gallery' ); ?></p>
    <?php
endif;

get_footer();
