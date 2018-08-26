<?php
/**
 * Custom smartinnovation template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage smartinnovation
 * @since smartinnovation 1.0
 */
if (!function_exists('smartinnovation_fonts_url')) :
    /**
     * Register Google fonts for smartinnovation.
     *
     * Create your own smartinnovation_fonts_url() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     *
     * @return string Google fonts URL for the theme.
     */
//    ini_set('display_errors', 'Off');
//    ini_set('error_reporting', E_ALL);
//    define('WP_DEBUG', false);
//    define('WP_DEBUG_DISPLAY', false);

    function smartinnovation_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Merriweather font: on or off', 'smartinnovation')) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Montserrat font: on or off', 'smartinnovation')) {
            $fonts[] = 'Montserrat:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'smartinnovation')) {
            $fonts[] = 'Inconsolata:400';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                    ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

if (!function_exists('smartinnovation_setup')) :

    function smartinnovation_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/smartinnovation
         * If you're building a theme based on smartinnovation, use a find and replace
         * to change 'smartinnovation' to the name of your theme in all the template files
         */
        load_theme_textdomain('smartinnovation');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');


        add_theme_support('custom-logo', array(
            'height' => 100,
            'width' => 430,
            'flex-height' => true,
        ));

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 9999);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'smartinnovation'),
            'social' => __('Social Links Menu', 'smartinnovation'),
            'footer' => __('Footer Menu', 'smartinnovation'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', smartinnovation_fonts_url()));

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');
    }

endif; // smartinnovation_setup
add_action('after_setup_theme', 'smartinnovation_setup');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since smartinnovation 1.0
 */
function smartinnovation_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'smartinnovation_javascript_detection', 0);

/**
 * Enqueues scripts and styles.
 *
 * @since smartinnovation 1.0
 */
