<?php
/**
 * OpenSourceBox Theme Functions
 *
 * @package OpenSourceBox
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function opensourcebox_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 630, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'opensourcebox' ),
        'footer'  => __( 'Footer Menu', 'opensourcebox' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'opensourcebox_setup' );

/**
 * Set the content width in pixels
 */
function opensourcebox_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'opensourcebox_content_width', 1200 );
}
add_action( 'after_setup_theme', 'opensourcebox_content_width', 0 );

/**
 * Register widget areas
 */
function opensourcebox_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'opensourcebox' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'opensourcebox' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 1', 'opensourcebox' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer.', 'opensourcebox' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'opensourcebox' ),
        'id'            => 'footer-2',
        'description'   => __( 'Add widgets here to appear in your footer.', 'opensourcebox' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 3', 'opensourcebox' ),
        'id'            => 'footer-3',
        'description'   => __( 'Add widgets here to appear in your footer.', 'opensourcebox' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'opensourcebox_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function opensourcebox_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'opensourcebox-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'opensourcebox_scripts' );

/**
 * Custom excerpt length
 */
function opensourcebox_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'opensourcebox_excerpt_length' );

/**
 * Custom excerpt more
 */
function opensourcebox_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'opensourcebox_excerpt_more' );

/**
 * Display posted on meta
 */
function opensourcebox_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        '<span class="posted-on"><span class="screen-reader-text">Posted on </span>%s</span>',
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo $posted_on;
}

/**
 * Display posted by meta
 */
function opensourcebox_posted_by() {
    $byline = sprintf(
        '<span class="byline"><span class="screen-reader-text">by </span><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_html( get_the_author() )
    );

    echo $byline;
}

/**
 * Display categories
 */
function opensourcebox_categories() {
    $categories_list = get_the_category_list( ', ' );
    if ( $categories_list ) {
        printf(
            '<span class="cat-links"><span class="screen-reader-text">Categories: </span>%s</span>',
            $categories_list
        );
    }
}

/**
 * Display tags
 */
function opensourcebox_tags() {
    $tags_list = get_the_tag_list( '', ', ' );
    if ( $tags_list ) {
        printf(
            '<div class="post-tags"><span class="tags-title">Tags: </span>%s</div>',
            $tags_list
        );
    }
}

/**
 * Custom pagination
 */
function opensourcebox_pagination() {
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    // Add current page to the array
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    // Add the pages around the current page to the array
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="pagination"><ul>' . "\n";

    // Previous Post Link
    if ( get_previous_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_previous_posts_link( '&laquo; Previous' ) );
    }

    // Link to first page, plus ellipses if necessary
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="current"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) ) {
            echo '<li>…</li>';
        }
    }

    // Link to current page, plus 2 pages in either direction if necessary
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="current"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    // Link to last page, plus ellipses if necessary
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) ) {
            echo '<li>…</li>' . "\n";
        }

        $class = $paged == $max ? ' class="current"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    // Next Post Link
    if ( get_next_posts_link() ) {
        printf( '<li>%s</li>' . "\n", get_next_posts_link( 'Next &raquo;' ) );
    }

    echo '</ul></div>' . "\n";
}

/**
 * Add custom body classes
 */
function opensourcebox_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'opensourcebox_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts
 */
function opensourcebox_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'opensourcebox_pingback_header' );

/**
 * Customizer additions
 */
