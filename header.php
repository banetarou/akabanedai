<?php
/**
 * Header template responsible for rendering the document head and fixed sidebar navigation.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper site-frame">
    <aside class="site-header site-sidebar" role="banner">
        <div class="site-branding">
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
            </h1>
            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav class="site-navigation" aria-label="Primary menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'site-menu',
                        'depth'          => 1,
                    )
                );
                ?>
            </nav>
        <?php endif; ?>
    </aside>
    <main id="primary" class="content-area site-main" role="main">