function smartinnovation_scripts() {
    global $post;
    
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.1.1' );
    wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.1.1');
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.css', array(), '1.1.1');
    wp_enqueue_style('prettyPhoto-css', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1.1.1');
    wp_enqueue_style('mmenu-css', get_template_directory_uri() . '/mmenu-master/css/jquery.mmenu.all.css', array(), '1.1.1');
    wp_enqueue_style('style-css', get_template_directory_uri() . '/css/style.css', array(), '1.1.1');

    // Theme stylesheet.
    wp_enqueue_style('smartinnovation-style', get_stylesheet_uri());

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    
    wp_enqueue_script('mmenu-script', get_template_directory_uri() . '/mmenu-master/js/jquery.mmenu.min.all.js', array('jquery'), '10', true);
    wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '11', true);
    wp_enqueue_script('prettyPhoto-script', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '12', true);
    wp_enqueue_script('wow-script', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '121', true);
    wp_enqueue_script('functions-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '13', true);

    //wp_localize_script( 'smartinnovation-script');
//    wp_localize_script('mmenu-script');
//    wp_localize_script('bootstrap-script');
//    wp_localize_script('prettyPhoto-script');
//    wp_localize_script('functions-script');
}

add_action('wp_enqueue_scripts', 'smartinnovation_scripts');

/**
 * Converts a HEX value to RGB.
 *
 * @since smartinnovation 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function smartinnovation_hex2rgb($color) {
    $color = trim($color, '#');

    if (strlen($color) === 3) {
        $r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
        $g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
        $b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
    } else if (strlen($color) === 6) {
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));
    } else {
        return array();
    }

    return array('red' => $r, 'green' => $g, 'blue' => $b);
}

function smartinnovation_content_width() {
    $GLOBALS['content_width'] = apply_filters('smartinnovation_content_width', 840);
}

add_action('after_setup_theme', 'smartinnovation_content_width', 0);

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
function smartinnovation_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'smartinnovation'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'smartinnovation'),
        'before_widget' => '<section id="%1$s" class="sidebar widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer First Column', 'smartinnovation'),
        'id' => 'sidebar-2',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-1 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => __('Footer Second Column', 'smartinnovation'),
        'id' => 'sidebar-3',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-2 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => __('Footer Third Column', 'smartinnovation'),
        'id' => 'sidebar-4',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-3 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer Fourth Column', 'smartinnovation'),
        'id' => 'sidebar-5',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-4 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer Fifth Column', 'smartinnovation'),
        'id' => 'sidebar-6',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-5 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer Bottom', 'smartinnovation'),
        'id' => 'sidebar-7',
        'description' => __('Appears at the bottom of the content on posts and pages.', 'smartinnovation'),
        'before_widget' => '<div id="%1$s" class="widget-6 widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
}

add_action('widgets_init', 'smartinnovation_widgets_init');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function smartinnovation_body_classes($classes) {

    // Adds a class of group-blog to sites with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    if (is_singular('page')) {
        global $post;
        $classes[] = $post->post_name;
    }

    // Adds a class of no-sidebar to sites without active sidebar.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}

add_filter('body_class', 'smartinnovation_body_classes');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since smartinnovation 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function smartinnovation_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];

    if (840 <= $width) {
        $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
    }

    if ('page' === get_post_type()) {
        if (840 > $width) {
            $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
        }
    } else {
        if (840 > $width && 600 <= $width) {
            $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        } elseif (600 > $width) {
            $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
        }
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'smartinnovation_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since smartinnovation 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function smartinnovation_post_thumbnail_sizes_attr($attr, $attachment, $size) {
    if ('post-thumbnail' === $size) {
        if (is_active_sidebar('sidebar-1')) {
            $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        } else {
            $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
        }
    }
    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'smartinnovation_post_thumbnail_sizes_attr', 10, 3);


if (!function_exists('smartinnovation_entry_meta')) :

    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * Create your own smartinnovation_entry_meta() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     */
    function smartinnovation_entry_meta() {
        if ('post' === get_post_type()) {
            $author_avatar_size = apply_filters('smartinnovation_author_avatar_size', 49);
            printf('<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', get_avatar(get_the_author_meta('user_email'), $author_avatar_size), _x('Author', 'Used before post author name.', 'smartinnovation'), esc_url(get_author_posts_url(get_the_author_meta('ID'))), get_the_author()
            );
        }

        if (in_array(get_post_type(), array('post', 'attachment'))) {
            smartinnovation_entry_date();
        }

        $format = get_post_format();
        if (current_theme_supports('post-formats', $format)) {
            printf('<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>', sprintf('<span class="screen-reader-text">%s </span>', _x('Format', 'Used before post format.', 'smartinnovation')), esc_url(get_post_format_link($format)), get_post_format_string($format)
            );
        }

        if ('post' === get_post_type()) {
            smartinnovation_entry_taxonomies();
        }

        if (!is_singular() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(sprintf(__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'smartinnovation'), get_the_title()));
            echo '</span>';
        }
    }

endif;

if (!function_exists('smartinnovation_entry_date')) :

    /**
     * Prints HTML with date information for current post.
     *
     * Create your own smartinnovation_entry_date() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     */
    function smartinnovation_entry_date() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            //$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), get_the_date(), esc_attr(get_the_modified_date('c')), get_the_modified_date()
        );

        printf('<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>', _x('Posted on', 'Used before publish date.', 'smartinnovation'), esc_url(get_permalink()), $time_string
        );
    }

endif;

if (!function_exists('smartinnovation_entry_taxonomies')) :

    /**
     * Prints HTML with category and tags for current post.
     *
     * Create your own smartinnovation_entry_taxonomies() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     */
    function smartinnovation_entry_taxonomies() {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'smartinnovation'));
        if ($categories_list && smartinnovation_categorized_blog()) {
            printf('<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Categories', 'Used before category names.', 'smartinnovation'), $categories_list
            );
        }

        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'smartinnovation'));
        if ($tags_list && !is_wp_error($tags_list)) {
            printf('<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Tags', 'Used before tag names.', 'smartinnovation'), $tags_list
            );
        }
    }

endif;

