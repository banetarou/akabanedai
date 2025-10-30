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
<header id="masthead" class="site-header" role="banner">
    <div class="site-branding">
        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <?php
        $minimal_gallery_description = get_bloginfo( 'description', 'display' );
        if ( $minimal_gallery_description ) :
            ?>
            <p class="site-description"><?php echo esc_html( $minimal_gallery_description ); ?></p>
        <?php endif; ?>
    </div>

    <nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'minimal-gallery' ); ?>">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => '',
                'depth'          => 1,
                'fallback_cb'    => 'minimal_gallery_primary_menu_fallback',
            )
        );
        ?>
    </nav>
</header>

<div class="wrapper site-frame">
    <main id="primary" class="site-main" role="main">
