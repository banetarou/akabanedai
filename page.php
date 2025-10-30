<?php
/**
 * Page template for static content within the gallery layout.
 */
get_header();

if ( have_posts() ) :
    ?>
    <section class="page-intro">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-intro__entry' ); ?>>
                <header class="page-intro__header">
                    <?php if ( has_excerpt() ) : ?>
                        <p class="page-intro__subtitle"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <?php endif; ?>

                    <h1 class="page-intro__title"><?php the_title(); ?></h1>
                </header>

                <div class="page-intro__content">
                    <?php the_content(); ?>
                </div>

                <?php
                wp_link_pages(
                    array(
                        'before' => '<nav class="page-intro__pagination" aria-label="' . esc_attr__( 'Page navigation', 'minimal-gallery' ) . '">',
                        'after'  => '</nav>',
                    )
                );
                ?>
            </article>
            <?php
        endwhile;
        ?>
    </section>
    <?php
endif;

get_footer();