if (!function_exists('smartinnovation_post_thumbnail')) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     *
     * Create your own smartinnovation_post_thumbnail() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     */
    function smartinnovation_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
            <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>
            </a>

            <?php
            endif; // End is_singular()
        }

    endif;

    if (!function_exists('smartinnovation_excerpt')) :

        /**
         * Displays the optional excerpt.
         *
         * Wraps the excerpt in a div element.
         *
         * Create your own smartinnovation_excerpt() function to override in a child theme.
         *
         * @since smartinnovation 1.0
         *
         * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
         */
        function smartinnovation_excerpt($class = 'entry-summary') {
            $class = esc_attr($class);

            if (has_excerpt() || is_search()) :
                ?>
            <div class="<?php echo $class; ?>">
            <?php the_excerpt(); ?>
            </div><!-- .<?php echo $class; ?> -->
        <?php
        endif;
    }

endif;

if (!function_exists('smartinnovation_excerpt_more') && !is_admin()) :

    /**
     * Replaces "[...]" (appended to automatically generated excerpts) with ... and
     * a 'Continue reading' link.
     *
     * Create your own smartinnovation_excerpt_more() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     *
     * @return string 'Continue reading' link prepended with an ellipsis.
     */
    function smartinnovation_excerpt_more() {
        $link = sprintf('<a href="%1$s" class="more-link">%2$s</a>', esc_url(get_permalink(get_the_ID())),
                /* translators: %s: Name of current post */ sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'smartinnovation'), get_the_title(get_the_ID()))
        );
        return ' &hellip; ' . $link;
    }

    add_filter('excerpt_more', 'smartinnovation_excerpt_more');
endif;

if (!function_exists('smartinnovation_categorized_blog')) :

    /**
     * Determines whether blog/site has more than one category.
     *
     * Create your own smartinnovation_categorized_blog() function to override in a child theme.
     *
     * @since smartinnovation 1.0
     *
     * @return bool True if there is more than one category, false otherwise.
     */
    function smartinnovation_categorized_blog() {
        if (false === ( $all_the_cool_cats = get_transient('smartinnovation_categories') )) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                // We only need to know if there is more than one category.
                'number' => 2,
                    ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('smartinnovation_categories', $all_the_cool_cats);
        }

        if ($all_the_cool_cats > 1 || is_preview()) {
            // This blog has more than 1 category so smartinnovation_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so smartinnovation_categorized_blog should return false.
            return false;
        }
    }

endif;

/**
 * Flushes out the transients used in smartinnovation_categorized_blog().
 *
 * @since smartinnovation 1.0
 */
function smartinnovation_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('smartinnovation_categories');
}

add_action('edit_category', 'smartinnovation_category_transient_flusher');
add_action('save_post', 'smartinnovation_category_transient_flusher');

if (!function_exists('smartinnovation_the_custom_logo')) :

    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     * @since smartinnovation 1.2
     */
    function smartinnovation_the_custom_logo() {
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        return $image;
        /* if ( function_exists( 'the_custom_logo' ) ) {
          the_custom_logo();
          } */
    }

endif;

class My_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-flyout ui-scroll\">\n";
    }

}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page();
}

function filter_plugin_updates($value) {
    unset($value->response['advanced-custom-fields-pro-master/acf.php']);
    return $value;
}

add_filter('site_transient_update_plugins', 'filter_plugin_updates');


add_shortcode('social_link', 'func_social_link');

function func_social_link() {
    $items .= '<ul class="social_icon">';
    if (get_field('facebook', 'option') != '') {
        $items .= '<li><a href="' . get_field('facebook', 'option') . '" class="icon facebook"></a></li>';
    }
    if (get_field('twitter', 'option') != '') {
        $items .= '<li><a href="' . get_field('twitter', 'option') . '" class="icon twitter"></a></li>';
    }
    if (get_field('google_plus', 'option') != '') {
        $items .= '<li><a href="' . get_field('google_plus', 'option') . '" class="icon googleplus"></a></li>';
    }
    if (get_field('linkedin', 'option') != '') {
        $items .= '<li><a href="' . get_field('linkedin', 'option') . '" class="icon linkedin"></a></li>';
    }
    $items .= '</ul>';
    return $items;
}

// [cta] shortcode
function shortcode_CallToAction($params = array(), $content) {
    // default parameters
    extract(shortcode_atts(array(
        'href' => 'tel:' . the_field('banner_phone_call_button', 'option'),
        'type' => ''
                    ), $params));

    // create link in button style
    return
            '<div class="text-center"><a class="call_us_btn' .
            ($type ? " $type" : '') .
            '">' .
            do_shortcode($content) .
            '</a></div>';
}

