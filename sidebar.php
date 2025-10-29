<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package achirabe
 */

$recent_images = get_posts(
	array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => 12,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_parent__not_in' => array( 0 ),
	)
);

if ( empty( $recent_images ) ) {
	return;
}

$recent_images = array_values( $recent_images );
?>

<aside id="secondary" class="widget-area">
	<section class="widget widget_recent_images">
		<h2 class="widget-title"><?php esc_html_e( 'Recent Photos', 'achirabe' ); ?></h2>
		<div class="recent-images-grid">
			<?php
			foreach ( $recent_images as $image ) :
				$image_html = wp_get_attachment_image(
					$image->ID,
					'medium_large',
					false,
					array(
						'class'   => 'recent-image',
						'loading' => 'lazy',
					)
				);

				if ( ! $image_html ) {
					continue;
				}
				?>
				<a class="recent-image-link" href="<?php echo esc_url( wp_get_attachment_url( $image->ID ) ); ?>">
					<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
</aside><!-- #secondary -->
