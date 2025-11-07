<?php
/**
 * Sidebar collections displaying custom post types in the left column.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$has_content = false;
ob_start();

// Project images.
$project_query = new WP_Query(
    array(
        'post_type'           => 'project',
        'posts_per_page'      => 4,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
        'post_status'         => 'publish',
    )
);

if ( $project_query->have_posts() ) {
    $project_markup = '';

    while ( $project_query->have_posts() ) {
        $project_query->the_post();

        if ( ! has_post_thumbnail() ) {
            continue;
        }

        $project_markup .= sprintf(
            '<a class="sidebar-collection__thumb" href="%1$s">%2$s</a>',
            esc_url( get_permalink() ),
            get_the_post_thumbnail( get_the_ID(), 'medium_large' )
        );
    }

    if ( '' !== $project_markup ) {
        $has_content = true;
        ?>
        <section class="sidebar-collection sidebar-collection--images">
            <h2 class="sidebar-collection__title"><?php esc_html_e( 'Project', 'akabanedai' ); ?></h2>
            <div class="sidebar-collection__grid">
                <?php echo $project_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </section>
        <?php
    }
}
wp_reset_postdata();

// Family images.
$family_query = new WP_Query(
    array(
        'post_type'           => 'family',
        'posts_per_page'      => 4,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
        'post_status'         => 'publish',
    )
);

if ( $family_query->have_posts() ) {
    $family_markup = '';

    while ( $family_query->have_posts() ) {
        $family_query->the_post();

        if ( ! has_post_thumbnail() ) {
            continue;
        }

        $family_markup .= sprintf(
            '<a class="sidebar-collection__thumb" href="%1$s">%2$s</a>',
            esc_url( get_permalink() ),
            get_the_post_thumbnail( get_the_ID(), 'medium_large' )
        );
    }

    if ( '' !== $family_markup ) {
        $has_content = true;
        ?>
        <section class="sidebar-collection sidebar-collection--images">
            <h2 class="sidebar-collection__title"><?php esc_html_e( 'Family', 'akabanedai' ); ?></h2>
            <div class="sidebar-collection__grid">
                <?php echo $family_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </section>
        <?php
    }
}
wp_reset_postdata();

// About text.
$about_query = new WP_Query(
    array(
        'post_type'           => 'about',
        'posts_per_page'      => 1,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
        'post_status'         => 'publish',
    )
);

if ( $about_query->have_posts() ) {
    while ( $about_query->have_posts() ) {
        $about_query->the_post();

        $excerpt = get_the_excerpt();
        if ( ! $excerpt ) {
            $excerpt = wp_trim_words( wp_strip_all_tags( get_the_content() ), 40, '&hellip;' );
        }

        if ( $excerpt ) {
            $has_content = true;
            ?>
            <section class="sidebar-collection sidebar-collection--text">
                <h2 class="sidebar-collection__title"><?php esc_html_e( 'About', 'akabanedai' ); ?></h2>
                <div class="sidebar-collection__text text-block">
                    <?php echo wpautop( wp_kses_post( $excerpt ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            </section>
            <?php
        }
    }
}
wp_reset_postdata();

// Blog list.
$blog_query = new WP_Query(
    array(
        'post_type'           => 'blog',
        'posts_per_page'      => 3,
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
        'post_status'         => 'publish',
    )
);

if ( $blog_query->have_posts() ) {
    $blog_items = '';

    while ( $blog_query->have_posts() ) {
        $blog_query->the_post();

        $blog_items .= sprintf(
            '<li class="sidebar-collection__list-item"><a href="%1$s" class="sidebar-collection__list-link">%2$s</a><time class="sidebar-collection__list-date" datetime="%3$s">%4$s</time></li>',
            esc_url( get_permalink() ),
            esc_html( get_the_title() ),
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );
    }

    if ( '' !== $blog_items ) {
        $has_content = true;
        ?>
        <section class="sidebar-collection sidebar-collection--list">
            <h2 class="sidebar-collection__title"><?php esc_html_e( 'Blog', 'akabanedai' ); ?></h2>
            <ul class="sidebar-collection__list">
                <?php echo $blog_items; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </ul>
        </section>
        <?php
    }
}
wp_reset_postdata();

$content = trim( ob_get_clean() );

if ( ! $has_content || '' === $content ) {
    return;
}
?>

<div class="site-showcase">
    <?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
