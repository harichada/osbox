<?php
/**
 * The main template file
 *
 * @package OpenSourceBox
 * @since 1.0.0
 */

get_header();
?>

<div class="site-container">
    <main id="primary" class="content-area">

        <?php if ( have_posts() ) : ?>

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;
                        ?>

                        <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php
                                opensourcebox_posted_on();
                                echo ' ';
                                opensourcebox_posted_by();
                                echo ' ';
                                opensourcebox_categories();
                                ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        if ( is_singular() ) {
                            the_content();

                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'opensourcebox' ),
                                'after'  => '</div>',
                            ) );
                        } else {
                            the_excerpt();
                            ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link">
                                <?php echo esc_html__( 'Read More', 'opensourcebox' ); ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div><!-- .entry-content -->

                    <?php if ( is_singular() && 'post' === get_post_type() ) : ?>
                        <footer class="entry-footer">
                            <?php opensourcebox_tags(); ?>
                        </footer><!-- .entry-footer -->
                    <?php endif; ?>
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile;

            // Pagination
            opensourcebox_pagination();

        else :
            ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'opensourcebox' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'opensourcebox' ),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url( admin_url( 'post-new.php' ) )
                            );
                            ?>
                        </p>

                    <?php elseif ( is_search() ) : ?>

                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'opensourcebox' ); ?></p>
                        <?php
                        get_search_form();

                    else :
                        ?>

                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'opensourcebox' ); ?></p>
                        <?php
                        get_search_form();

                    endif;
                    ?>
                </div><!-- .page-content -->
            </section><!-- .no-results -->

        <?php endif; ?>

    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div><!-- .site-container -->

<?php
get_footer();
