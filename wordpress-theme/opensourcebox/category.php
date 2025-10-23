<?php
/**
 * The template for displaying category pages
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
                    printf( esc_html__( 'Category: %s', 'opensourcebox' ), '<span>' . single_cat_title( '', false ) . '</span>' );
                    ?>
                </h1>
                <?php
                $category_description = category_description();
                if ( ! empty( $category_description ) ) :
                    ?>
                    <div class="taxonomy-description"><?php echo $category_description; ?></div>
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

                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        ?>
                        <footer class="entry-footer">
                            <div class="post-tags">
                                <?php
                                foreach ( $tags as $tag ) {
                                    echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a> ';
                                }
                                ?>
                            </div>
                        </footer>
                    <?php endif; ?>
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
