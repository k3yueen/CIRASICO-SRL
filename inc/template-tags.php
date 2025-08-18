<?php
/**
 * Custom template tags for this theme
 *
 * @package CIRASICO_Modern
 */

if (!function_exists('cirasico_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function cirasico_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Publicat pe %s', 'post date', 'cirasico-modern'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

    }
endif;

if (!function_exists('cirasico_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function cirasico_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('de %s', 'post author', 'cirasico-modern'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
endif;

if (!function_exists('cirasico_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function cirasico_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'cirasico-modern'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Postat în %1$s', 'cirasico-modern') . '</span>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'cirasico-modern'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Etichetat %1$s', 'cirasico-modern') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Lasă un comentariu<span class="screen-reader-text"> pe %s</span>', 'cirasico-modern'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Editează <span class="screen-reader-text">%s</span>', 'cirasico-modern'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('cirasico_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function cirasico_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }
endif;

/**
 * Custom function to get hero content from customizer
 */
function cirasico_get_hero_title() {
    return get_theme_mod('hero_title', 'CIRASICO');
}

function cirasico_get_hero_subtitle() {
    return get_theme_mod('hero_subtitle', 'Compania de Investiții și Reprezentanță Asigurări și Servicii Comerciale');
}

/**
 * Custom function to get contact information from customizer
 */
function cirasico_get_contact_phone() {
    return get_theme_mod('contact_phone', '+40 XXX XXX XXX');
}

function cirasico_get_contact_email() {
    return get_theme_mod('contact_email', 'contact@cirasico.ro');
}

function cirasico_get_contact_address() {
    return get_theme_mod('contact_address', 'România, București');
}

/**
 * Custom function to display social media links
 */
function cirasico_social_links() {
    $social_links = array(
        'facebook' => get_theme_mod('social_facebook', ''),
        'twitter' => get_theme_mod('social_twitter', ''),
        'linkedin' => get_theme_mod('social_linkedin', ''),
        'instagram' => get_theme_mod('social_instagram', ''),
    );

    $output = '<div class="social-links">';
    
    foreach ($social_links as $platform => $url) {
        if (!empty($url)) {
            $icon_class = 'fab fa-' . $platform;
            $output .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s">',
                esc_url($url),
                esc_attr(ucfirst($platform))
            );
            $output .= '<i class="' . esc_attr($icon_class) . '"></i>';
            $output .= '</a>';
        }
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Custom function to display breadcrumbs
 */
function cirasico_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol>';
    echo '<li><a href="' . home_url() . '">Acasă</a></li>';

    if (is_category() || is_single()) {
        echo '<li>';
        the_category(' </li><li> ');
        if (is_single()) {
            echo '</li><li>';
            the_title();
            echo '</li>';
        }
    } elseif (is_page()) {
        echo '<li>';
        the_title();
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Custom function to display related posts
 */
function cirasico_related_posts($post_id, $number = 3) {
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return;
    }

    $args = array(
        'category__in' => $categories,
        'post__not_in' => array($post_id),
        'posts_per_page' => $number,
        'orderby' => 'rand'
    );

    $related_posts = new WP_Query($args);

    if ($related_posts->have_posts()) {
        echo '<section class="related-posts">';
        echo '<h3>Articole similare</h3>';
        echo '<div class="related-posts-grid">';
        
        while ($related_posts->have_posts()) {
            $related_posts->the_post();
            echo '<article class="related-post">';
            if (has_post_thumbnail()) {
                echo '<div class="related-post-thumbnail">';
                the_post_thumbnail('thumbnail');
                echo '</div>';
            }
            echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
            echo '<time datetime="' . get_the_date('c') . '">' . get_the_date() . '</time>';
            echo '</article>';
        }
        
        echo '</div>';
        echo '</section>';
        
        wp_reset_postdata();
    }
} 