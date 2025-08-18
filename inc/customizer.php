<?php
/**
 * CIRASICO Modern Theme Customizer
 *
 * @package CIRASICO_Modern
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cirasico_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'cirasico_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'cirasico_customize_partial_blogdescription',
            )
        );
    }

    // Hero Section
    $wp_customize->add_section('cirasico_hero', array(
        'title' => 'Secțiunea Hero',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default' => 'CIRASICO',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => 'Titlu Hero',
        'section' => 'cirasico_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Compania de Investiții și Reprezentanță Asigurări și Servicii Comerciale',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Subtitlu Hero',
        'section' => 'cirasico_hero',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('hero_button_text', array(
        'default' => 'Descoperă Serviciile Noastre',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('hero_button_text', array(
        'label' => 'Text Buton Hero',
        'section' => 'cirasico_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_button_url', array(
        'default' => '#services',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('hero_button_url', array(
        'label' => 'URL Buton Hero',
        'section' => 'cirasico_hero',
        'type' => 'url',
    ));

    // Contact Information
    $wp_customize->add_section('cirasico_contact', array(
        'title' => 'Informații Contact',
        'priority' => 35,
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default' => '+40 XXX XXX XXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label' => 'Telefon',
        'section' => 'cirasico_contact',
        'type' => 'text',
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => 'contact@cirasico.ro',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => 'Email',
        'section' => 'cirasico_contact',
        'type' => 'email',
    ));

    $wp_customize->add_setting('contact_address', array(
        'default' => 'România, București',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => 'Adresa',
        'section' => 'cirasico_contact',
        'type' => 'textarea',
    ));

    // Social Media
    $wp_customize->add_section('cirasico_social', array(
        'title' => 'Rețele Sociale',
        'priority' => 40,
    ));

    $wp_customize->add_setting('social_facebook', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('social_facebook', array(
        'label' => 'Facebook URL',
        'section' => 'cirasico_social',
        'type' => 'url',
    ));

    $wp_customize->add_setting('social_twitter', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('social_twitter', array(
        'label' => 'Twitter URL',
        'section' => 'cirasico_social',
        'type' => 'url',
    ));

    $wp_customize->add_setting('social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('social_linkedin', array(
        'label' => 'LinkedIn URL',
        'section' => 'cirasico_social',
        'type' => 'url',
    ));

    $wp_customize->add_setting('social_instagram', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('social_instagram', array(
        'label' => 'Instagram URL',
        'section' => 'cirasico_social',
        'type' => 'url',
    ));

    // Colors
    $wp_customize->add_setting('primary_red', array(
        'default' => '#d32f2f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_red', array(
        'label' => 'Roșu Principal',
        'section' => 'colors',
    )));

    $wp_customize->add_setting('secondary_red', array(
        'default' => '#b71c1c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_red', array(
        'label' => 'Roșu Secundar',
        'section' => 'colors',
    )));

    $wp_customize->add_setting('metallic_grey', array(
        'default' => '#607d8b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'metallic_grey', array(
        'label' => 'Gri Metalic',
        'section' => 'colors',
    )));

    $wp_customize->add_setting('ash_black', array(
        'default' => '#263238',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ash_black', array(
        'label' => 'Negru Cenușiu',
        'section' => 'colors',
    )));

    // Footer
    $wp_customize->add_section('cirasico_footer', array(
        'title' => 'Footer',
        'priority' => 45,
    ));

    $wp_customize->add_setting('footer_text', array(
        'default' => '&copy; ' . date('Y') . ' CIRASICO. Toate drepturile rezervate.',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('footer_text', array(
        'label' => 'Text Footer',
        'section' => 'cirasico_footer',
        'type' => 'textarea',
    ));

    // Performance
    $wp_customize->add_section('cirasico_performance', array(
        'title' => 'Performanță',
        'priority' => 50,
    ));

    $wp_customize->add_setting('enable_lazy_loading', array(
        'default' => true,
        'sanitize_callback' => 'cirasico_sanitize_checkbox',
    ));

    $wp_customize->add_control('enable_lazy_loading', array(
        'label' => 'Activează Lazy Loading pentru imagini',
        'section' => 'cirasico_performance',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('enable_minification', array(
        'default' => false,
        'sanitize_callback' => 'cirasico_sanitize_checkbox',
    ));

    $wp_customize->add_control('enable_minification', array(
        'label' => 'Activează minificarea CSS și JS',
        'section' => 'cirasico_performance',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'cirasico_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cirasico_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cirasico_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cirasico_customize_preview_js() {
    wp_enqueue_script('cirasico-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'cirasico_customize_preview_js');

/**
 * Sanitize checkbox
 */
function cirasico_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize select
 */
function cirasico_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Sanitize number
 */
function cirasico_sanitize_number($input) {
    return absint($input);
}

/**
 * Sanitize URL
 */
function cirasico_sanitize_url($input) {
    return esc_url_raw($input);
}

/**
 * Add custom CSS from customizer
 */
function cirasico_customizer_css() {
    $primary_red = get_theme_mod('primary_red', '#d32f2f');
    $secondary_red = get_theme_mod('secondary_red', '#b71c1c');
    $metallic_grey = get_theme_mod('metallic_grey', '#607d8b');
    $ash_black = get_theme_mod('ash_black', '#263238');
    
    ?>
    <style type="text/css">
        :root {
            --primary-red: <?php echo esc_attr($primary_red); ?>;
            --secondary-red: <?php echo esc_attr($secondary_red); ?>;
            --metallic-grey: <?php echo esc_attr($metallic_grey); ?>;
            --ash-black: <?php echo esc_attr($ash_black); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'cirasico_customizer_css');

/**
 * Add customizer preview script
 */
function cirasico_customizer_preview_script() {
    if (is_customize_preview()) {
        ?>
        <script>
        (function($) {
            'use strict';
            
            // Hero title
            wp.customize('hero_title', function(value) {
                value.bind(function(newval) {
                    $('.hero-title').text(newval);
                });
            });
            
            // Hero subtitle
            wp.customize('hero_subtitle', function(value) {
                value.bind(function(newval) {
                    $('.hero-subtitle').text(newval);
                });
            });
            
            // Hero button text
            wp.customize('hero_button_text', function(value) {
                value.bind(function(newval) {
                    $('.cta-button').text(newval);
                });
            });
            
            // Contact phone
            wp.customize('contact_phone', function(value) {
                value.bind(function(newval) {
                    $('.contact-phone').text(newval);
                });
            });
            
            // Contact email
            wp.customize('contact_email', function(value) {
                value.bind(function(newval) {
                    $('.contact-email').text(newval);
                    $('.contact-email').attr('href', 'mailto:' + newval);
                });
            });
            
            // Contact address
            wp.customize('contact_address', function(value) {
                value.bind(function(newval) {
                    $('.contact-address').text(newval);
                });
            });
            
            // Footer text
            wp.customize('footer_text', function(value) {
                value.bind(function(newval) {
                    $('.footer-copyright').html(newval);
                });
            });
            
        })(jQuery);
        </script>
        <?php
    }
}
add_action('wp_footer', 'cirasico_customizer_preview_script'); 