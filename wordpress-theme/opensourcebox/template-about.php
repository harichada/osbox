<?php
/**
 * Template Name: About Page
 *
 * Template for displaying About/Company page with team, story, etc.
 *
 * @package OpenSourceBox
 * @since 2.2.0
 */

get_header(); ?>

<div id="primary" class="content-area about-page">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header centered">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php if ( get_the_excerpt() ) : ?>
                        <p class="entry-subtitle"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="about-hero-image">
                        <?php the_post_thumbnail( 'full' ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>

                    <!-- Mission/Vision Section -->
                    <div class="mission-section">
                        <div class="mission-grid">
                            <div class="mission-item">
                                <h3>🎯 Our Mission</h3>
                                <p>To make AI and Machine Learning accessible to businesses of all sizes through practical, actionable content and expert guidance.</p>
                            </div>
                            <div class="mission-item">
                                <h3>👁️ Our Vision</h3>
                                <p>A world where every business can leverage the power of AI to solve real problems and create meaningful impact.</p>
                            </div>
                            <div class="mission-item">
                                <h3>💡 Our Values</h3>
                                <p>Open source, practical solutions, continuous learning, and empowering developers worldwide.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="stats-section">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">143+</div>
                                <div class="stat-label">In-Depth Tutorials</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">10K+</div>
                                <div class="stat-label">Active Readers</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Projects Completed</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">98%</div>
                                <div class="stat-label">Client Satisfaction</div>
                            </div>
                        </div>
                    </div>

                    <!-- Why Choose Us Section -->
                    <div class="why-choose-section">
                        <h2>Why Work With Us?</h2>
                        <div class="features-grid">
                            <div class="feature-box">
                                <div class="feature-icon">🚀</div>
                                <h3>Proven Expertise</h3>
                                <p>Years of experience implementing AI/ML solutions across various industries</p>
                            </div>
                            <div class="feature-box">
                                <div class="feature-icon">💼</div>
                                <h3>Business-Focused</h3>
                                <p>We focus on ROI and practical implementations, not just theory</p>
                            </div>
                            <div class="feature-box">
                                <div class="feature-icon">🔧</div>
                                <h3>Hands-On Support</h3>
                                <p>From strategy to implementation, we're with you every step</p>
                            </div>
                            <div class="feature-box">
                                <div class="feature-icon">🌟</div>
                                <h3>Open Source First</h3>
                                <p>Cost-effective solutions using battle-tested open source tools</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="about-cta-section">
                        <h2>Ready to Start Your AI Journey?</h2>
                        <p>Let's discuss how we can help transform your business with AI</p>
                        <div class="cta-buttons">
                            <a href="/services" class="btn btn-primary btn-large">View Services</a>
                            <a href="/contact" class="btn btn-secondary btn-large">Get In Touch</a>
                        </div>
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
