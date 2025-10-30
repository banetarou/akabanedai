<?php
/**
 * Page template implementing the intro layout and fallback for other pages.
 */

get_header();

if ( is_page( 'intro' ) ) {
    if ( have_posts() ) {
        ?>
        <main id="primary" class="site-main intro-page">
            <?php
            while ( have_posts() ) {
                the_post();
                $lead_text = get_post_meta( get_the_ID(), 'lead_text', true );
                if ( '' === $lead_text ) {
                    $lead_text = get_the_excerpt();
                }
                ?>
                <section class="intro-hero">
                    <p class="lead-text"><?php echo esc_html( $lead_text ); ?></p>
                </section>

                <section class="intro-body">
                    <?php the_content(); ?>
                </section>
                <?php
            }
            ?>
            <footer class="intro-footer">
                <p class="footer-note">© Akabane Project</p>
            </footer>
        </main>
        <?php
    }
} else {
    if ( have_posts() ) {
        ?>
        <main id="primary" class="site-main">
            <?php
            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content', 'page' );
            }
            ?>
        </main>
        <?php
    }
}

get_footer();
