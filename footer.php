<?php
/**
 * Footer template closing the layout wrapper and printing footer credits.
 */
?>
    </main><!-- #primary -->
</div><!-- .wrapper -->
<footer class="site-footer" role="contentinfo">
    <div class="wrapper">
        <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
