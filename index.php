<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package akabanedai
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( is_front_page() || is_home() ) :
			$works_query = new WP_Query(
				array(
					'post_type'      => 'works',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
				)
			);

			if ( $works_query->have_posts() ) :
				?>
				<div class="works-grid">
					<?php
					while ( $works_query->have_posts() ) :
						$works_query->the_post();
						?>
						<article class="works-grid__item">
							<a
								class="works-grid__link"
								href="<?php the_permalink(); ?>"
								aria-label="<?php echo esc_attr( get_the_title() ); ?>"
							>
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail(
										'large',
										array(
											'class' => 'works-grid__image',
										)
									);
								} else {
									printf( '<span class="works-grid__placeholder" aria-hidden="true"></span>' );
								}
								?>
							</a>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;

			wp_reset_postdata();

		else :

			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
