<?php
/**
 * The template for displaying tag pages
 *
 * @package OpenSourceBox
 * @since 1.0.0
 */

get_header();
?>

<div class="site-container">
    <main id="primary" class="content-area">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf( esc_html__( 'Tag: %s', 'opensourcebox' ), '<span>' . single_tag_title( '', false ) . '</span>' );
                    ?>
                </h1>
                <?php
                $tag_description = tag_description();
                if ( ! empty( $tag_description ) ) :
                    ?>
                    <div class="taxonomy-description"><?php echo $tag_description; ?></div>
                <?php endif; ?>
            </header><!-- .page-header -->

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                        <div class="entry-meta">
                            <?php
                            opensourcebox_posted_on();
                            echo ' ';
                            opensourcebox_posted_by();
                            echo ' ';
                            opensourcebox_categories();
                            ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_excerpt();
                        ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link">
                            <?php echo esc_html__( 'Read More', 'opensourcebox' ); ?>
                        </a>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile;

            opensourcebox_pagination();

        else :
            ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'opensourcebox' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'opensourcebox' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section><!-- .no-results -->

        <?php endif; ?>

    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div><!-- .site-container -->

<?php
get_footer();
