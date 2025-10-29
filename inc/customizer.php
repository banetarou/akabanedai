<?php
/**
 * achirabe Theme Customizer
 *
 * @package achirabe
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function achirabe_customize_register( $wp_customize ) {
        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

        if ( isset( $wp_customize->selective_refresh ) ) {
                $wp_customize->selective_refresh->add_partial(
                        'blogname',
                        array(
                                'selector'        => '.site-title a',
                                'render_callback' => 'achirabe_customize_partial_blogname',
                        )
                );
                $wp_customize->selective_refresh->add_partial(
                        'blogdescription',
                        array(
                                'selector'        => '.site-description',
                                'render_callback' => 'achirabe_customize_partial_blogdescription',
                        )
                );
        }

        $wp_customize->add_section(
                'achirabe_front_page',
                array(
                        'title'       => __( 'Front Page', 'achirabe' ),
                        'priority'    => 30,
                        'description' => __( 'Controls the hero and section texts that appear on the front page.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_hero_title',
                array(
                        'default'           => __( 'DAI AKABANE', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                        'transport'         => 'postMessage',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_hero_title',
                array(
                        'label'   => __( 'Hero title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_hero_subtitle',
                array(
                        'default'           => __( 'Composer / Arranger', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                        'transport'         => 'postMessage',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_hero_subtitle',
                array(
                        'label'   => __( 'Hero subtitle', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_hero_image',
                array(
                        'sanitize_callback' => 'absint',
                )
        );

        $wp_customize->add_control(
                new WP_Customize_Image_Control(
                        $wp_customize,
                        'achirabe_front_hero_image',
                        array(
                                'label'   => __( 'Hero background image', 'achirabe' ),
                                'section' => 'achirabe_front_page',
                        )
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_hero_button_label',
                array(
                        'default'           => __( 'View Works', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_hero_button_label',
                array(
                        'label'   => __( 'Hero button label', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_hero_button_url',
                array(
                        'sanitize_callback' => 'achirabe_sanitize_url',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_hero_button_url',
                array(
                        'label'       => __( 'Hero button URL', 'achirabe' ),
                        'section'     => 'achirabe_front_page',
                        'type'        => 'url',
                        'description' => __( 'Link used for the hero call-to-action button.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_intro_title',
                array(
                        'default'           => __( 'ABOUT', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_intro_title',
                array(
                        'label'   => __( 'Introduction title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_intro_text',
                array(
                        'sanitize_callback' => 'achirabe_sanitize_textarea',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_intro_text',
                array(
                        'label'       => __( 'Introduction text', 'achirabe' ),
                        'section'     => 'achirabe_front_page',
                        'type'        => 'textarea',
                        'description' => __( 'Optional text that appears beneath the profile heading. If left empty the content of the front page will be shown.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_works_title',
                array(
                        'default'           => __( 'Works', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_works_title',
                array(
                        'label'   => __( 'Works section title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_works_description',
                array(
                        'default'           => __( 'Selected compositions and arrangements.', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_works_description',
                array(
                        'label'   => __( 'Works section description', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_works_link_label',
                array(
                        'default'           => __( 'View all works', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_works_link_label',
                array(
                        'label'       => __( 'Works link label', 'achirabe' ),
                        'section'     => 'achirabe_front_page',
                        'type'        => 'text',
                        'description' => __( 'Link text that points to the works archive.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_news_title',
                array(
                        'default'           => __( 'News', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_news_title',
                array(
                        'label'   => __( 'News section title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_news_description',
                array(
                        'default'           => __( 'Latest information and announcements.', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_news_description',
                array(
                        'label'   => __( 'News section description', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_news_link_label',
                array(
                        'default'           => __( 'View all news', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_news_link_label',
                array(
                        'label'   => __( 'News link label', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_personal_title',
                array(
                        'default'           => __( 'Personal Notes', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_personal_title',
                array(
                        'label'   => __( 'Personal section title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_personal_description',
                array(
                        'default'           => __( 'Updates and diaries.', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_personal_description',
                array(
                        'label'   => __( 'Personal section description', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_personal_link_label',
                array(
                        'default'           => __( 'More personal notes', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_personal_link_label',
                array(
                        'label'   => __( 'Personal link label', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_contact_title',
                array(
                        'default'           => __( 'Contact', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_contact_title',
                array(
                        'label'   => __( 'Contact title', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_contact_text',
                array(
                        'default'           => __( 'For scores, lessons, and other inquiries, please reach out from the form below.', 'achirabe' ),
                        'sanitize_callback' => 'achirabe_sanitize_textarea',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_contact_text',
                array(
                        'label'   => __( 'Contact text', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'textarea',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_contact_button_label',
                array(
                        'default'           => __( 'Contact Form', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_contact_button_label',
                array(
                        'label'   => __( 'Contact button label', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'text',
                )
        );

        $wp_customize->add_setting(
                'achirabe_front_contact_button_url',
                array(
                        'sanitize_callback' => 'achirabe_sanitize_url',
                )
        );

        $wp_customize->add_control(
                'achirabe_front_contact_button_url',
                array(
                        'label'   => __( 'Contact button URL', 'achirabe' ),
                        'section' => 'achirabe_front_page',
                        'type'    => 'url',
                )
        );

        $wp_customize->add_section(
                'achirabe_theme_options',
                array(
                        'title'    => __( 'Theme Options', 'achirabe' ),
                        'priority' => 40,
                )
        );

        $wp_customize->add_setting(
                'achirabe_header_cta_label',
                array(
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_header_cta_label',
                array(
                        'label'       => __( 'Header button label', 'achirabe' ),
                        'section'     => 'achirabe_theme_options',
                        'type'        => 'text',
                        'description' => __( 'Displayed next to the navigation.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_header_cta_url',
                array(
                        'sanitize_callback' => 'achirabe_sanitize_url',
                )
        );

        $wp_customize->add_control(
                'achirabe_header_cta_url',
                array(
                        'label'   => __( 'Header button URL', 'achirabe' ),
                        'section' => 'achirabe_theme_options',
                        'type'    => 'url',
                )
        );

        $wp_customize->add_setting(
                'achirabe_footer_contact',
                array(
                        'sanitize_callback' => 'achirabe_sanitize_textarea',
                )
        );

        $wp_customize->add_control(
                'achirabe_footer_contact',
                array(
                        'label'       => __( 'Footer contact information', 'achirabe' ),
                        'section'     => 'achirabe_theme_options',
                        'type'        => 'textarea',
                        'description' => __( 'Displayed above the copyright notice. You can include line breaks for address or email.', 'achirabe' ),
                )
        );

        $wp_customize->add_setting(
                'achirabe_footer_copyright',
                array(
                        'default'           => __( 'All rights reserved.', 'achirabe' ),
                        'sanitize_callback' => 'sanitize_text_field',
                )
        );

        $wp_customize->add_control(
                'achirabe_footer_copyright',
                array(
                        'label'   => __( 'Footer copyright text', 'achirabe' ),
                        'section' => 'achirabe_theme_options',
                        'type'    => 'text',
                )
        );
}
add_action( 'customize_register', 'achirabe_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function achirabe_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function achirabe_customize_partial_blogdescription() {
        bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function achirabe_customize_preview_js() {
        wp_enqueue_script( 'achirabe-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'achirabe_customize_preview_js' );

/**
 * Sanitizes textarea content.
 *
 * @param string $value The raw value from the customizer.
 */
function achirabe_sanitize_textarea( $value ) {
        return wp_kses_post( $value );
}

/**
 * Sanitizes URLs from customizer controls.
 *
 * @param string $value The raw value from the customizer.
 */
function achirabe_sanitize_url( $value ) {
        return esc_url_raw( $value );
}
