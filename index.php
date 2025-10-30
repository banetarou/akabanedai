<?php
/**
 * Index template displaying the vertical gallery of posts.
 */
get_header();
?>

<section class="gallery-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-entry' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="gallery-entry__thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_the_title() ) : ?>
                    <h2 class="gallery-entry__title"><?php the_title(); ?></h2>
                <?php endif; ?>

                <div class="gallery-entry__content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'minimal-gallery' ) . '">',
                            'after'       => '</nav>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        )
                    );
                    ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <p class="no-entries"><?php esc_html_e( 'No works available at the moment.', 'minimal-gallery' ); ?></p>
        <?php
    endif;
    ?>
</section>

<?php
get_footer();
