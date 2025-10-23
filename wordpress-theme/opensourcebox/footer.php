<?php
/**
 * The footer for OpenSourceBox theme
 *
 * @package OpenSourceBox
 * @since 1.0.0
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-container">
            <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
                <div class="footer-widgets">
                    <div class="footer-widget-area">
                        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="footer-widget-area">
                        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="footer-widget-area">
                        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                            <div class="footer-widget">
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div><!-- .footer-widgets -->
            <?php endif; ?>

            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'depth'          => 1,
                        )
                    );
                    ?>
                </nav>
            <?php endif; ?>

            <div class="site-info">
                <?php echo opensourcebox_footer_text(); ?>
                <?php
                printf(
                    ' | <a href="%s">%s</a>',
                    esc_url( __( 'https://wordpress.org/', 'opensourcebox' ) ),
                    sprintf( __( 'Powered by %s', 'opensourcebox' ), 'WordPress' )
                );
                ?>
            </div><!-- .site-info -->
        </div><!-- .site-container -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
