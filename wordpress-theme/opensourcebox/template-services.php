<?php
/**
 * Template Name: Services Page
 *
 * Template for showcasing services and pricing
 *
 * @package OpenSourceBox
 * @since 2.2.0
 */

get_header(); ?>

<div id="primary" class="content-area services-page">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php if ( get_the_excerpt() ) : ?>
                        <div class="entry-subtitle">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>

                    <!-- Services Grid -->
                    <div class="services-grid">

                        <!-- Service 1: Consulting -->
                        <div class="service-card">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                            </div>
                            <h3>AI/ML Consulting</h3>
                            <p class="service-description">Expert guidance on implementing AI and Machine Learning solutions for your business.</p>
                            <ul class="service-features">
                                <li>Strategy & Planning</li>
                                <li>Technology Selection</li>
                                <li>Implementation Support</li>
                                <li>Team Training</li>
                            </ul>
                            <div class="service-price">Starting at $200/hour</div>
                            <a href="#contact" class="btn btn-primary">Get Started</a>
                        </div>

                        <!-- Service 2: Development -->
                        <div class="service-card featured">
                            <div class="popular-badge">Most Popular</div>
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="16 18 22 12 16 6"></polyline>
                                    <polyline points="8 6 2 12 8 18"></polyline>
                                </svg>
                            </div>
                            <h3>Custom Development</h3>
                            <p class="service-description">Build custom AI/ML solutions, chatbots, and automation tools tailored to your needs.</p>
                            <ul class="service-features">
                                <li>Custom AI Solutions</li>
                                <li>Chatbot Development</li>
                                <li>API Integration</li>
                                <li>Open Source Tools</li>
                            </ul>
                            <div class="service-price">Custom Pricing</div>
                            <a href="#contact" class="btn btn-primary">Request Quote</a>
                        </div>

                        <!-- Service 3: Training -->
                        <div class="service-card">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <h3>Team Training</h3>
                            <p class="service-description">Comprehensive training programs to upskill your team in AI, ML, and Open Source technologies.</p>
                            <ul class="service-features">
                                <li>Customized Curriculum</li>
                                <li>Hands-on Projects</li>
                                <li>Certification Support</li>
                                <li>Ongoing Support</li>
                            </ul>
                            <div class="service-price">$5,000+ per program</div>
                            <a href="#contact" class="btn btn-primary">Learn More</a>
                        </div>

                    </div><!-- .services-grid -->

                    <!-- CTA Section -->
                    <div class="services-cta">
                        <h2>Ready to Transform Your Business with AI?</h2>
                        <p>Schedule a free 30-minute consultation to discuss your needs</p>
                        <a href="#contact" class="btn btn-large btn-primary">Book Free Consultation</a>
                    </div>

                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
