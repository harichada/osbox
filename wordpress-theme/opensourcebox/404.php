<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package OpenSourceBox
 * @since 1.0.0
 */

get_header();
?>

<div class="site-container">
    <main id="primary" class="content-area">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'opensourcebox' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'opensourcebox' ); ?></p>

                <?php get_search_form(); ?>

                <div class="widget widget_categories">
                    <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'opensourcebox' ); ?></h2>
                    <ul>
                        <?php
                        wp_list_categories(
                            array(
                                'orderby'    => 'count',
                                'order'      => 'DESC',
                                'show_count' => 1,
                                'title_li'   => '',
                                'number'     => 10,
                            )
                        );
                        ?>
                    </ul>
                </div><!-- .widget -->

                <?php
                // Recent Posts Widget
                $recent_posts = wp_get_recent_posts(
                    array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ),
                    'OBJECT'
                );

                if ( $recent_posts ) :
                    ?>
                    <div class="widget widget_recent_entries">
                        <h2 class="widget-title"><?php esc_html_e( 'Recent Posts', 'opensourcebox' ); ?></h2>
                        <ul>
                            <?php foreach ( $recent_posts as $recent_post ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( get_permalink( $recent_post->ID ) ); ?>">
                                        <?php echo esc_html( $recent_post->post_title ); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- .widget -->
                <?php endif; ?>

                <?php
                // Tag Cloud Widget
                $tags = get_tags(
                    array(
                        'orderby' => 'count',
                        'order'   => 'DESC',
                        'number'  => 20,
                    )
                );

                if ( $tags ) :
                    ?>
                    <div class="widget widget_tag_cloud">
                        <h2 class="widget-title"><?php esc_html_e( 'Popular Tags', 'opensourcebox' ); ?></h2>
                        <div class="tagcloud">
                            <?php
                            foreach ( $tags as $tag ) {
                                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-cloud-link">' . esc_html( $tag->name ) . '</a> ';
                            }
                            ?>
                        </div>
                    </div><!-- .widget -->
                <?php endif; ?>

            </div><!-- .page-content -->
        </section><!-- .error-404 -->

    </main><!-- #primary -->

    <?php get_sidebar(); ?>
</div><!-- .site-container -->

<?php
get_footer();
