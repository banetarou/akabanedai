<?php
/**
 * Template Name: Gallery Layout
 * Description: 左カラムにナビ、右カラムにギャラリーを表示
 *
 * @package Akabane_Custom
 */

global $post;

get_header();
?>
<main id="primary" class="site-main two-column-layout">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) :
      the_post();
      ?>
      <aside class="site-sidebar">
        <div class="site-branding">
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
          <p class="site-description"><?php bloginfo( 'description' ); ?></p>
        </div>
        <nav class="site-nav">
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'menu_id'        => 'primary-menu',
              'fallback_cb'    => 'wp_page_menu',
            )
          );
          ?>
        </nav>
      </aside>

      <section class="gallery-area">
        <header class="intro-header">
          <h2 class="page-title"><?php the_title(); ?></h2>
        </header>

        <?php
        $gallery_query = new WP_Query(
          array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
          )
        );

        if ( $gallery_query->have_posts() ) :
          echo '<div class="gallery-grid">';
          while ( $gallery_query->have_posts() ) :
            $gallery_query->the_post();
            ?>
            <figure class="gallery-item">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="gallery-link">
                  <?php the_post_thumbnail( 'large' ); ?>
                </a>
              <?php endif; ?>
              <figcaption class="gallery-caption"><?php the_title(); ?></figcaption>
            </figure>
            <?php
          endwhile;
          echo '</div>';
          wp_reset_postdata();
        else :
          echo '<p>' . esc_html__( 'まだ投稿がありません。', 'akabane' ) . '</p>';
        endif;
        ?>
      </section>
      <?php
    endwhile;
  endif;
  ?>
</main>
<?php
get_footer();
