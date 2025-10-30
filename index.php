<?php
/**
 * Index template displaying the vertical gallery of posts.
 */
get_header();
?>

<section class="gallery-list">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-item' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="gallery-media">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </figure>
                <?php endif; ?>

                <header class="gallery-header">
                    <h2 class="gallery-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </header>

                <div class="gallery-description">
                    <?php the_content(); ?>
                    <?php
                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimal-gallery' ),
                            'after'  => '</div>',
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
