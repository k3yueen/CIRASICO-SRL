<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preconnect to external domains for better performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'cirasico-modern'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php
                // Check if custom logo is set
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    // Fallback to site title and description
                    if (is_front_page() && is_home()) :
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                    else :
                        ?>
                        <p class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                        <?php
                    endif;
                    
                    $cirasico_description = get_bloginfo('description', 'display');
                    if ($cirasico_description || is_customize_preview()) :
                        ?>
                        <p class="site-description" style="color: var(--light-grey); font-size: 0.9rem; margin-top: 0.5rem;">
                            <?php echo $cirasico_description; ?>
                        </p>
                        <?php
                    endif;
                }
                ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'main-navigation',
                    'fallback_cb'    => 'cirasico_fallback_menu',
                ));
                ?>
                
                <!-- Mobile menu toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-navigation" style="display: none;">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'mobile-menu',
            'container'      => false,
            'menu_class'     => 'mobile-menu',
            'fallback_cb'    => 'cirasico_fallback_menu',
        ));
        ?>
    </div>

    <script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileNav = document.querySelector('.mobile-navigation');
        
        if (mobileToggle && mobileNav) {
            mobileToggle.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                mobileNav.style.display = isExpanded ? 'none' : 'block';
                this.classList.toggle('active');
            });
        }
    });
    </script>

    <style>
    /* Mobile menu styles */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        flex-direction: column;
        gap: 4px;
    }
    
    .hamburger-line {
        width: 25px;
        height: 3px;
        background-color: var(--white);
        transition: all 0.3s ease;
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
    
    .mobile-navigation {
        background: var(--ash-black);
        padding: 1rem;
        border-top: 1px solid var(--metallic-grey);
    }
    
    .mobile-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .mobile-menu li {
        margin: 0.5rem 0;
    }
    
    .mobile-menu a {
        color: var(--white);
        text-decoration: none;
        padding: 0.75rem 1rem;
        display: block;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .mobile-menu a:hover {
        background-color: var(--primary-red);
    }
    
    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: flex;
        }
        
        .main-navigation {
            display: none;
        }
    }
    </style> 