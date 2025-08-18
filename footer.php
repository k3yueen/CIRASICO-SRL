    <footer id="colophon" class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Despre CIRASICO</h3>
                <p>Compania de Investiții și Reprezentanță Asigurări și Servicii Comerciale, 
                oferind soluții complete pentru nevoile afacerii dumneavoastră din 2013.</p>
            </div>
            
            <div class="footer-section">
                <h3>Serviciile Noastre</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#services">Investiții</a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#services">Reprezentanță Asigurări</a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#services">Servicii Comerciale</a>
                    </li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact</h3>
                <p>
                    <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--primary-red);"></i>
                    România, București
                </p>
                <p>
                    <i class="fas fa-phone" style="margin-right: 0.5rem; color: var(--primary-red);"></i>
                    +40 XXX XXX XXX
                </p>
                <p>
                    <i class="fas fa-envelope" style="margin-right: 0.5rem; color: var(--primary-red);"></i>
                    <a href="mailto:contact@cirasico.ro">contact@cirasico.ro</a>
                </p>
            </div>
            
            <div class="footer-section">
                <h3>Urmărește-ne</h3>
                <div class="social-links" style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <a href="#" style="color: var(--light-grey); font-size: 1.5rem; transition: color 0.3s ease;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" style="color: var(--light-grey); font-size: 1.5rem; transition: color 0.3s ease;">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" style="color: var(--light-grey); font-size: 1.5rem; transition: color 0.3s ease;">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> CIRASICO. Toate drepturile rezervate.</p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">
                Dezvoltat cu <i class="fas fa-heart" style="color: var(--primary-red);"></i> pentru afacerea dumneavoastră
            </p>
        </div>
    </footer>
</div><!-- #page -->

<!-- Back to Top Button -->
<button id="back-to-top" style="
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: var(--primary-red);
    color: var(--white);
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    z-index: 1000;
">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
// Back to top functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        // Show button when scrolling down
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        // Smooth scroll to top when clicked
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Hover effect
        backToTopButton.addEventListener('mouseenter', function() {
            this.style.background = 'var(--secondary-red)';
            this.style.transform = 'translateY(-2px)';
        });
        
        backToTopButton.addEventListener('mouseleave', function() {
            this.style.background = 'var(--primary-red)';
            this.style.transform = 'translateY(0)';
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Add loading animation for page transitions
window.addEventListener('load', function() {
    document.body.style.opacity = '1';
    document.body.style.transition = 'opacity 0.3s ease';
});

// Preloader
document.addEventListener('DOMContentLoaded', function() {
    if (document.body.style.opacity !== '1') {
        document.body.style.opacity = '0';
    }
});
</script>

<style>
/* Additional footer styles */
.social-links a:hover {
    color: var(--primary-red) !important;
}

/* Smooth page transitions */
body {
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Pagination styles */
.pagination-list {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 0.5rem;
    margin: 0;
    padding: 0;
}

.pagination-list li {
    margin: 0;
}

.pagination-list a,
.pagination-list span {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: var(--white);
    color: var(--ash-black);
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid var(--light-grey);
    transition: all 0.3s ease;
}

.pagination-list a:hover,
.pagination-list .current {
    background: var(--primary-red);
    color: var(--white);
    border-color: var(--primary-red);
}

/* Screen reader text */
.screen-reader-text {
    border: 0;
    clip: rect(1px, 1px, 1px, 1px);
    clip-path: inset(50%);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
    word-wrap: normal !important;
}

.screen-reader-text:focus {
    background-color: #f1f1f1;
    border-radius: 3px;
    box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
    clip: auto !important;
    clip-path: none;
    color: #21759b;
    display: block;
    font-size: 14px;
    font-size: 0.875rem;
    font-weight: 700;
    height: auto;
    left: 5px;
    line-height: normal;
    padding: 15px 23px 14px;
    text-decoration: none;
    top: 5px;
    width: auto;
    z-index: 100000;
}
</style>

<?php wp_footer(); ?>

</body>
</html> 