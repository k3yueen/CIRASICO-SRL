<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CIRASICO_Modern
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cirasico_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'cirasico_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cirasico_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'cirasico_pingback_header');

/**
 * Customize the excerpt more link
 */
function cirasico_excerpt_more_link($link) {
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
        '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continuă să citești<span class="screen-reader-text"> "%s"</span>', 'cirasico-modern'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post(get_the_title())
        )
    );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'cirasico_excerpt_more_link');

/**
 * Add preconnect for Google Fonts.
 *
 * @since CIRASICO Modern 2.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function cirasico_resource_hints($urls, $relation_type) {
    if (wp_style_is('cirasico-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'cirasico_resource_hints', 10, 2);

/**
 * Enqueue block editor style
 */
function cirasico_block_editor_styles() {
    wp_enqueue_style('cirasico-block-editor-style', get_template_directory_uri() . '/style-editor.css');
}
add_action('enqueue_block_editor_assets', 'cirasico_block_editor_styles');

/**
 * Add custom image sizes for the theme
 */
function cirasico_custom_image_sizes() {
    add_image_size('cirasico-hero', 1200, 600, true);
    add_image_size('cirasico-card', 400, 300, true);
    add_image_size('cirasico-thumbnail', 300, 200, true);
    add_image_size('cirasico-square', 400, 400, true);
}
add_action('after_setup_theme', 'cirasico_custom_image_sizes');

/**
 * Customize the main query for better performance
 */
function cirasico_customize_main_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Set posts per page for different post types
        if (is_home() || is_archive()) {
            $query->set('posts_per_page', 9);
        }
        
        // Exclude certain categories from main query if needed
        // $query->set('category__not_in', array(1, 2));
    }
}
add_action('pre_get_posts', 'cirasico_customize_main_query');

/**
 * Add custom meta boxes for pages
 */
function cirasico_add_meta_boxes() {
    add_meta_box(
        'cirasico_page_options',
        'Opțiuni Pagină',
        'cirasico_page_options_callback',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'cirasico_add_meta_boxes');

function cirasico_page_options_callback($post) {
    wp_nonce_field('cirasico_save_page_options', 'cirasico_page_options_nonce');
    
    $hide_title = get_post_meta($post->ID, '_cirasico_hide_title', true);
    $page_subtitle = get_post_meta($post->ID, '_cirasico_page_subtitle', true);
    
    ?>
    <p>
        <label for="cirasico_hide_title">
            <input type="checkbox" id="cirasico_hide_title" name="cirasico_hide_title" value="1" <?php checked($hide_title, '1'); ?> />
            Ascunde titlul paginii
        </label>
    </p>
    <p>
        <label for="cirasico_page_subtitle">Subtitlu pagină:</label><br>
        <input type="text" id="cirasico_page_subtitle" name="cirasico_page_subtitle" value="<?php echo esc_attr($page_subtitle); ?>" style="width: 100%;" />
    </p>
    <?php
}

function cirasico_save_page_options($post_id) {
    if (!isset($_POST['cirasico_page_options_nonce']) || !wp_verify_nonce($_POST['cirasico_page_options_nonce'], 'cirasico_save_page_options')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $hide_title = isset($_POST['cirasico_hide_title']) ? '1' : '';
    $page_subtitle = sanitize_text_field($_POST['cirasico_page_subtitle']);
    
    update_post_meta($post_id, '_cirasico_hide_title', $hide_title);
    update_post_meta($post_id, '_cirasico_page_subtitle', $page_subtitle);
}
add_action('save_post', 'cirasico_save_page_options');

/**
 * Add custom shortcodes
 */
function cirasico_button_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'url' => '#',
        'style' => 'primary',
        'size' => 'medium'
    ), $atts);
    
    $classes = 'cirasico-button cirasico-button-' . $atts['style'] . ' cirasico-button-' . $atts['size'];
    
    return '<a href="' . esc_url($atts['url']) . '" class="' . esc_attr($classes) . '">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'cirasico_button_shortcode');

function cirasico_card_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'icon' => ''
    ), $atts);
    
    $output = '<div class="cirasico-card">';
    if (!empty($atts['icon'])) {
        $output .= '<div class="card-icon">' . $atts['icon'] . '</div>';
    }
    if (!empty($atts['title'])) {
        $output .= '<h3 class="card-title">' . $atts['title'] . '</h3>';
    }
    $output .= '<div class="card-content">' . do_shortcode($content) . '</div>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('card', 'cirasico_card_shortcode');

/**
 * Add custom CSS for shortcodes
 */
function cirasico_shortcode_styles() {
    ?>
    <style>
    .cirasico-button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .cirasico-button-primary {
        background: var(--primary-red);
        color: var(--white);
    }
    
    .cirasico-button-primary:hover {
        background: var(--secondary-red);
        transform: translateY(-2px);
    }
    
    .cirasico-button-secondary {
        background: var(--white);
        color: var(--primary-red);
        border: 2px solid var(--primary-red);
    }
    
    .cirasico-button-secondary:hover {
        background: var(--primary-red);
        color: var(--white);
    }
    
    .cirasico-button-small {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .cirasico-button-large {
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }
    
    .cirasico-card {
        background: var(--white);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 20px var(--shadow);
        margin: 1rem 0;
        border: 1px solid var(--light-grey);
    }
    </style>
    <?php
}
add_action('wp_head', 'cirasico_shortcode_styles');

/**
 * Add custom admin styles
 */
function cirasico_admin_styles() {
    echo '<style>
    .wp-admin .cirasico-admin-notice {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin: 1rem 0;
    }
    </style>';
}
add_action('admin_head', 'cirasico_admin_styles');

/**
 * Add custom dashboard widget
 */
function cirasico_dashboard_widget() {
    wp_add_dashboard_widget(
        'cirasico_dashboard_widget',
        'CIRASICO Modern Theme',
        'cirasico_dashboard_widget_callback'
    );
}
add_action('wp_dashboard_setup', 'cirasico_dashboard_widget');

function cirasico_dashboard_widget_callback() {
    echo '<div class="cirasico-admin-notice">';
    echo '<h3>Bun venit la CIRASICO Modern!</h3>';
    echo '<p>Acest temă modern și responsive este perfect pentru afacerea dumneavoastră.</p>';
    echo '<p><strong>Caracteristici principale:</strong></p>';
    echo '<ul>';
    echo '<li>Design modern și responsive</li>';
    echo '<li>Optimizat pentru performanță</li>';
    echo '<li>Suport pentru Gutenberg</li>';
    echo '<li>Personalizare ușoară</li>';
    echo '</ul>';
    echo '</div>';
}

/**
 * Add custom login page styling
 */
function cirasico_login_styles() {
    ?>
    <style>
    #login h1 a {
        background-image: url('<?php echo get_template_directory_uri(); ?>/images/cirasico-logo.png');
        background-size: contain;
        width: 300px;
        height: 80px;
    }
    
    .login {
        background: linear-gradient(135deg, var(--ash-black) 0%, var(--metallic-grey) 100%);
    }
    
    .login form {
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }
    
    .wp-core-ui .button-primary {
        background: var(--primary-red);
        border-color: var(--primary-red);
    }
    
    .wp-core-ui .button-primary:hover {
        background: var(--secondary-red);
        border-color: var(--secondary-red);
    }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'cirasico_login_styles');

/**
 * Change login logo URL
 */
function cirasico_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'cirasico_login_logo_url');

function cirasico_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'cirasico_login_logo_url_title'); 