function opensourcebox_customize_register( $wp_customize ) {
    // Add footer text setting
    $wp_customize->add_section( 'opensourcebox_footer', array(
        'title'    => __( 'Footer Settings', 'opensourcebox' ),
        'priority' => 130,
    ) );

    $wp_customize->add_setting( 'opensourcebox_footer_text', array(
        'default'           => __( '&copy; ' . date( 'Y' ) . ' OpenSourceBox. All rights reserved.', 'opensourcebox' ),
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'opensourcebox_footer_text', array(
        'label'   => __( 'Footer Text', 'opensourcebox' ),
        'section' => 'opensourcebox_footer',
        'type'    => 'textarea',
    ) );
}
add_action( 'customize_register', 'opensourcebox_customize_register' );

/**
 * Helper function to get footer text
 */
function opensourcebox_footer_text() {
    $footer_text = get_theme_mod( 'opensourcebox_footer_text', '&copy; ' . date( 'Y' ) . ' OpenSourceBox. All rights reserved.' );
    return wp_kses_post( $footer_text );
}

/**
 * Add SEO Meta Tags
 */
function opensourcebox_seo_meta_tags() {
    // Don't output if SEO plugin is active
    if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || class_exists( 'AIOSEO_Core' ) ) {
        return;
    }

    // Get meta description
    $description = '';
    if ( is_singular() ) {
        $post = get_queried_object();
        if ( ! empty( $post->post_excerpt ) ) {
            $description = wp_trim_words( $post->post_excerpt, 30, '...' );
        } else {
            $description = wp_trim_words( strip_shortcodes( $post->post_content ), 30, '...' );
        }
    } elseif ( is_category() ) {
        $description = category_description();
    } elseif ( is_tag() ) {
        $description = tag_description();
    } elseif ( is_home() || is_front_page() ) {
        $description = get_bloginfo( 'description' );
    }

    if ( ! empty( $description ) ) {
        echo '<meta name="description" content="' . esc_attr( strip_tags( $description ) ) . '">' . "\n";
    }

    // Canonical URL
    if ( is_singular() ) {
        echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'opensourcebox_seo_meta_tags', 1 );

/**
 * Add Open Graph Meta Tags
 */
function opensourcebox_open_graph_tags() {
    // Don't output if SEO plugin is active
    if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || class_exists( 'AIOSEO_Core' ) ) {
        return;
    }

    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";

    if ( is_singular() ) {
        $post = get_queried_object();

        // OG Title
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";

        // OG Type
        echo '<meta property="og:type" content="article">' . "\n";

        // OG URL
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";

        // OG Description
        $description = '';
        if ( ! empty( $post->post_excerpt ) ) {
            $description = wp_trim_words( $post->post_excerpt, 30, '...' );
        } else {
            $description = wp_trim_words( strip_shortcodes( $post->post_content ), 30, '...' );
        }
        if ( ! empty( $description ) ) {
            echo '<meta property="og:description" content="' . esc_attr( strip_tags( $description ) ) . '">' . "\n";
        }

        // OG Image
        if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumbnail ) {
                echo '<meta property="og:image" content="' . esc_url( $thumbnail[0] ) . '">' . "\n";
                echo '<meta property="og:image:width" content="' . esc_attr( $thumbnail[1] ) . '">' . "\n";
                echo '<meta property="og:image:height" content="' . esc_attr( $thumbnail[2] ) . '">' . "\n";
            }
        } else {
            // Fallback to site logo
            $logo_url = get_template_directory_uri() . '/images/logo.svg';
            echo '<meta property="og:image" content="' . esc_url( $logo_url ) . '">' . "\n";
        }

        // Article meta
        echo '<meta property="article:published_time" content="' . esc_attr( get_the_date( 'c' ) ) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '">' . "\n";

    } else {
        // Homepage or archives
        echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url( home_url( '/' ) ) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";

        $logo_url = get_template_directory_uri() . '/images/logo.svg';
        echo '<meta property="og:image" content="' . esc_url( $logo_url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'opensourcebox_open_graph_tags', 2 );

/**
 * Add Twitter Card Meta Tags
 */
function opensourcebox_twitter_card_tags() {
    // Don't output if SEO plugin is active
    if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || class_exists( 'AIOSEO_Core' ) ) {
        return;
    }

    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

    if ( is_singular() ) {
        $post = get_queried_object();

        echo '<meta name="twitter:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";

        $description = '';
        if ( ! empty( $post->post_excerpt ) ) {
            $description = wp_trim_words( $post->post_excerpt, 30, '...' );
        } else {
            $description = wp_trim_words( strip_shortcodes( $post->post_content ), 30, '...' );
        }
        if ( ! empty( $description ) ) {
            echo '<meta name="twitter:description" content="' . esc_attr( strip_tags( $description ) ) . '">' . "\n";
        }

        if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumbnail ) {
                echo '<meta name="twitter:image" content="' . esc_url( $thumbnail[0] ) . '">' . "\n";
            }
        } else {
            $logo_url = get_template_directory_uri() . '/images/logo.svg';
            echo '<meta name="twitter:image" content="' . esc_url( $logo_url ) . '">' . "\n";
        }
    } else {
        echo '<meta name="twitter:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";

        $logo_url = get_template_directory_uri() . '/images/logo.svg';
        echo '<meta name="twitter:image" content="' . esc_url( $logo_url ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'opensourcebox_twitter_card_tags', 3 );

/**
 * Add Schema.org JSON-LD structured data
 */
function opensourcebox_schema_markup() {
    // Don't output if SEO plugin is active
    if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || class_exists( 'AIOSEO_Core' ) ) {
        return;
    }

    $schema = array();

    // Website schema
    $schema['@context'] = 'https://schema.org';
    $schema['@type'] = 'WebSite';
    $schema['name'] = get_bloginfo( 'name' );
    $schema['url'] = home_url( '/' );
    $schema['description'] = get_bloginfo( 'description' );

    if ( is_singular( 'post' ) ) {
        $post = get_queried_object();

        $article = array();
        $article['@context'] = 'https://schema.org';
        $article['@type'] = 'Article';
        $article['headline'] = get_the_title();
        $article['datePublished'] = get_the_date( 'c' );
        $article['dateModified'] = get_the_modified_date( 'c' );
        $article['author'] = array(
            '@type' => 'Person',
            'name' => get_the_author()
        );
        $article['publisher'] = array(
            '@type' => 'Organization',
            'name' => get_bloginfo( 'name' ),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_template_directory_uri() . '/images/logo.svg'
            )
        );

        if ( has_post_thumbnail() ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            if ( $thumbnail ) {
                $article['image'] = $thumbnail[0];
            }
        }

        echo '<script type="application/ld+json">' . wp_json_encode( $article, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'opensourcebox_schema_markup', 4 );

/**
 * Disable robots meta tag in production
 * NOTE: WordPress adds noindex in certain conditions. This ensures it's removed.
 */
function opensourcebox_remove_noindex() {
    // Remove noindex from search results, categories, tags, etc.
    // Only keep noindex for privacy-related pages
    if ( ! is_privacy_policy() ) {
        remove_action( 'wp_head', 'wp_robots' );
        remove_action( 'wp_head', 'noindex', 1 );
    }
}
add_action( 'init', 'opensourcebox_remove_noindex' );

/**
 * Ensure blog is public and indexable
 * This adds proper robots meta tag
 */
function opensourcebox_robots_meta() {
    // Check if blog is set to be indexed
    if ( ! get_option( 'blog_public' ) ) {
        // Blog is set to discourage search engines - output noindex
        echo '<meta name="robots" content="noindex, nofollow">' . "\n";
    } else {
        // Blog is public - ensure it's indexable
        // Only add noindex to specific pages that shouldn't be indexed
        if ( is_search() || is_404() || is_privacy_policy() ) {
            echo '<meta name="robots" content="noindex, follow">' . "\n";
        }
    }
}
add_action( 'wp_head', 'opensourcebox_robots_meta', 0 );

/**
 * ==================================
 * MONETIZATION FEATURES v2.2
 * ==================================
 */

/**
 * Add CTA Widget
 */
class OpenSourceBox_CTA_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'opensourcebox_cta',
            'OpenSourceBox: CTA Widget',
            array( 'description' => 'Display a call-to-action box in sidebar' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        ?>
        <div class="cta-widget">
            <h3><?php echo esc_html( $instance['title'] ); ?></h3>
            <p><?php echo esc_html( $instance['text'] ); ?></p>
            <a href="<?php echo esc_url( $instance['button_url'] ); ?>" class="btn btn-primary">
                <?php echo esc_html( $instance['button_text'] ); ?>
            </a>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Get Free AI Guide';
        $text = ! empty( $instance['text'] ) ? $instance['text'] : 'Subscribe to get our comprehensive AI implementation guide.';
        $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : 'Download Now';
        $button_url = ! empty( $instance['button_url'] ) ? $instance['button_url'] : '#';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>">Text:</label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" rows="4"><?php echo esc_textarea( $text ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>">Button Text:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>">Button URL:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? sanitize_textarea_field( $new_instance['text'] ) : '';
        $instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? sanitize_text_field( $new_instance['button_text'] ) : '';
        $instance['button_url'] = ( ! empty( $new_instance['button_url'] ) ) ? esc_url_raw( $new_instance['button_url'] ) : '';
        return $instance;
    }
}

/**
 * Register CTA Widget
 */
function opensourcebox_register_widgets() {
    register_widget( 'OpenSourceBox_CTA_Widget' );
}
add_action( 'widgets_init', 'opensourcebox_register_widgets' );

/**
 * Add email signup form shortcode
 * Usage: [email_signup title="Get Free Guide" button="Subscribe"]
 */
function opensourcebox_email_signup_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => 'Subscribe to Our Newsletter',
        'description' => 'Get the latest AI and ML tutorials delivered to your inbox',
        'button' => 'Subscribe',
        'placeholder' => 'Enter your email',
    ), $atts );

    ob_start();
    ?>
    <div class="email-signup-box">
        <h3><?php echo esc_html( $atts['title'] ); ?></h3>
        <p><?php echo esc_html( $atts['description'] ); ?></p>
        <form class="email-signup-form" method="post" action="">
            <input type="email" name="email" placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>" required>
            <button type="submit" class="btn btn-primary"><?php echo esc_html( $atts['button'] ); ?></button>
            <input type="hidden" name="action" value="opensourcebox_subscribe">
            <?php wp_nonce_field( 'opensourcebox_subscribe', 'subscribe_nonce' ); ?>
        </form>
        <p class="privacy-note">We respect your privacy. Unsubscribe anytime.</p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'email_signup', 'opensourcebox_email_signup_shortcode' );

