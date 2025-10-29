<?php
/**
 * Front page template for the achirabe theme.
 *
 * @package achirabe
 */

global $post;

get_header();

$hero_title             = get_theme_mod( 'achirabe_front_hero_title', __( 'DAI AKABANE', 'achirabe' ) );
$hero_subtitle          = get_theme_mod( 'achirabe_front_hero_subtitle', get_bloginfo( 'description' ) );
$hero_button_label      = get_theme_mod( 'achirabe_front_hero_button_label', __( 'View Works', 'achirabe' ) );
$hero_button_url        = get_theme_mod( 'achirabe_front_hero_button_url', '#' );
$hero_image_id          = get_theme_mod( 'achirabe_front_hero_image' );
$hero_image_url         = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : '';
$intro_title            = get_theme_mod( 'achirabe_front_intro_title', __( 'ABOUT', 'achirabe' ) );
$intro_text             = get_theme_mod( 'achirabe_front_intro_text', '' );
$works_title            = get_theme_mod( 'achirabe_front_works_title', __( 'Works', 'achirabe' ) );
$works_description      = get_theme_mod( 'achirabe_front_works_description', __( 'Selected compositions and arrangements.', 'achirabe' ) );
$personal_title         = get_theme_mod( 'achirabe_front_personal_title', __( 'Personal Notes', 'achirabe' ) );
$personal_description   = get_theme_mod( 'achirabe_front_personal_description', __( 'Updates and diaries.', 'achirabe' ) );
$contact_title          = get_theme_mod( 'achirabe_front_contact_title', __( 'Contact', 'achirabe' ) );
$contact_text           = get_theme_mod( 'achirabe_front_contact_text', __( 'For scores, lessons, and other inquiries, please reach out from the form below.', 'achirabe' ) );
$contact_button_label   = get_theme_mod( 'achirabe_front_contact_button_label', __( 'Contact Form', 'achirabe' ) );
$contact_button_url     = get_theme_mod( 'achirabe_front_contact_button_url', '#' );
$works_link_label       = get_theme_mod( 'achirabe_front_works_link_label', __( 'View all works', 'achirabe' ) );
$works_link_url         = get_post_type_archive_link( 'works' );
$personal_link_label    = get_theme_mod( 'achirabe_front_personal_link_label', __( 'More personal notes', 'achirabe' ) );
$personal_link_url      = get_post_type_archive_link( 'personal' );
$news_title             = get_theme_mod( 'achirabe_front_news_title', __( 'News', 'achirabe' ) );
$news_description       = get_theme_mod( 'achirabe_front_news_description', __( 'Latest information and announcements.', 'achirabe' ) );
$news_link_label        = get_theme_mod( 'achirabe_front_news_link_label', __( 'View all news', 'achirabe' ) );
$news_link_url          = get_permalink( get_option( 'page_for_posts' ) );
?>

