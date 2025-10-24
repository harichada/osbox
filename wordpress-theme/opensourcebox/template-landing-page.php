<?php
/**
 * Template Name: Landing Page - Full Width
 *
 * Template for high-conversion landing pages
 * No sidebar, full-width, optimized for lead capture
 *
 * @package OpenSourceBox
 * @since 2.2.0
 */

get_header(); ?>

<div id="primary" class="content-area landing-page">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="hero-section" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>');">
                        <div class="hero-overlay">
                            <div class="hero-content">
                                <h1 class="hero-title"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'opensourcebox' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