/**
 * Add CTA box shortcode
 * Usage: [cta_box title="Need Help?" button_text="Contact Us" button_url="/contact"]Your text here[/cta_box]
 */
function opensourcebox_cta_box_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'title' => 'Ready to Get Started?',
        'button_text' => 'Learn More',
        'button_url' => '#',
        'style' => 'gradient', // gradient, outline, solid
    ), $atts );

    $style_class = 'cta-box-' . sanitize_html_class( $atts['style'] );

    ob_start();
    ?>
    <div class="cta-box <?php echo esc_attr( $style_class ); ?>">
        <h3><?php echo esc_html( $atts['title'] ); ?></h3>
        <?php if ( $content ) : ?>
            <p><?php echo wp_kses_post( $content ); ?></p>
        <?php endif; ?>
        <a href="<?php echo esc_url( $atts['button_url'] ); ?>" class="btn btn-primary btn-large">
            <?php echo esc_html( $atts['button_text'] ); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cta_box', 'opensourcebox_cta_box_shortcode' );

/**
 * Add service card shortcode
 * Usage: [service_card title="Consulting" price="$200/hour" icon="💡"]Description here[/service_card]
 */
function opensourcebox_service_card_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'title' => 'Our Service',
        'price' => 'Contact for pricing',
        'icon' => '⭐',
        'button_text' => 'Learn More',
        'button_url' => '#',
    ), $atts );

    ob_start();
    ?>
    <div class="service-card-shortcode">
        <div class="service-icon-shortcode"><?php echo wp_kses_post( $atts['icon'] ); ?></div>
        <h3><?php echo esc_html( $atts['title'] ); ?></h3>
        <?php if ( $content ) : ?>
            <div class="service-description"><?php echo wp_kses_post( wpautop( $content ) ); ?></div>
        <?php endif; ?>
        <div class="service-price"><?php echo esc_html( $atts['price'] ); ?></div>
        <a href="<?php echo esc_url( $atts['button_url'] ); ?>" class="btn btn-primary">
            <?php echo esc_html( $atts['button_text'] ); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'service_card', 'opensourcebox_service_card_shortcode' );