<main id="primary" class="site-main front-page">
        <section class="front-hero<?php echo $hero_image_url ? ' has-background' : ''; ?>"<?php echo $hero_image_url ? ' style="background-image: url(' . esc_url( $hero_image_url ) . ');"' : ''; ?>>
                <div class="front-hero__overlay"></div>
                <div class="front-hero__content">
                        <?php if ( $hero_subtitle ) : ?>
                                <p class="front-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
                        <?php endif; ?>

                        <?php if ( $hero_title ) : ?>
                                <h1 class="front-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
                        <?php endif; ?>

                        <?php if ( $hero_button_label && $hero_button_url ) : ?>
                                <a class="front-hero__cta" href="<?php echo esc_url( $hero_button_url ); ?>"><?php echo esc_html( $hero_button_label ); ?></a>
                        <?php endif; ?>
                </div>
        </section>

        <section class="front-section front-intro" id="about">
                <div class="front-section__inner">
                        <?php if ( $intro_title ) : ?>
                                <div class="front-section__header">
                                        <h2 class="front-section__title"><?php echo esc_html( $intro_title ); ?></h2>
                                </div>
                        <?php endif; ?>

                        <?php if ( $intro_text || ( $post instanceof WP_Post && ! empty( $post->post_content ) ) ) : ?>
                                <div class="front-section__body">
                                        <?php
                                        if ( $intro_text ) {
                                                echo wp_kses_post( wpautop( $intro_text ) );
                                        } elseif ( $post instanceof WP_Post ) {
                                                echo wp_kses_post( apply_filters( 'the_content', $post->post_content ) );
                                        }
                                        ?>
                                </div>
                        <?php endif; ?>
                </div>
        </section>

        <section class="front-section front-works">
                <div class="front-section__inner">
                        <div class="front-section__header">
                                <?php if ( $works_title ) : ?>
                                        <h2 class="front-section__title"><?php echo esc_html( $works_title ); ?></h2>
                                <?php endif; ?>
                                <?php if ( $works_description ) : ?>
                                        <p class="front-section__description"><?php echo esc_html( $works_description ); ?></p>
                                <?php endif; ?>
                        </div>

                        <?php
                        $works_query = new WP_Query(
                                array(
                                        'post_type'      => 'works',
                                        'posts_per_page' => 6,
                                        'post_status'    => 'publish',
                                        'no_found_rows'  => true,
                                )
                        );
                        ?>

                        <div class="front-grid front-grid--works">
                                <?php if ( $works_query->have_posts() ) : ?>
                                        <?php
                                        while ( $works_query->have_posts() ) :
                                                $works_query->the_post();
                                                ?>
                                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'front-card front-card--work' ); ?>>
                                                        <a class="front-card__link" href="<?php the_permalink(); ?>">
                                                                <div class="front-card__thumbnail">
                                                                        <?php if ( has_post_thumbnail() ) : ?>
                                                                                <?php the_post_thumbnail( 'medium_large' ); ?>
                                                                        <?php endif; ?>
                                                                </div>
                                                                <div class="front-card__content">
                                                                        <h3 class="front-card__title"><?php the_title(); ?></h3>
                                                                        <?php if ( has_excerpt() ) : ?>
                                                                                <p class="front-card__excerpt"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 20, '…' ) ); ?></p>
                                                                        <?php endif; ?>
                                                                        <span class="front-card__arrow" aria-hidden="true">&rarr;</span>
                                                                </div>
                                                        </a>
                                                </article>
                                                <?php
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                <?php else : ?>
                                        <p class="front-section__empty"><?php esc_html_e( 'No works have been published yet.', 'achirabe' ); ?></p>
                                <?php endif; ?>
                        </div>

                        <?php if ( $works_link_label && $works_link_url ) : ?>
                                <div class="front-section__footer">
                                        <a class="front-section__link" href="<?php echo esc_url( $works_link_url ); ?>"><?php echo esc_html( $works_link_label ); ?></a>
                                </div>
                        <?php endif; ?>
                </div>
        </section>

        <section class="front-section front-news">
                <div class="front-section__inner">
                        <div class="front-section__header">
                                <?php if ( $news_title ) : ?>
                                        <h2 class="front-section__title"><?php echo esc_html( $news_title ); ?></h2>
                                <?php endif; ?>
                                <?php if ( $news_description ) : ?>
                                        <p class="front-section__description"><?php echo esc_html( $news_description ); ?></p>
                                <?php endif; ?>
                        </div>
                        <?php
                        $news_query = new WP_Query(
                                array(
                                        'post_type'      => 'post',
                                        'posts_per_page' => 3,
                                        'post_status'    => 'publish',
                                        'no_found_rows'  => true,
                                )
                        );
                        ?>
                        <div class="front-grid front-grid--news">
                                <?php if ( $news_query->have_posts() ) : ?>
                                        <?php
                                        while ( $news_query->have_posts() ) :
                                                $news_query->the_post();
                                                ?>
                                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'front-card front-card--news' ); ?>>
                                                        <a class="front-card__link" href="<?php the_permalink(); ?>">
                                                                <div class="front-card__meta">
                                                                        <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                                                </div>
                                                                <div class="front-card__content">
                                                                        <h3 class="front-card__title"><?php the_title(); ?></h3>
                                                                        <p class="front-card__excerpt"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 26, '…' ) ); ?></p>
                                                                        <span class="front-card__arrow" aria-hidden="true">&rarr;</span>
                                                                </div>
                                                        </a>
                                                </article>
                                                <?php
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                <?php else : ?>
                                        <p class="front-section__empty"><?php esc_html_e( 'No news posts have been published yet.', 'achirabe' ); ?></p>
                                <?php endif; ?>
                        </div>
                        <?php if ( $news_link_label && $news_link_url ) : ?>
                                <div class="front-section__footer">
                                        <a class="front-section__link" href="<?php echo esc_url( $news_link_url ); ?>"><?php echo esc_html( $news_link_label ); ?></a>
                                </div>
                        <?php endif; ?>
                </div>
        </section>

        <section class="front-section front-personal">
                <div class="front-section__inner">
                        <div class="front-section__header">
                                <?php if ( $personal_title ) : ?>
                                        <h2 class="front-section__title"><?php echo esc_html( $personal_title ); ?></h2>
                                <?php endif; ?>
                                <?php if ( $personal_description ) : ?>
                                        <p class="front-section__description"><?php echo esc_html( $personal_description ); ?></p>
                                <?php endif; ?>
                        </div>
                        <?php
                        $personal_query = new WP_Query(
                                array(
                                        'post_type'      => 'personal',
                                        'posts_per_page' => 3,
                                        'post_status'    => 'publish',
                                        'no_found_rows'  => true,
                                )
                        );
                        ?>
                        <div class="front-grid front-grid--personal">
                                <?php if ( $personal_query->have_posts() ) : ?>
                                        <?php
                                        while ( $personal_query->have_posts() ) :
                                                $personal_query->the_post();
                                                ?>
                                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'front-card front-card--personal' ); ?>>
                                                        <a class="front-card__link" href="<?php the_permalink(); ?>">
                                                                <div class="front-card__meta">
                                                                        <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                                                </div>
                                                                <div class="front-card__content">
                                                                        <h3 class="front-card__title"><?php the_title(); ?></h3>
                                                                        <?php if ( has_excerpt() ) : ?>
                                                                                <p class="front-card__excerpt"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 24, '…' ) ); ?></p>
                                                                        <?php endif; ?>
                                                                        <span class="front-card__arrow" aria-hidden="true">&rarr;</span>
                                                                </div>
                                                        </a>
                                                </article>
                                                <?php
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                <?php else : ?>
                                        <p class="front-section__empty"><?php esc_html_e( 'No personal posts have been published yet.', 'achirabe' ); ?></p>
                                <?php endif; ?>
                        </div>
                        <?php if ( $personal_link_label && $personal_link_url ) : ?>
                                <div class="front-section__footer">
                                        <a class="front-section__link" href="<?php echo esc_url( $personal_link_url ); ?>"><?php echo esc_html( $personal_link_label ); ?></a>
                                </div>
                        <?php endif; ?>
                </div>
        </section>

        <section class="front-section front-contact">
                <div class="front-section__inner">
                        <?php if ( $contact_title ) : ?>
                                <h2 class="front-section__title"><?php echo esc_html( $contact_title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $contact_text ) : ?>
                                <div class="front-section__body">
                                        <?php echo wp_kses_post( wpautop( $contact_text ) ); ?>
                                </div>
                        <?php endif; ?>
                        <?php if ( $contact_button_label && $contact_button_url ) : ?>
                                <div class="front-section__footer">
                                        <a class="front-section__cta" href="<?php echo esc_url( $contact_button_url ); ?>"><?php echo esc_html( $contact_button_label ); ?></a>
                                </div>
                        <?php endif; ?>
                </div>
        </section>
</main><!-- #primary -->

<?php
get_footer();
