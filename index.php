<?php
/**
 * The main template file
 *
 * @package CIRASICO_Modern
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">CIRASICO</h1>
            <p class="hero-subtitle">Compania de Investiții și Reprezentanță Asigurări și Servicii Comerciale</p>
            <a href="#services" class="cta-button">Descoperă Serviciile Noastre</a>
        </div>
    </section>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Services Section -->
        <section id="services" class="content-section">
            <h2 class="section-title">Serviciile Noastre</h2>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">💰</div>
                    <h3 class="card-title">Investiții</h3>
                    <div class="card-content">
                        <p>Servicii complete de consultanță în investiții, managementul portofoliului 
                        și strategii de creștere pentru afacerea dumneavoastră.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">🛡️</div>
                    <h3 class="card-title">Reprezentanță Asigurări</h3>
                    <div class="card-content">
                        <p>Reprezentanță autorizată pentru produse de asigurări, oferind protecție 
                        completă pentru afacerea și activele dumneavoastră.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">🤝</div>
                    <h3 class="card-title">Servicii Comerciale</h3>
                    <div class="card-content">
                        <p>Servicii de reprezentare comercială, dezvoltare de afaceri și 
                        strategii de marketing pentru creșterea vânzărilor.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="content-section">
            <h2 class="section-title">Despre CIRASICO</h2>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">🏢</div>
                    <h3 class="card-title">Compania Noastră</h3>
                    <div class="card-content">
                        <p>CIRASICO este o companie specializată în investiții, reprezentanță asigurări și servicii comerciale, 
                        oferind soluții complete pentru nevoile afacerii dumneavoastră.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">🎯</div>
                    <h3 class="card-title">Misiunea Noastră</h3>
                    <div class="card-content">
                        <p>Să oferim servicii de calitate superioară, bazate pe experiență și inovație, 
                        pentru a susține creșterea și dezvoltarea afacerilor clienților noștri.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">⭐</div>
                    <h3 class="card-title">Valorile Noastre</h3>
                    <div class="card-content">
                        <p>Profesionalism, integritate, inovație și angajament față de succesul clienților noștri 
                        sunt valorile care ne definesc și ne conduc în fiecare zi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="content-section">
            <h2 class="section-title">Contact</h2>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">📍</div>
                    <h3 class="card-title">Adresa</h3>
                    <div class="card-content">
                        <p>România<br>
                        București</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">📞</div>
                    <h3 class="card-title">Telefon</h3>
                    <div class="card-content">
                        <p>+40 XXX XXX XXX</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-icon">✉️</div>
                    <h3 class="card-title">Email</h3>
                    <div class="card-content">
                        <p>contact@cirasico.ro</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- WordPress Content -->
        <?php if (have_posts()) : ?>
            <section class="content-section">
                <h2 class="section-title">Știri și Actualități</h2>
                <div class="cards-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="card-content">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="post-meta" style="margin-top: 1rem; font-size: 0.9rem; color: var(--metallic-grey);">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <div class="pagination" style="text-align: center; margin-top: 3rem;">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '&laquo; Anterior',
                        'next_text' => 'Următor &raquo;',
                        'type' => 'list',
                        'class' => 'pagination-list'
                    ));
                    ?>
                </div>
            </section>
        <?php else : ?>
            <section class="content-section">
                <div class="card">
                    <h3 class="card-title">Nu există conținut</h3>
                    <div class="card-content">
                        <p>Încercați să căutați altceva sau să navigați prin meniul principal.</p>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?> 