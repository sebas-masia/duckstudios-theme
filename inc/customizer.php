<?php
/**
 * Duck Studios Theme Customizer
 *
 * @package Duck_Studios
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function duck_studios_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'duck_studios_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'duck_studios_customize_partial_blogdescription',
            )
        );
    }
    
    // Contact Information Section
    $wp_customize->add_section('duck_studios_contact_info', array(
        'title'    => __('Contact Information', 'duck-studios'),
        'priority' => 120,
    ));
    
    // Phone
    $wp_customize->add_setting('duck_studios_phone', array(
        'default'           => '+506 7104-9909',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('duck_studios_phone', array(
        'label'    => __('Phone Number', 'duck-studios'),
        'section'  => 'duck_studios_contact_info',
        'type'     => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('duck_studios_email', array(
        'default'           => 'info@duckstudios.net',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('duck_studios_email', array(
        'label'    => __('Email Address', 'duck-studios'),
        'section'  => 'duck_studios_contact_info',
        'type'     => 'email',
    ));
    
    // Social Media Section
    $wp_customize->add_section('duck_studios_social_media', array(
        'title'    => __('Social Media', 'duck-studios'),
        'priority' => 130,
    ));
    
    // Facebook
    $wp_customize->add_setting('duck_studios_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('duck_studios_facebook', array(
        'label'    => __('Facebook URL', 'duck-studios'),
        'section'  => 'duck_studios_social_media',
        'type'     => 'url',
    ));
    
    // Twitter
    $wp_customize->add_setting('duck_studios_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('duck_studios_twitter', array(
        'label'    => __('Twitter URL', 'duck-studios'),
        'section'  => 'duck_studios_social_media',
        'type'     => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('duck_studios_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('duck_studios_instagram', array(
        'label'    => __('Instagram URL', 'duck-studios'),
        'section'  => 'duck_studios_social_media',
        'type'     => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('duck_studios_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('duck_studios_linkedin', array(
        'label'    => __('LinkedIn URL', 'duck-studios'),
        'section'  => 'duck_studios_social_media',
        'type'     => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('duck_studios_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('duck_studios_youtube', array(
        'label'    => __('YouTube URL', 'duck-studios'),
        'section'  => 'duck_studios_social_media',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'duck_studios_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function duck_studios_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function duck_studios_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function duck_studios_customize_preview_js() {
    wp_enqueue_script('duck-studios-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), DUCK_STUDIOS_VERSION, true);
}
add_action('customize_preview_init', 'duck_studios_customize_preview_js');
