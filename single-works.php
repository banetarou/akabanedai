<?php
/**
 * The template for displaying single works
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package akabanedai
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'works' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