/**
 * Add testimonial shortcode
 * Usage: [testimonial author="John Doe" role="CEO, TechCorp" rating="5"]Great service![/testimonial]
 */
function opensourcebox_testimonial_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'author' => 'Anonymous',
        'role' => '',
        'rating' => '5',
        'image' => '',
    ), $atts );

    $stars = str_repeat( '⭐', intval( $atts['rating'] ) );

    ob_start();
    ?>
    <div class="testimonial-shortcode">
        <?php if ( $atts['image'] ) : ?>
            <img src="<?php echo esc_url( $atts['image'] ); ?>" alt="<?php echo esc_attr( $atts['author'] ); ?>" class="testimonial-image">
        <?php endif; ?>
        <div class="testimonial-stars"><?php echo $stars; ?></div>
        <div class="testimonial-content"><?php echo wp_kses_post( wpautop( $content ) ); ?></div>
        <div class="testimonial-author">
            <strong><?php echo esc_html( $atts['author'] ); ?></strong>
            <?php if ( $atts['role'] ) : ?>
                <span class="testimonial-role"><?php echo esc_html( $atts['role'] ); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'testimonial', 'opensourcebox_testimonial_shortcode' );

/**
 * Add pricing table shortcode
 * Usage: [pricing_table]
 */
function opensourcebox_pricing_table_shortcode() {
    ob_start();
    ?>
    <div class="pricing-table">
        <div class="pricing-column">
            <h3>Basic</h3>
            <div class="price">$99<span>/month</span></div>
            <ul class="pricing-features">
                <li>✓ 10 Projects</li>
                <li>✓ Email Support</li>
                <li>✓ Basic Analytics</li>
            </ul>
            <a href="#contact" class="btn btn-outline">Get Started</a>
        </div>
        <div class="pricing-column featured">
            <div class="popular-badge">Most Popular</div>
            <h3>Professional</h3>
            <div class="price">$299<span>/month</span></div>
            <ul class="pricing-features">
                <li>✓ Unlimited Projects</li>
                <li>✓ Priority Support</li>
                <li>✓ Advanced Analytics</li>
                <li>✓ Custom Integrations</li>
            </ul>
            <a href="#contact" class="btn btn-primary">Get Started</a>
        </div>
        <div class="pricing-column">
            <h3>Enterprise</h3>
            <div class="price">Custom</div>
            <ul class="pricing-features">
                <li>✓ Everything in Pro</li>
                <li>✓ Dedicated Support</li>
                <li>✓ Custom Solutions</li>
                <li>✓ SLA Guarantee</li>
            </ul>
            <a href="#contact" class="btn btn-outline">Contact Sales</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'pricing_table', 'opensourcebox_pricing_table_shortcode' );

