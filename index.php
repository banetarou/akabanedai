<?php
/**
 * Index template displaying the vertical gallery of posts.
 */
get_header();
?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gallery-entry' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="entry-image"><?php the_post_thumbnail( 'large' ); ?></div>
            <?php endif; ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;
endif;
?>

<?php
get_footer();
