/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {

  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  });

  // Header text color.
  wp.customize('header_textcolor', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.site-title, .site-description').css({
          clip: 'rect(1px, 1px, 1px, 1px)',
          position: 'absolute',
        });
      } else {
        $('.site-title, .site-description').css({
          clip: 'auto',
          position: 'relative',
        });
        $('.site-title a, .site-description').css({
          color: to,
        });
      }
    });
  });

  // Hero section customizations
  wp.customize('hero_title', function (value) {
    value.bind(function (to) {
      $('.hero-title').text(to);
    });
  });

  wp.customize('hero_subtitle', function (value) {
    value.bind(function (to) {
      $('.hero-subtitle').text(to);
    });
  });

  wp.customize('hero_button_text', function (value) {
    value.bind(function (to) {
      $('.cta-button').text(to);
    });
  });

  wp.customize('hero_button_url', function (value) {
    value.bind(function (to) {
      $('.cta-button').attr('href', to);
    });
  });

  // Contact information customizations
  wp.customize('contact_phone', function (value) {
    value.bind(function (to) {
      $('.contact-phone').text(to);
    });
  });

  wp.customize('contact_email', function (value) {
    value.bind(function (to) {
      $('.contact-email').text(to);
      $('.contact-email').attr('href', 'mailto:' + to);
    });
  });

  wp.customize('contact_address', function (value) {
    value.bind(function (to) {
      $('.contact-address').text(to);
    });
  });

  // Social media customizations
  wp.customize('social_facebook', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.social-facebook').attr('href', to).show();
      } else {
        $('.social-facebook').hide();
      }
    });
  });

  wp.customize('social_twitter', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.social-twitter').attr('href', to).show();
      } else {
        $('.social-twitter').hide();
      }
    });
  });

  wp.customize('social_linkedin', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.social-linkedin').attr('href', to).show();
      } else {
        $('.social-linkedin').hide();
      }
    });
  });

  wp.customize('social_instagram', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.social-instagram').attr('href', to).show();
      } else {
        $('.social-instagram').hide();
      }
    });
  });

  // Color customizations
  wp.customize('primary_red', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--primary-red', to);
    });
  });

  wp.customize('secondary_red', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--secondary-red', to);
    });
  });

  wp.customize('metallic_grey', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--metallic-grey', to);
    });
  });

  wp.customize('ash_black', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--ash-black', to);
    });
  });

  // Footer customizations
  wp.customize('footer_text', function (value) {
    value.bind(function (to) {
      $('.footer-copyright').html(to);
    });
  });

  // Performance settings
  wp.customize('enable_lazy_loading', function (value) {
    value.bind(function (to) {
      if (to) {
        $('img').addClass('lazy');
      } else {
        $('img').removeClass('lazy');
      }
    });
  });

  // Add custom CSS for live preview
  wp.customize('primary_red', function (value) {
    value.bind(function (to) {
      updateCustomCSS();
    });
  });

  wp.customize('secondary_red', function (value) {
    value.bind(function (to) {
      updateCustomCSS();
    });
  });

  wp.customize('metallic_grey', function (value) {
    value.bind(function (to) {
      updateCustomCSS();
    });
  });

  wp.customize('ash_black', function (value) {
    value.bind(function (to) {
      updateCustomCSS();
    });
  });

  function updateCustomCSS() {
    const primaryRed = wp.customize('primary_red').get();
    const secondaryRed = wp.customize('secondary_red').get();
    const metallicGrey = wp.customize('metallic_grey').get();
    const ashBlack = wp.customize('ash_black').get();

    let customCSS = `
            :root {
                --primary-red: ${primaryRed};
                --secondary-red: ${secondaryRed};
                --metallic-grey: ${metallicGrey};
                --ash-black: ${ashBlack};
            }
        `;

    // Update or create custom CSS element
    let customCSSElement = document.getElementById('cirasico-customizer-css');
    if (!customCSSElement) {
      customCSSElement = document.createElement('style');
      customCSSElement.id = 'cirasico-customizer-css';
      document.head.appendChild(customCSSElement);
    }
    customCSSElement.textContent = customCSS;
  }

  // Initialize custom CSS on load
  updateCustomCSS();

  // Add animation preview
  wp.customize('enable_animations', function (value) {
    value.bind(function (to) {
      if (to) {
        $('body').addClass('animations-enabled');
      } else {
        $('body').removeClass('animations-enabled');
      }
    });
  });

  // Preview section visibility
  wp.customize('show_hero_section', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.hero-section').show();
      } else {
        $('.hero-section').hide();
      }
    });
  });

  wp.customize('show_about_section', function (value) {
    value.bind(function (to) {
      if (to) {
        $('#about').show();
      } else {
        $('#about').hide();
      }
    });
  });

  wp.customize('show_services_section', function (value) {
    value.bind(function (to) {
      if (to) {
        $('#services').show();
      } else {
        $('#services').hide();
      }
    });
  });

  wp.customize('show_contact_section', function (value) {
    value.bind(function (to) {
      if (to) {
        $('#contact').show();
      } else {
        $('#contact').hide();
      }
    });
  });

  // Layout options
  wp.customize('container_width', function (value) {
    value.bind(function (to) {
      $('.header-container, .main-content, .footer-content').css('max-width', to + 'px');
    });
  });

  wp.customize('sidebar_position', function (value) {
    value.bind(function (to) {
      $('body').removeClass('sidebar-left sidebar-right no-sidebar').addClass('sidebar-' + to);
    });
  });

  // Typography options
  wp.customize('body_font', function (value) {
    value.bind(function (to) {
      $('body').css('font-family', to);
    });
  });

  wp.customize('heading_font', function (value) {
    value.bind(function (to) {
      $('h1, h2, h3, h4, h5, h6').css('font-family', to);
    });
  });

  wp.customize('font_size', function (value) {
    value.bind(function (to) {
      $('body').css('font-size', to + 'px');
    });
  });

  // Button styles
  wp.customize('button_style', function (value) {
    value.bind(function (to) {
      $('.cta-button, .cirasico-button').removeClass('button-rounded button-square button-pill').addClass('button-' + to);
    });
  });

  wp.customize('button_size', function (value) {
    value.bind(function (to) {
      $('.cta-button, .cirasico-button').removeClass('button-small button-medium button-large').addClass('button-' + to);
    });
  });

  // Card styles
  wp.customize('card_style', function (value) {
    value.bind(function (to) {
      $('.card').removeClass('card-shadow card-border card-elevated').addClass('card-' + to);
    });
  });

  wp.customize('card_corners', function (value) {
    value.bind(function (to) {
      $('.card').css('border-radius', to + 'px');
    });
  });

  // Header styles
  wp.customize('header_style', function (value) {
    value.bind(function (to) {
      $('.site-header').removeClass('header-transparent header-solid header-gradient').addClass('header-' + to);
    });
  });

  wp.customize('header_sticky', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.site-header').addClass('sticky');
      } else {
        $('.site-header').removeClass('sticky');
      }
    });
  });

  // Footer styles
  wp.customize('footer_style', function (value) {
    value.bind(function (to) {
      $('.site-footer').removeClass('footer-dark footer-light footer-gradient').addClass('footer-' + to);
    });
  });

  // Background options
  wp.customize('background_color', function (value) {
    value.bind(function (to) {
      $('body').css('background-color', to);
    });
  });

  wp.customize('background_image', function (value) {
    value.bind(function (to) {
      if (to) {
        $('body').css('background-image', 'url(' + to + ')');
      } else {
        $('body').css('background-image', 'none');
      }
    });
  });

  // Logo options
  wp.customize('custom_logo', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.site-logo').attr('src', to).show();
        $('.site-title').hide();
      } else {
        $('.site-logo').hide();
        $('.site-title').show();
      }
    });
  });

  // Menu options
  wp.customize('menu_position', function (value) {
    value.bind(function (to) {
      $('.main-navigation').removeClass('menu-left menu-center menu-right').addClass('menu-' + to);
    });
  });

  wp.customize('menu_style', function (value) {
    value.bind(function (to) {
      $('.main-navigation').removeClass('menu-horizontal menu-vertical menu-dropdown').addClass('menu-' + to);
    });
  });

})(jQuery); 