/**
 * Add content upgrade box after post content
 */
function opensourcebox_add_content_upgrade( $content ) {
    if ( is_single() && ! is_admin() ) {
        $upgrade_box = '
        <div class="content-upgrade-box">
            <div class="content-upgrade-icon">📥</div>
            <h3>Want to Save This Guide?</h3>
            <p>Download the PDF version of this tutorial + get exclusive bonus checklists</p>
            <a href="#newsletter" class="btn btn-primary">Get Free Download</a>
        </div>
        ';
        $content .= $upgrade_box;
    }
    return $content;
}
add_filter( 'the_content', 'opensourcebox_add_content_upgrade', 20 );

/**
 * Add affiliate link disclosure
 */
function opensourcebox_affiliate_disclosure() {
    if ( is_single() ) {
        echo '<div class="affiliate-disclosure">';
        echo '<p><small>ℹ️ This post may contain affiliate links. We may earn a commission if you click through and make a purchase, at no additional cost to you.</small></p>';
        echo '</div>';
    }
}
add_action( 'opensourcebox_before_content', 'opensourcebox_affiliate_disclosure' );

/**
 * Add estimated reading time
 */
function opensourcebox_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // 200 words per minute

    return $reading_time . ' min read';
}

/**
 * Display reading time in post meta
 */
function opensourcebox_display_reading_time() {
    if ( is_single() ) {
        echo '<span class="reading-time">📖 ' . opensourcebox_reading_time() . '</span>';
    }
}
add_action( 'opensourcebox_post_meta', 'opensourcebox_display_reading_time' );

/**
 * Add custom admin dashboard widget for monetization tips
 */
function opensourcebox_monetization_dashboard_widget() {
    wp_add_dashboard_widget(
        'opensourcebox_monetization',
        '💰 OpenSourceBox Monetization Tips',
        'opensourcebox_monetization_widget_content'
    );
}
add_action( 'wp_dashboard_setup', 'opensourcebox_monetization_dashboard_widget' );

function opensourcebox_monetization_widget_content() {
    ?>
    <div class="opensourcebox-dashboard-widget">
        <h3>Quick Monetization Checklist</h3>
        <ul>
            <li>✓ Email newsletter signup on homepage</li>
            <li>✓ CTA widgets in sidebar</li>
            <li>✓ Services page with pricing</li>
            <li>✓ Lead magnets (free guides/downloads)</li>
            <li>✓ Testimonials for social proof</li>
            <li>✓ Content upgrades on popular posts</li>
        </ul>
        <p><strong>Pro Tip:</strong> Add at least 3 CTAs on your homepage to maximize conversions!</p>
        <a href="/wp-admin/widgets.php" class="button button-primary">Manage Widgets</a>
    </div>
    <?php
}
