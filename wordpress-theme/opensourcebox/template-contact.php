<?php
/**
 * Template Name: Contact Page
 *
 * Template for displaying contact form and information
 *
 * @package OpenSourceBox
 * @since 2.2.0
 */

get_header(); ?>

<div id="primary" class="content-area contact-page">
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

                <div class="entry-content">

                    <div class="contact-container">

                        <!-- Contact Form -->
                        <div class="contact-form-section">
                            <h2>Send Us a Message</h2>
                            <p>Fill out the form below and we'll get back to you within 24 hours</p>

                            <form class="contact-form" method="post" action="">
                                <div class="form-group">
                                    <label for="contact_name">Name *</label>
                                    <input type="text" id="contact_name" name="contact_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="contact_email">Email *</label>
                                    <input type="email" id="contact_email" name="contact_email" required>
                                </div>

                                <div class="form-group">
                                    <label for="contact_company">Company</label>
                                    <input type="text" id="contact_company" name="contact_company">
                                </div>

                                <div class="form-group">
                                    <label for="contact_service">Service Interested In</label>
                                    <select id="contact_service" name="contact_service">
                                        <option value="">Please select...</option>
                                        <option value="consulting">AI/ML Consulting</option>
                                        <option value="development">Custom Development</option>
                                        <option value="training">Team Training</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contact_message">Message *</label>
                                    <textarea id="contact_message" name="contact_message" rows="6" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-large">Send Message</button>
                                </div>

                                <input type="hidden" name="action" value="opensourcebox_contact">
                                <?php wp_nonce_field( 'opensourcebox_contact', 'contact_nonce' ); ?>
                            </form>
                        </div>

                        <!-- Contact Info -->
                        <div class="contact-info-section">
                            <h2>Get In Touch</h2>

                            <div class="contact-method">
                                <div class="contact-icon">📧</div>
                                <h3>Email</h3>
                                <p><a href="mailto:hello@opensourcebox.com">hello@opensourcebox.com</a></p>
                            </div>

                            <div class="contact-method">
                                <div class="contact-icon">💬</div>
                                <h3>Live Chat</h3>
                                <p>Available Mon-Fri<br>9am - 6pm EST</p>
                            </div>

                            <div class="contact-method">
                                <div class="contact-icon">📅</div>
                                <h3>Book a Call</h3>
                                <p><a href="#calendar">Schedule free consultation</a></p>
                            </div>

                            <div class="social-links-contact">
                                <h3>Follow Us</h3>
                                <div class="social-icons">
                                    <a href="#" title="Twitter">🐦</a>
                                    <a href="#" title="LinkedIn">💼</a>
                                    <a href="#" title="GitHub">💻</a>
                                    <a href="#" title="YouTube">📹</a>
                                </div>
                            </div>
                        </div>

                    </div><!-- .contact-container -->

                    <!-- FAQ Section -->
                    <div class="contact-faq-section">
                        <h2>Frequently Asked Questions</h2>
                        <div class="faq-grid">
                            <div class="faq-item">
                                <h4>How quickly do you respond?</h4>
                                <p>We typically respond to inquiries within 24 hours during business days.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Do you offer free consultations?</h4>
                                <p>Yes! We offer a free 30-minute consultation to discuss your needs.</p>
                            </div>
                            <div class="faq-item">
                                <h4>What industries do you work with?</h4>
                                <p>We work with healthcare, finance, e-commerce, manufacturing, and more.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Can you help with existing projects?</h4>
                                <p>Absolutely! We can audit and improve your current AI/ML implementations.</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="contact-cta-section">
                        <h2>Not Ready to Reach Out Yet?</h2>
                        <p>Subscribe to our newsletter to get free AI guides and tutorials</p>
                        <a href="#newsletter" class="btn btn-primary btn-large">Get Free Resources</a>
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
