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
    <style>
        /* --------------------------------------------------------------
         * Fixed left column that holds the site title and navigation menu
         * -------------------------------------------------------------- */
        .site-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 25%;
            height: 100vh;
            padding: 3rem 2rem;
            background-color: #ffffff;
            font-family: '游明朝体', 'Yu Mincho', Georgia, serif;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        /* -----------------------------------------
         * Site title styling with hover state for link
         * ----------------------------------------- */
        .site-title,
        .site-title a {
            margin: 0;
            font-size: 1.75rem;
            color: #111111;
            text-decoration: none;
        }

        .site-title a:hover,
        .site-title a:focus {
            color: #555555;
            text-decoration: underline;
        }

        /* --------------------------------------------------
         * Navigation menu stack and hover effect (underline)
         * -------------------------------------------------- */
        .menu-list {
            list-style: none;
            margin: 2rem 0 0 0;
            padding: 0;
        }

        .menu-list li {
            line-height: 2em;
        }

        .menu-list a {
            color: #333333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .menu-list a:hover,
        .menu-list a:focus {
            color: #888888;
            text-decoration: underline;
        }

        /* ---------------------------------------
         * Content area offset to accommodate aside
         * --------------------------------------- */
        .content-area {
            margin-left: 25%;
            width: 75%;
            min-height: 100vh;
            padding: 3rem;
            box-sizing: border-box;
            font-family: '游明朝体', 'Yu Mincho', Georgia, serif;
        }

        /* ---------------------------------------
         * Vertical gallery presentation for posts
         * --------------------------------------- */
        .gallery-item {
            margin-bottom: 3rem;
        }

        .gallery-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .gallery-title {
            font-size: 1.5rem;
            margin: 1.5rem 0 1rem;
            color: #222222;
        }

        .gallery-description {
            color: #444444;
            line-height: 1.8;
        }

        @media (max-width: 960px) {
            /* --------------------------------------------------
             * Responsive adjustment for smaller viewports
             * -------------------------------------------------- */
            .site-sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content-area {
                margin-left: 0;
                width: 100%;
                padding: 2rem;
            }
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper layout">
    <aside class="site-header site-sidebar" role="banner">
        <!-- Site title linked to the homepage -->
        <h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        </h1>

        <!-- Primary navigation stacked vertically -->
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav class="site-navigation" aria-label="Primary menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'menu-list',
                        'depth'          => 1,
                    )
                );
                ?>
            </nav>
        <?php endif; ?>
    </aside>
    <main id="primary" class="content-area" role="main">
