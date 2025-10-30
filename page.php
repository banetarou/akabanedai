<?php
/**
 * Template Name: Intro Page
 * Description: Reproduces nishiyamaisao.com/intro layout
 *
 * @package Akabane_Custom
 */
get_header();
?>
<main id="primary" class="site-main intro-page">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <section class="intro-hero">
      <p class="lead-text"><?php echo esc_html( get_post_meta( get_the_ID(), 'lead_text', true ) ?: get_the_excerpt() ); ?></p>
    </section>

    <section class="intro-body">
      <?php get_template_part( 'template-parts/content', 'intro' ); ?>
    </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <footer class="intro-footer">
    <p class="footer-note">© Akabane Project</p>
  </footer>
</main>
<?php get_footer(); ?>
