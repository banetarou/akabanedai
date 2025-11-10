<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package akabanedai
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
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'akabanedai' ); ?></a>

        <div class="site-layout">
                <aside class="site-header-column">
                        <header id="masthead" class="site-header">
                                <div class="site-branding">
                                        <?php
                                        the_custom_logo();
                                        if ( is_front_page() && is_home() ) :
                                                ?>
                                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                                <?php
                                        else :
                                                ?>
                                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                                <?php
                                        endif;
                                        $akabanedai_description = get_bloginfo( 'description', 'display' );
                                        if ( $akabanedai_description || is_customize_preview() ) :
                                                ?>
                                                <p class="site-description"><?php echo $akabanedai_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                                        <?php endif; ?>
                                </div><!-- .site-branding -->

                                <div class="works-navigation">
                                        <p class="works-heading"><?php esc_html_e( 'Works', 'akabanedai' ); ?></p>
                                        <?php
                                        $akabanedai_work_categories = get_terms(
                                                array(
                                                        'taxonomy'   => 'work_category',
                                                        'hide_empty' => false,
                                                )
                                        );

                                        $akabanedai_blog_categories = get_terms(
                                                array(
                                                        'taxonomy'   => 'blog_category',
                                                        'hide_empty' => false,
                                                )
                                        );

                                        $akabanedai_has_blog_categories = ! is_wp_error( $akabanedai_blog_categories ) && ! empty( $akabanedai_blog_categories );
                                        $akabanedai_has_work_categories = ! is_wp_error( $akabanedai_work_categories ) && ! empty( $akabanedai_work_categories );

                                        if ( $akabanedai_has_work_categories || $akabanedai_has_blog_categories ) :
                                                ?>
                                                <ul class="works-category-list">
                                                        <?php
                                                        $akabanedai_blog_inserted = false;

                                                        if ( $akabanedai_has_work_categories ) {
                                                                foreach ( $akabanedai_work_categories as $akabanedai_work_category ) :
                                                                        ?>
                                                                        <li class="works-category-list__item"><a href="<?php echo esc_url( get_term_link( $akabanedai_work_category ) ); ?>"><?php echo esc_html( $akabanedai_work_category->name ); ?></a></li>
                                                                        <?php
                                                                        if ( $akabanedai_has_blog_categories && ! $akabanedai_blog_inserted ) {
                                                                                $akabanedai_work_category_slug      = sanitize_title( $akabanedai_work_category->slug );
                                                                                $akabanedai_work_category_name_slug = sanitize_title( $akabanedai_work_category->name );

                                                                                if ( 'about' === $akabanedai_work_category_slug || 'about' === $akabanedai_work_category_name_slug ) {
                                                                                        ?>
                                                                                        <li class="works-category-list__label works-category-list__label--blog"><?php esc_html_e( 'Blog', 'akabanedai' ); ?></li>
                                                                                        <?php foreach ( $akabanedai_blog_categories as $akabanedai_blog_category ) : ?>
                                                                                                <li class="works-category-list__item works-category-list__item--blog"><a href="<?php echo esc_url( get_term_link( $akabanedai_blog_category ) ); ?>"><?php echo esc_html( $akabanedai_blog_category->name ); ?></a></li>
                                                                                        <?php endforeach; ?>
                                                                                        <?php
                                                                                        $akabanedai_blog_inserted = true;
                                                                                }
                                                                        }
                                                                endforeach;
                                                        }

                                                        if ( $akabanedai_has_blog_categories && ! $akabanedai_blog_inserted ) {
                                                                ?>
                                                                <li class="works-category-list__label works-category-list__label--blog"><?php esc_html_e( 'Blog', 'akabanedai' ); ?></li>
                                                                <?php foreach ( $akabanedai_blog_categories as $akabanedai_blog_category ) : ?>
                                                                        <li class="works-category-list__item works-category-list__item--blog"><a href="<?php echo esc_url( get_term_link( $akabanedai_blog_category ) ); ?>"><?php echo esc_html( $akabanedai_blog_category->name ); ?></a></li>
                                                                <?php endforeach; ?>
                                                                <?php
                                                        }
                                                        ?>
                                                </ul>
                                        <?php endif; ?>
                                </div>

                                <nav id="site-navigation" class="main-navigation">
                                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'akabanedai' ); ?></button>
                                        <?php
                                        wp_nav_menu(
                                                array(
                                                        'theme_location' => 'menu-1',
                                                        'menu_id'        => 'primary-menu',
                                                )
                                        );
                                        ?>
                                </nav><!-- #site-navigation -->
                        </header><!-- #masthead -->
                </aside>

                <div class="site-main-column">
