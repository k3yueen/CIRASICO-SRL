/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  const siteNavigation = document.getElementById('site-navigation');

  // Return early if the navigation doesn't exist.
  if (!siteNavigation) {
    return;
  }

  const button = siteNavigation.getElementsByTagName('button')[0];

  // Return early if the button doesn't exist.
  if ('undefined' === typeof button) {
    return;
  }

  const menu = siteNavigation.getElementsByTagName('ul')[0];

  // Hide menu toggle button if menu is empty and return early.
  if ('undefined' === typeof menu) {
    button.style.display = 'none';
    return;
  }

  if (!menu.classList.contains('nav-menu')) {
    menu.classList.add('nav-menu');
  }

  // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
  button.addEventListener('click', function () {
    siteNavigation.classList.toggle('toggled');

    if (button.getAttribute('aria-expanded') === 'true') {
      button.setAttribute('aria-expanded', 'false');
    } else {
      button.setAttribute('aria-expanded', 'true');
    }
  });

  // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
  document.addEventListener('click', function (event) {
    const isClickInside = siteNavigation.contains(event.target);

    if (!isClickInside) {
      siteNavigation.classList.remove('toggled');
      button.setAttribute('aria-expanded', 'false');
    }
  });

  // Get all the link elements within the menu.
  const links = menu.getElementsByTagName('a');

  // Get all the link elements with children within the menu.
  const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

  // Toggle focus each time a menu link is focused or blurred.
  for (const link of links) {
    link.addEventListener('focus', toggleFocus, true);
    link.addEventListener('blur', toggleFocus, true);
  }

  // Toggle focus each time a menu link with children receive a touch event.
  for (const link of linksWithChildren) {
    link.addEventListener('touchstart', toggleFocus, false);
  }

  /**
   * Sets or removes .focus class on an element.
   */
  function toggleFocus() {
    if (event.type === 'focus' || event.type === 'blur') {
      let self = this;
      // Move up through the ancestors of the current link until we hit .nav-menu.
      while (!self.classList.contains('nav-menu')) {
        // On li elements toggle the class .focus.
        if ('li' === self.tagName.toLowerCase()) {
          self.classList.toggle('focus');
        }
        self = self.parentNode;
      }
    }

    if (event.type === 'touchstart') {
      const menuItem = this.parentNode;
      event.preventDefault();
      for (const link of menuItem.parentNode.children) {
        if (menuItem !== link) {
          link.classList.remove('focus');
        }
      }
      menuItem.classList.toggle('focus');
    }
  }
})();

/**
 * Smooth scrolling for anchor links
 */
document.addEventListener('DOMContentLoaded', function () {
  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        const headerHeight = document.querySelector('.site-header').offsetHeight;
        const targetPosition = target.offsetTop - headerHeight - 20;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // Close mobile menu if open
        const siteNavigation = document.getElementById('site-navigation');
        if (siteNavigation && siteNavigation.classList.contains('toggled')) {
          siteNavigation.classList.remove('toggled');
          const button = siteNavigation.getElementsByTagName('button')[0];
          if (button) {
            button.setAttribute('aria-expanded', 'false');
          }
        }
      }
    });
  });

  // Add scroll effect to header
  const header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 100) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // Add intersection observer for animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
      }
    });
  }, observerOptions);

  // Observe all cards and sections
  document.querySelectorAll('.card, .content-section').forEach(el => {
    observer.observe(el);
  });

  // Add loading animation
  window.addEventListener('load', function () {
    document.body.classList.add('loaded');
  });
});

/**
 * Mobile menu functionality
 */
document.addEventListener('DOMContentLoaded', function () {
  const mobileToggle = document.querySelector('.mobile-menu-toggle');
  const mobileNav = document.querySelector('.mobile-navigation');

  if (mobileToggle && mobileNav) {
    mobileToggle.addEventListener('click', function () {
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !isExpanded);
      mobileNav.style.display = isExpanded ? 'none' : 'block';
      this.classList.toggle('active');
    });
  }
});

/**
 * Back to top functionality
 */
document.addEventListener('DOMContentLoaded', function () {
  const backToTopButton = document.getElementById('back-to-top');

  if (backToTopButton) {
    // Show button when scrolling down
    window.addEventListener('scroll', function () {
      if (window.pageYOffset > 300) {
        backToTopButton.style.display = 'flex';
      } else {
        backToTopButton.style.display = 'none';
      }
    });

    // Smooth scroll to top when clicked
    backToTopButton.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Hover effect
    backToTopButton.addEventListener('mouseenter', function () {
      this.style.background = 'var(--secondary-red)';
      this.style.transform = 'translateY(-2px)';
    });

    backToTopButton.addEventListener('mouseleave', function () {
      this.style.background = 'var(--primary-red)';
      this.style.transform = 'translateY(0)';
    });
  }
});

/**
 * Lazy loading for images
 */
document.addEventListener('DOMContentLoaded', function () {
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.remove('lazy');
          imageObserver.unobserve(img);
        }
      });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
      imageObserver.observe(img);
    });
  }
});

/**
 * Form validation and enhancement
 */
document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('form');

  forms.forEach(form => {
    form.addEventListener('submit', function (e) {
      const requiredFields = form.querySelectorAll('[required]');
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;
          field.classList.add('error');
        } else {
          field.classList.remove('error');
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert('Vă rugăm să completați toate câmpurile obligatorii.');
      }
    });
  });
}); 