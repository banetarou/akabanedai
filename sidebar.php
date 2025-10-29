<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package achirabe
 */

$works_query = new WP_Query(
        array(
                'post_type'           => 'works',
                'posts_per_page'      => 3,
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
        )
);

if ( ! $works_query->have_posts() ) {
        return;
}

$works_markup = '';

while ( $works_query->have_posts() ) {
        $works_query->the_post();

        $thumbnail_html = get_the_post_thumbnail(
                get_the_ID(),
                'achirabe-works-square',
                array(
                        'class'   => 'recent-works-image',
                        'loading' => 'lazy',
                )
        );

        if ( ! $thumbnail_html ) {
                continue;
        }

        $works_markup .= sprintf(
                '<a class="recent-works-link" href="%1$s">%2$s</a>',
                esc_url( get_permalink() ),
                $thumbnail_html
        );
}

wp_reset_postdata();

if ( '' === $works_markup ) {
        return;
}
?>

<aside id="secondary" class="widget-area">
        <section class="widget widget_recent_works">
                <h2 class="widget-title"><?php esc_html_e( 'Works', 'achirabe' ); ?></h2>
                <div class="recent-works-grid">
                        <?php echo $works_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
        </section>
</aside><!-- #secondary -->
