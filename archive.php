<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package akabanedai
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			if ( is_post_type_archive( array( 'works', 'projects' ) ) || is_tax( array( 'work_category', 'project_category' ) ) ) :
				?>
				<div class="works-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$thumbnail_id = get_post_thumbnail_id();
						$aria_label   = the_title_attribute(
							array(
								'echo' => false,
							)
						);
						?>
						<article class="works-grid__item">
							<a class="works-grid__link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
								<?php if ( $thumbnail_id ) : ?>
									<?php echo wp_get_attachment_image( $thumbnail_id, 'large', false, array( 'class' => 'works-grid__image wp-post-image' ) ); ?>
								<?php else : ?>
									<span class="works-grid__placeholder" aria-hidden="true"></span>
								<?php endif; ?>
							</a>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php
				the_posts_navigation();
			else :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
