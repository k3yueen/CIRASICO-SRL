<?php
/**
 * The template for displaying all pages
 *
 * @package CIRASICO_Modern
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <?php
    // Check if page has custom hero section
    $page_subtitle = get_post_meta(get_the_ID(), '_cirasico_page_subtitle', true);
    $hide_title = get_post_meta(get_the_ID(), '_cirasico_hide_title', true);
    
    if (!$hide_title) :
    ?>
    
    <!-- Page Header -->
    <section class="page-header" style="
        background: linear-gradient(135deg, var(--ash-black) 0%, var(--metallic-grey) 100%);
        color: var(--white);
        padding: 4rem 0;
        text-align: center;
    ">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 class="page-title" style="
                font-size: 3rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            "><?php the_title(); ?></h1>
            
            <?php if ($page_subtitle) : ?>
                <p class="page-subtitle" style="
                    font-size: 1.3rem;
                    opacity: 0.9;
                    margin-bottom: 0;
                "><?php echo esc_html($page_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </section>
    
    <?php endif; ?>

    <!-- Page Content -->
    <div class="main-content" style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
        
        <!-- Breadcrumbs -->
        <?php cirasico_breadcrumbs(); ?>
        
        <div class="page-content-wrapper" style="
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 3rem;
            margin-top: 2rem;
        ">
            
            <!-- Main Content Area -->
            <div class="page-content">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                        
                        <?php if ($hide_title && has_post_thumbnail()) : ?>
                            <div class="page-featured-image" style="
                                margin-bottom: 2rem;
                                border-radius: 12px;
                                overflow: hidden;
                                box-shadow: 0 4px 20px var(--shadow);
                            ">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="entry-content" style="
                            line-height: 1.8;
                            color: var(--ash-black);
                        ">
                            <?php
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'cirasico-modern'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                        
                        <?php if (get_edit_post_link()) : ?>
                            <footer class="entry-footer" style="
                                margin-top: 2rem;
                                padding-top: 2rem;
                                border-top: 1px solid var(--light-grey);
                            ">
                                <?php
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
                                ?>
                            </footer>
                        <?php endif; ?>
                        
                    </article>
                    
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    
                endwhile; // End of the loop.
                ?>
                
            </div>
            
            <!-- Sidebar -->
            <aside class="page-sidebar">
                <?php if (is_active_sidebar('sidebar-1')) : ?>
                    <div class="sidebar-widgets">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div>
                <?php else : ?>
                    
                    <!-- Default Sidebar Content -->
                    <div class="widget card" style="
                        background: var(--white);
                        border-radius: 12px;
                        padding: 2rem;
                        box-shadow: 0 4px 20px var(--shadow);
                        border: 1px solid var(--light-grey);
                        margin-bottom: 2rem;
                    ">
                        <h3 class="widget-title" style="
                            color: var(--ash-black);
                            margin-bottom: 1rem;
                            font-size: 1.3rem;
                            font-weight: 600;
                        ">Despre CIRASICO</h3>
                        <p style="color: var(--metallic-grey); line-height: 1.7;">
                            CIRASICO este o companie specializată în investiții, reprezentanță asigurări și servicii comerciale, 
                            oferind soluții complete pentru nevoile afacerii dumneavoastră.
                        </p>
                    </div>
                    
                    <div class="widget card" style="
                        background: var(--white);
                        border-radius: 12px;
                        padding: 2rem;
                        box-shadow: 0 4px 20px var(--shadow);
                        border: 1px solid var(--light-grey);
                        margin-bottom: 2rem;
                    ">
                        <h3 class="widget-title" style="
                            color: var(--ash-black);
                            margin-bottom: 1rem;
                            font-size: 1.3rem;
                            font-weight: 600;
                        ">Contact Rapid</h3>
                        <div style="color: var(--metallic-grey);">
                            <p style="margin-bottom: 0.5rem;">
                                <i class="fas fa-phone" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                <?php echo esc_html(cirasico_get_contact_phone()); ?>
                            </p>
                            <p style="margin-bottom: 0.5rem;">
                                <i class="fas fa-envelope" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                <a href="mailto:<?php echo esc_attr(cirasico_get_contact_email()); ?>" style="color: inherit;">
                                    <?php echo esc_html(cirasico_get_contact_email()); ?>
                                </a>
                            </p>
                            <p style="margin-bottom: 0;">
                                <i class="fas fa-map-marker-alt" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                <?php echo esc_html(cirasico_get_contact_address()); ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="widget card" style="
                        background: var(--white);
                        border-radius: 12px;
                        padding: 2rem;
                        box-shadow: 0 4px 20px var(--shadow);
                        border: 1px solid var(--light-grey);
                    ">
                        <h3 class="widget-title" style="
                            color: var(--ash-black);
                            margin-bottom: 1rem;
                            font-size: 1.3rem;
                            font-weight: 600;
                        ">Serviciile Noastre</h3>
                        <ul style="
                            list-style: none;
                            padding: 0;
                            margin: 0;
                            color: var(--metallic-grey);
                        ">
                            <li style="margin-bottom: 0.5rem;">
                                <i class="fas fa-check" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                Investiții
                            </li>
                            <li style="margin-bottom: 0.5rem;">
                                <i class="fas fa-check" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                Reprezentanță Asigurări
                            </li>
                            <li style="margin-bottom: 0;">
                                <i class="fas fa-check" style="color: var(--primary-red); margin-right: 0.5rem;"></i>
                                Servicii Comerciale
                            </li>
                        </ul>
                    </div>
                    
                <?php endif; ?>
            </aside>
            
        </div>
        
        <!-- Related Content -->
        <?php if (is_page()) : ?>
            <section class="related-content" style="margin-top: 4rem;">
                <h2 class="section-title" style="
                    font-size: 2rem;
                    color: var(--ash-black);
                    margin-bottom: 2rem;
                    text-align: center;
                    position: relative;
                ">
                    Conținut Relat
                    <span style="
                        position: absolute;
                        bottom: -10px;
                        left: 50%;
                        transform: translateX(-50%);
                        width: 80px;
                        height: 4px;
                        background: linear-gradient(90deg, var(--primary-red), var(--secondary-red));
                        border-radius: 2px;
                    "></span>
                </h2>
                
                <div class="related-posts-grid" style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 2rem;
                ">
                    <?php
                    $related_pages = new WP_Query(array(
                        'post_type' => 'page',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand'
                    ));
                    
                    if ($related_pages->have_posts()) :
                        while ($related_pages->have_posts()) : $related_pages->the_post();
                            ?>
                            <article class="related-post card" style="
                                background: var(--white);
                                border-radius: 12px;
                                padding: 2rem;
                                box-shadow: 0 4px 20px var(--shadow);
                                transition: all 0.3s ease;
                                border: 1px solid var(--light-grey);
                            ">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="related-post-thumbnail" style="
                                        margin-bottom: 1rem;
                                        border-radius: 8px;
                                        overflow: hidden;
                                    ">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <h3 class="related-post-title" style="
                                    font-size: 1.3rem;
                                    color: var(--ash-black);
                                    margin-bottom: 1rem;
                                    font-weight: 600;
                                ">
                                    <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="related-post-excerpt" style="
                                    color: var(--metallic-grey);
                                    line-height: 1.6;
                                    margin-bottom: 1rem;
                                ">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more" style="
                                    color: var(--primary-red);
                                    text-decoration: none;
                                    font-weight: 600;
                                    font-size: 0.9rem;
                                ">
                                    Citește mai mult <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                                </a>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </section>
        <?php endif; ?>
        
    </div>
</main>

<style>
/* Responsive design for page template */
@media (max-width: 768px) {
    .page-content-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .page-title {
        font-size: 2.5rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
}

/* Hover effects */
.related-post:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.read-more:hover {
    color: var(--secondary-red);
}

/* Breadcrumbs styling */
.breadcrumbs {
    background: var(--light-grey);
    padding: 1rem 2rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.breadcrumbs ol {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.breadcrumbs li {
    color: var(--metallic-grey);
}

.breadcrumbs li:not(:last-child)::after {
    content: '>';
    margin-left: 0.5rem;
    color: var(--primary-red);
}

.breadcrumbs a {
    color: var(--primary-red);
    text-decoration: none;
}

.breadcrumbs a:hover {
    color: var(--secondary-red);
}
</style>

<?php get_footer(); ?> 