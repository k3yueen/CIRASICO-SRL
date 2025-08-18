<?php
/**
 * CIRASICO Modern functions and definitions
 *
 * @package CIRASICO_Modern
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '2.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cirasico_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('cirasico-modern', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'cirasico-modern'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'cirasico_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for Gutenberg editor
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');
}
add_action('after_setup_theme', 'cirasico_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cirasico_content_width() {
    $GLOBALS['content_width'] = apply_filters('cirasico_content_width', 1200);
}
add_action('after_setup_theme', 'cirasico_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cirasico_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'cirasico-modern'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'cirasico-modern'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget 1', 'cirasico-modern'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here.', 'cirasico-modern'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget 2', 'cirasico-modern'),
            'id'            => 'footer-2',
            'description'   => esc_html__('Add widgets here.', 'cirasico-modern'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget 3', 'cirasico-modern'),
            'id'            => 'footer-3',
            'description'   => esc_html__('Add widgets here.', 'cirasico-modern'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action('widgets_init', 'cirasico_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function cirasico_scripts() {
    wp_enqueue_style('cirasico-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('cirasico-style', 'rtl', 'replace');

    wp_enqueue_script('cirasico-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cirasico_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Fallback menu function
 */
function cirasico_fallback_menu() {
    echo '<ul class="main-navigation">';
    echo '<li><a href="' . home_url() . '">Acasă</a></li>';
    echo '<li><a href="#about">Despre</a></li>';
    echo '<li><a href="#services">Servicii</a></li>';
    echo '<li><a href="#contact">Contact</a></li>';
    echo '</ul>';
}

/**
 * Add custom image sizes
 */
function cirasico_image_sizes() {
    add_image_size('cirasico-hero', 1200, 600, true);
    add_image_size('cirasico-card', 400, 300, true);
    add_image_size('cirasico-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'cirasico_image_sizes');

/**
 * Custom excerpt length
 */
function cirasico_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'cirasico_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function cirasico_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'cirasico_excerpt_more');

/**
 * Add custom post types for services
 */
function cirasico_custom_post_types() {
    // Services Post Type
    register_post_type('services',
        array(
            'labels' => array(
                'name' => 'Servicii',
                'singular_name' => 'Serviciu',
                'add_new' => 'Adaugă Serviciu Nou',
                'add_new_item' => 'Adaugă Serviciu Nou',
                'edit_item' => 'Editează Serviciu',
                'new_item' => 'Serviciu Nou',
                'view_item' => 'Vezi Serviciu',
                'search_items' => 'Caută Servicii',
                'not_found' => 'Nu s-au găsit servicii',
                'not_found_in_trash' => 'Nu s-au găsit servicii în coșul de gunoi'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array('slug' => 'servicii')
        )
    );

    // Team Post Type
    register_post_type('team',
        array(
            'labels' => array(
                'name' => 'Echipa',
                'singular_name' => 'Membru',
                'add_new' => 'Adaugă Membru Nou',
                'add_new_item' => 'Adaugă Membru Nou',
                'edit_item' => 'Editează Membru',
                'new_item' => 'Membru Nou',
                'view_item' => 'Vezi Membru',
                'search_items' => 'Caută Membri',
                'not_found' => 'Nu s-au găsit membri',
                'not_found_in_trash' => 'Nu s-au găsit membri în coșul de gunoi'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-groups',
            'rewrite' => array('slug' => 'echipa')
        )
    );
}
add_action('init', 'cirasico_custom_post_types');

/**
 * Add theme customizer options
 */
function cirasico_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('cirasico_hero', array(
        'title' => 'Secțiunea Hero',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default' => 'CIRASICO',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => 'Titlu Hero',
        'section' => 'cirasico_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Compania de Investiții și Reprezentanță Asigurări și Servicii Comerciale',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Subtitlu Hero',
        'section' => 'cirasico_hero',
        'type' => 'textarea',
    ));

    // Contact Information
    $wp_customize->add_section('cirasico_contact', array(
        'title' => 'Informații Contact',
        'priority' => 35,
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default' => '+40 XXX XXX XXX',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label' => 'Telefon',
        'section' => 'cirasico_contact',
        'type' => 'text',
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => 'contact@cirasico.ro',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => 'Email',
        'section' => 'cirasico_contact',
        'type' => 'email',
    ));

    $wp_customize->add_setting('contact_address', array(
        'default' => 'România, București',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => 'Adresa',
        'section' => 'cirasico_contact',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'cirasico_customize_register');

/**
 * Security enhancements
 */
function cirasico_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'cirasico_security_headers');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Limit login attempts
 */
function cirasico_limit_login_attempts($user, $username, $password) {
    if (!empty($username)) {
        $attempted_login = get_transient('attempted_login');
        if ($attempted_login === false) {
            $attempted_login = array();
        }
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $attempted_login[$ip] = isset($attempted_login[$ip]) ? $attempted_login[$ip] : 0;
        $attempted_login[$ip]++;
        
        set_transient('attempted_login', $attempted_login, 300);
        
        if ($attempted_login[$ip] > 5) {
            return new WP_Error('too_many_attempts', 'Prea multe încercări de conectare. Încercați din nou în 5 minute.');
        }
    }
    return $user;
}
add_filter('authenticate', 'cirasico_limit_login_attempts', 30, 3); 