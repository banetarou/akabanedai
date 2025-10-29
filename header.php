<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package achirabe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'achirabe' ); ?></a>

       <div class="site-layout">
               <header id="masthead" class="site-header">
                       <div class="site-header-inner">
                               <div class="site-header__column site-header__column--primary">
                                       <div class="site-header__title">
                                               <?php the_custom_logo(); ?>
                                               <?php
                                               $achirabe_fixed_title = 'DAI AKABANE';
                                               if ( is_front_page() && is_home() ) :
                                                       ?>
                                                       <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $achirabe_fixed_title ); ?></a></h1>
                                                       <?php
                                               else :
                                                       ?>
                                                       <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $achirabe_fixed_title ); ?></a></p>
                                                       <?php
                                               endif;
                                               $achirabe_description = get_bloginfo( 'description', 'display' );
                                               if ( $achirabe_description || is_customize_preview() ) :
                                                       ?>
                                                       <p class="site-description"><?php echo $achirabe_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                                               <?php endif; ?>
                                       </div><!-- .site-header__title -->

                                       <?php
                                       $achirabe_custom_post_types = achirabe_get_custom_post_type_objects();
                                       if ( $achirabe_custom_post_types ) :
                                               ?>
                                               <nav class="site-header__section site-header__section--post-types" aria-label="<?php esc_attr_e( 'Custom post types', 'achirabe' ); ?>">
                                                       <p class="site-header__section-label"><?php esc_html_e( 'Custom Post Type', 'achirabe' ); ?></p>
                                                       <ul class="site-header__section-list">
                                                               <?php foreach ( $achirabe_custom_post_types as $post_type ) : ?>
                                                                       <li class="site-header__section-item">
                                                                               <a class="site-header__section-link" href="<?php echo esc_url( get_post_type_archive_link( $post_type->name ) ); ?>"><?php echo esc_html( $post_type->labels->name ); ?></a>
                                                                       </li>
                                                               <?php endforeach; ?>
                                                       </ul>
                                               </nav>
                                       <?php endif; ?>

                                       <div class="site-header__section site-header__section--about">
                                               <a class="site-header__section-link" href="<?php echo esc_url( home_url( '#about' ) ); ?>"><?php esc_html_e( 'ABOUT', 'achirabe' ); ?></a>
                                       </div>
                               </div><!-- .site-header__column--primary -->

                               <div class="site-header__column site-header__column--secondary">
                                       <div class="site-header-controls">
                                               <nav id="site-navigation" class="main-navigation">
                                                       <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'achirabe' ); ?></button>
                                                       <?php
                                                       wp_nav_menu(
                                                               array(
                                                                       'theme_location' => 'menu-1',
                                                                       'menu_id'        => 'primary-menu',
                                                               )
                                                       );
                                                       ?>
                                               </nav><!-- #site-navigation -->
                                               <?php
                                               $achirabe_header_cta_label = get_theme_mod( 'achirabe_header_cta_label', '' );
                                               $achirabe_header_cta_url   = get_theme_mod( 'achirabe_header_cta_url', '' );
                                               if ( $achirabe_header_cta_label && $achirabe_header_cta_url ) :
                                                       ?>
                                                       <a class="site-header-cta" href="<?php echo esc_url( $achirabe_header_cta_url ); ?>"><?php echo esc_html( $achirabe_header_cta_label ); ?></a>
                                               <?php endif; ?>
                                       </div>
                               </div><!-- .site-header__column--secondary -->
                       </div>
               </header><!-- #masthead -->

                <div class="site-main-column">
