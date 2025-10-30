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

                <h2 class="gallery-entry__title"><?php the_title(); ?></h2>

                <div class="gallery-entry__content">
                    <?php the_content(); ?>
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