add_shortcode('cta', 'shortcode_CallToAction');

// do NOT include the opening line! Just add what's below to the end of your functions.php file
add_action('edit_form_after_title', 'rgc_posts_page_edit_form');

function rgc_posts_page_edit_form($post) {
    $posts_page = get_option('page_for_posts');
    if ($posts_page === $post->ID) {
        add_post_type_support('page', 'editor');
    }
}

add_action('init', 'codex_book_init');

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_book_init() {
    $labels = array(
        'name' => _x('Services', 'post type general name', 'smartinnovation'),
        'singular_name' => _x('Service', 'post type singular name', 'smartinnovation'),
        'menu_name' => _x('Services', 'admin menu', 'smartinnovation'),
        'name_admin_bar' => _x('Services', 'add new on admin bar', 'smartinnovation'),
        'add_new' => _x('Add New', 'service', 'smartinnovation'),
        'add_new_item' => __('Add New Service', 'smartinnovation'),
        'new_item' => __('New Service', 'smartinnovation'),
        'edit_item' => __('Edit Service', 'smartinnovation'),
        'view_item' => __('View Service', 'smartinnovation'),
        'all_items' => __('All Services', 'smartinnovation'),
        'search_items' => __('Search Services', 'smartinnovation'),
        'parent_item_colon' => __('Parent Services:', 'smartinnovation'),
        'not_found' => __('No services found.', 'smartinnovation'),
        'not_found_in_trash' => __('No services found in Trash.', 'smartinnovation')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'smartinnovation'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'services'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('services', $args);

    // register testimonials
    $labels = array(
        'name' => _x('Testimonials', 'post type general name', 'smartinnovation'),
        'singular_name' => _x('Testimonial', 'post type singular name', 'smartinnovation'),
        'menu_name' => _x('Testimonials', 'admin menu', 'smartinnovation'),
        'name_admin_bar' => _x('Testimonials', 'add new on admin bar', 'smartinnovation'),
        'add_new' => _x('Add New', 'testimonial', 'smartinnovation'),
        'add_new_item' => __('Add New Testimonial', 'smartinnovation'),
        'new_item' => __('New Testimonial', 'smartinnovation'),
        'edit_item' => __('Edit Testimonial', 'smartinnovation'),
        'view_item' => __('View Testimonial', 'smartinnovation'),
        'all_items' => __('All Testimonials', 'smartinnovation'),
        'search_items' => __('Search Testimonials', 'smartinnovation'),
        'parent_item_colon' => __('Parent Testimonials:', 'smartinnovation'),
        'not_found' => __('No testimonials found.', 'smartinnovation'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'smartinnovation')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'smartinnovation'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'testimonials'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('testimonials', $args);

    // register Portfolio
    $labels = array(
        'name' => _x('Portfolios', 'post type general name', 'smartinnovation'),
        'singular_name' => _x('Portfolio', 'post type singular name', 'smartinnovation'),
        'menu_name' => _x('Portfolios', 'admin menu', 'smartinnovation'),
        'name_admin_bar' => _x('Portfolios', 'add new on admin bar', 'smartinnovation'),
        'add_new' => _x('Add New', 'portfolio', 'smartinnovation'),
        'add_new_item' => __('Add New Portfolio', 'smartinnovation'),
        'new_item' => __('New Portfolio', 'smartinnovation'),
        'edit_item' => __('Edit Portfolio', 'smartinnovation'),
        'view_item' => __('View Portfolio', 'smartinnovation'),
        'all_items' => __('All Portfolios', 'smartinnovation'),
        'search_items' => __('Search Portfolios', 'smartinnovation'),
        'parent_item_colon' => __('Parent Portfolios:', 'smartinnovation'),
        'not_found' => __('No portfolios found.', 'smartinnovation'),
        'not_found_in_trash' => __('No portfolios found in Trash.', 'smartinnovation')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'smartinnovation'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('Portfolios', $args);
}
