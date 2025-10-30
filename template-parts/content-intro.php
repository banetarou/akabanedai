<?php
/**
 * Template part rendering a static page in the Nishiyama-inspired intro layout.
 */

$post_id   = get_the_ID();
$subtitle  = get_post_meta( $post_id, 'page_subtitle', true );
$subtitle  = $subtitle ? $subtitle : get_post_meta( $post_id, 'intro_subtitle', true );
$subtitle  = $subtitle ? $subtitle : __( 'INTRODUCTION', 'minimal-gallery' );
$note_meta = get_post_meta( $post_id, 'page_note', true );

$formatted_content = apply_filters( 'the_content', get_the_content() );
$structure         = minimal_gallery_split_intro_content( $formatted_content );
$intro_html        = $structure['intro'];
$sections          = $structure['sections'];

$lead_html = '';
$note_html = '';

if ( $intro_html ) {
    if ( preg_match( '/<p[^>]*>.*?<\/p>/i', $intro_html, $matches ) ) {
        $lead_html  = $matches[0];
        $intro_html = trim( str_replace( $matches[0], '', $intro_html, 1 ) );
    }

    if ( '' !== $intro_html ) {
        $note_html = $intro_html;
    }
}

if ( '' === $note_html && $note_meta ) {
    $note_html = wpautop( $note_meta );
}

$pagination = wp_link_pages(
    array(
        'before'      => '<nav class="page-intro__pagination" aria-label="' . esc_attr__( 'Pagination', 'minimal-gallery' ) . '">',
        'after'       => '</nav>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'echo'        => false,
    )
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-intro' ); ?>>
    <div class="page-intro__entry">
        <header class="page-intro__header fade-up">
            <?php if ( $subtitle ) : ?>
                <p class="page-intro__subtitle"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>

            <?php the_title( '<h1 class="page-intro__title">', '</h1>' ); ?>

            <?php if ( $lead_html ) : ?>
                <div class="page-intro__lead"><?php echo $lead_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
            <?php endif; ?>

            <?php if ( $note_html ) : ?>
                <div class="page-intro__note"><?php echo $note_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
            <?php endif; ?>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="page-intro__featured fade-up">
                <?php the_post_thumbnail( 'large' ); ?>
            </figure>
        <?php endif; ?>

        <?php if ( $sections ) : ?>
            <?php foreach ( $sections as $section ) : ?>
                <section class="page-intro__section fade-up">
                    <?php echo $section['heading']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php if ( ! empty( $section['body'] ) ) : ?>
                        <div class="page-intro__section-content text-block">
                            <?php echo $section['body']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>
        <?php elseif ( $formatted_content ) : ?>
            <div class="page-intro__section fade-up text-block">
                <?php echo $formatted_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        <?php endif; ?>

        <?php if ( $pagination ) : ?>
            <?php echo $pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php endif; ?>
    </div>

    <?php
    edit_post_link(
        sprintf(
            /* translators: %s: Post title. */
            esc_html__( 'Edit %s', 'minimal-gallery' ),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ),
        '<footer class="page-intro__footer">',
        '</footer>'
    );
    ?>
</article>
