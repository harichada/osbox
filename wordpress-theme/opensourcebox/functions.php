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
