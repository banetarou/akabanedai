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

        <aside class="sidebar">
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
                </header><!-- #masthead -->

                <nav id="site-navigation" class="sidebar__nav" aria-label="<?php esc_attr_e( 'Primary menu', 'akabanedai' ); ?>">
                        <?php
                        if ( has_nav_menu( 'menu-1' ) ) {
                                wp_nav_menu(
                                        array(
                                                'theme_location' => 'menu-1',
                                                'menu_id'        => 'primary-menu',
                                                'container'      => false,
                                                'items_wrap'     => '<ul>%3$s</ul>',
                                        )
                                );
                        } else {
                                echo '<ul>';
                                wp_list_pages(
                                        array(
                                                'title_li' => '',
                                        )
                                );
                                echo '</ul>';
                        }
                        ?>
                </nav>

                <?php
                $akabanedai_work_categories = get_terms(
                        array(
                                'taxonomy'   => 'work_category',
                                'hide_empty' => false,
                        )
                );

                if ( ! is_wp_error( $akabanedai_work_categories ) && ! empty( $akabanedai_work_categories ) ) :
                        ?>
                        <div class="sidebar__section">
                                <h2 class="sidebar__section-title"><?php esc_html_e( 'Works', 'akabanedai' ); ?></h2>
                                <nav class="sidebar__nav" aria-label="<?php esc_attr_e( 'Work categories', 'akabanedai' ); ?>">
                                        <ul>
                                                <?php foreach ( $akabanedai_work_categories as $akabanedai_work_category ) : ?>
                                                        <li><a href="<?php echo esc_url( get_term_link( $akabanedai_work_category ) ); ?>"><?php echo esc_html( $akabanedai_work_category->name ); ?></a></li>
                                                <?php endforeach; ?>
                                        </ul>
                                </nav>
                        </div>
                        <?php
                endif;
                ?>

                <footer class="sidebar__footer">
                        &copy;<?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
                </footer>
        </aside>

        <div class="main-content">
