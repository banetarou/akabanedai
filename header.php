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
<header class="site-header" role="banner">
    <h1 class="site-title">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
    </h1>

    <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'achirabe' ); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'depth'          => 1,
                )
            );
            ?>
        </nav>
    <?php endif; ?>
</header>

<div class="wrapper site-frame">
    <main id="primary" class="site-main" role="main">
