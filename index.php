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
			$top_page    = get_page_by_path( 'top' );
			$top_content = '';

			if ( $top_page ) {
				$top_content = apply_filters( 'the_content', $top_page->post_content );
			}

			$top_images = array();

			if ( ! empty( $top_content ) ) {
				libxml_use_internal_errors( true );
				$dom = new DOMDocument();
				$dom->loadHTML( mb_convert_encoding( $top_content, 'HTML-ENTITIES', 'UTF-8' ) );
				$xpath = new DOMXPath( $dom );
				$nodes = $xpath->query( '//img' );

				foreach ( $nodes as $image_node ) {
					$src = $image_node->getAttribute( 'src' );

					if ( empty( $src ) ) {
						continue;
					}

					$alt = $image_node->getAttribute( 'alt' );

					$link_node = $image_node->parentNode;
					$link_href = '';
					$link_aria = '';

					if ( $link_node && 'a' === $link_node->nodeName ) {
						$link_href = $link_node->getAttribute( 'href' );
						$link_aria = $link_node->getAttribute( 'aria-label' );

						if ( empty( $link_aria ) ) {
							$link_aria = trim( $link_node->textContent );
						}
					}

					if ( empty( $link_aria ) ) {
						$link_aria = $alt;
					}

					if ( empty( $link_href ) ) {
						$link_href = $src;
					}

					$top_images[] = array(
						'src'  => $src,
						'alt'  => $alt,
						'href' => $link_href,
						'aria' => $link_aria,
					);
				}
				libxml_clear_errors();
			}

			if ( ! empty( $top_images ) ) :
				?>
				<div class="works-grid">
					<?php
					foreach ( $top_images as $top_image ) :
						?>
						<article class="works-grid__item">
							<a
								class="works-grid__link"
								href="<?php echo esc_url( $top_image['href'] ); ?>"
								aria-label="<?php echo esc_attr( $top_image['aria'] ); ?>"
							>
								<img
									src="<?php echo esc_url( $top_image['src'] ); ?>"
									class="works-grid__image wp-post-image"
									alt="<?php echo esc_attr( $top_image['alt'] ); ?>"
								>
							</a>
						</article>
						<?php
					endforeach;
					?>
				</div>
				<?php
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;

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
get_footer();
