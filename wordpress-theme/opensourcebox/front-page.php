<?php
/**
 * Template for displaying the homepage
 * Optimized for conversions and lead generation
 *
 * @package OpenSourceBox
 * @since 2.2.0
 */

get_header(); ?>

<div id="primary" class="content-area front-page">
    <main id="main" class="site-main">

        <!-- Hero Section -->
        <section class="hero-section-home">
            <div class="site-container">
                <div class="hero-content">
                    <h1 class="hero-headline">
                        Master AI, Machine Learning & Open Source
                    </h1>
                    <p class="hero-subheadline">
                        Practical tutorials, expert guidance, and cutting-edge insights to transform your business with AI
                    </p>
                    <div class="hero-cta">
                        <a href="#newsletter" class="btn btn-primary btn-large">Get Free AI Guide</a>
                        <a href="/services" class="btn btn-secondary btn-large">Explore Services</a>
                    </div>
                    <div class="hero-trust">
                        <p>⭐ Trusted by 10,000+ developers and businesses</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Proposition -->
        <section class="value-props">
            <div class="site-container">
                <div class="value-grid">
                    <div class="value-item">
                        <div class="value-icon">📚</div>
                        <h3>143+ In-Depth Tutorials</h3>
                        <p>Step-by-step guides on AI, ML, and Open Source technologies</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">💼</div>
                        <h3>Business-Ready Solutions</h3>
                        <p>Practical implementations you can use today</p>
                    </div>
                    <div class="value-item">
                        <div class="value-icon">🚀</div>
                        <h3>Expert Consulting</h3>
                        <p>Get personalized help for your AI projects</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Signup -->
        <section id="newsletter" class="newsletter-section">
            <div class="site-container">
                <div class="newsletter-box">
                    <div class="newsletter-content">
                        <h2>🎁 Free: The AI Implementation Starter Kit</h2>
                        <p class="newsletter-benefits">Get our comprehensive guide + weekly insights on AI, ML, and automation</p>
                        <ul class="newsletter-checklist">
                            <li>✅ AI Use Cases Checklist (50+ ideas)</li>
                            <li>✅ ML Algorithm Decision Tree</li>
                            <li>✅ Open Source Tools Comparison</li>
                            <li>✅ Weekly tutorials & case studies</li>
                        </ul>
                    </div>
                    <div class="newsletter-form-container">
                        <form class="newsletter-form" action="#" method="post">
                            <input type="email" name="email" placeholder="Enter your email" required>
                            <input type="text" name="name" placeholder="Your name" required>
                            <button type="submit" class="btn btn-primary btn-large">Get Free Kit Now</button>
                            <p class="newsletter-privacy">No spam. Unsubscribe anytime. Privacy guaranteed.</p>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Posts -->
        <section class="featured-posts">
            <div class="site-container">
                <div class="section-header">
                    <h2>🔥 Most Popular Tutorials</h2>
                    <a href="/blog" class="view-all">View All →</a>
                </div>

                <div class="posts-grid">
                    <?php
                    $featured_args = array(
                        'posts_per_page' => 6,
                        'post_status'    => 'publish',
                        'orderby'        => 'comment_count',
                        'order'          => 'DESC',
                    );
                    $featured_query = new WP_Query( $featured_args );

                    if ( $featured_query->have_posts() ) :
                        while ( $featured_query->have_posts() ) :
                            $featured_query->the_post();
                            ?>
                            <article class="post-card">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="post-card-content">
                                    <div class="post-card-meta">
                                        <?php
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo '<span class="post-category">' . esc_html( $categories[0]->name ) . '</span>';
                                        }
                                        ?>
                                    </div>
                                    <h3 class="post-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="post-card-excerpt">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <!-- Services Preview -->
        <section class="services-preview">
            <div class="site-container">
                <div class="section-header centered">
                    <h2>Work With Us</h2>
                    <p>Need help implementing AI in your business? We've got you covered.</p>
                </div>

                <div class="services-grid-home">
                    <div class="service-box">
                        <h3>💡 AI Consulting</h3>
                        <p>Strategy, planning, and implementation guidance from experienced AI practitioners.</p>
                        <a href="/services" class="btn btn-outline">Learn More</a>
                    </div>
                    <div class="service-box">
                        <h3>⚡ Custom Development</h3>
                        <p>Build bespoke AI solutions, chatbots, and automation tools for your business.</p>
                        <a href="/services" class="btn btn-outline">Learn More</a>
                    </div>
                    <div class="service-box">
                        <h3>📖 Team Training</h3>
                        <p>Upskill your team with hands-on training in AI, ML, and Open Source technologies.</p>
                        <a href="/services" class="btn btn-outline">Learn More</a>
                    </div>
                </div>

                <div class="services-cta-home">
                    <a href="/services" class="btn btn-primary btn-large">View All Services</a>
                </div>
            </div>
        </section>

        <!-- Social Proof / Testimonials -->
        <section class="testimonials">
            <div class="site-container">
                <h2>What Our Clients Say</h2>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"OpenSourceBox helped us implement ML models that increased our efficiency by 40%. Highly recommended!"</p>
                        <p class="testimonial-author">— Sarah Chen, CTO at TechCorp</p>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"The tutorials are comprehensive and easy to follow. We built our first chatbot in just 2 weeks!"</p>
                        <p class="testimonial-author">— Michael Rodriguez, Lead Developer</p>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Best resource for practical AI implementation. The consulting services saved us months of trial and error."</p>
                        <p class="testimonial-author">— Jennifer Park, Product Manager</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories / Topics -->
        <section class="topics-section">
            <div class="site-container">
                <h2>Explore By Topic</h2>
                <div class="topics-grid">
                    <?php
                    $categories = get_categories( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'number'     => 6,
                        'hide_empty' => true,
                    ) );

                    foreach ( $categories as $category ) :
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="topic-card">
                            <h3><?php echo esc_html( $category->name ); ?></h3>
                            <p><?php echo esc_html( $category->count ); ?> articles</p>
                        </a>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="final-cta">
            <div class="site-container">
                <h2>Ready to Transform Your Business with AI?</h2>
                <p>Join 10,000+ developers and businesses leveraging AI for growth</p>
                <div class="cta-buttons">
                    <a href="#newsletter" class="btn btn-primary btn-large">Get Free AI Kit</a>
                    <a href="/contact" class="btn btn-secondary btn-large">Book Consultation</a>
                </div>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
