<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package akabanedai
 */

?>

        <footer id="colophon" class="site-footer">
                <div class="site-info">
				<?php echo wp_kses_post( __( '&copy; akabanedai', 'akabanedai' ) ); ?>
                </div><!-- .site-info -->
        </footer><!-- #colophon -->
                </div><!-- .site-main-column -->
        </div><!-- .site-layout -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
