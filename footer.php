<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package achirabe
 */

?>

        <footer id="colophon" class="site-footer">
                <div class="site-footer__inner">
                        <div class="site-footer__brand">
                                <span class="site-footer__title"><?php bloginfo( 'name' ); ?></span>
                                <?php if ( get_bloginfo( 'description' ) ) : ?>
                                        <span class="site-footer__description"><?php bloginfo( 'description' ); ?></span>
                                <?php endif; ?>
                        </div>

                        <?php
                        $achirabe_footer_contact = get_theme_mod( 'achirabe_footer_contact', '' );
                        if ( $achirabe_footer_contact ) :
                                ?>
                                <div class="site-footer__contact">
                                        <?php echo wp_kses_post( wpautop( $achirabe_footer_contact ) ); ?>
                                </div>
                        <?php endif; ?>

                        <div class="site-footer__meta">
                                <?php
                                $achirabe_footer_copyright = get_theme_mod( 'achirabe_footer_copyright', __( 'All rights reserved.', 'achirabe' ) );
                                ?>
                                <small>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php echo esc_html( $achirabe_footer_copyright ); ?></small>
                        </div>
                </div><!-- .site-footer__inner -->
        </footer><!-- #colophon -->
                </div><!-- .site-main-column -->
        </div><!-- .site-layout -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
