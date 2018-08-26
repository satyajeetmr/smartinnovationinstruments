<?php
get_header();
global $post;
$posts_page = get_option('page_for_posts');
$achivepage_id = get_post($posts_page)->ID;
$achivepage_title = get_post($posts_page)->post_title;
$achivepage_content = get_post($posts_page)->post_content;

$class = '';
if (!is_front_page()) {
    $class = 'blog_page';
}
if (get_field('page_title_background_image')) {
    $pagetitle_bg = get_field('page_title_background_image');
} else if (get_field('page_title_background_image', 'option')) {
    $pagetitle_bg = get_field('page_title_background_image', 'option');
}

if ($pagetitle_bg) {
    ?>
    <style>
        .page_title {
            background-image: url(<?php echo $pagetitle_bg; ?>);
        }
    </style>
    <?php
}
?>
<main class="main_page <?php echo $class; ?>" id="main_page">
    <?php if (have_posts()) : ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="page_title">
                <div class="container">
                    <?php
                    echo '<h1 class="entry-title">' . $achivepage_title . '</h1>';
                    ?>
                </div>
            </div><!-- page title -->

            <div class="grey-bg img_w_content">
                <div class="container">
                    <div class="row tableDiv">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6 tableCell">
                            <?php echo get_the_post_thumbnail($achivepage_id, 'full'); ?>                          
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6 tableCell">
                            <?php
                            echo apply_filters('the_content', $achivepage_content);
                            ?>
                        </div>
                    </div>
                </div>
            </div><!-- img_w_content -->

            <div class="col_2_content">
                <div class="container">
                    <div class="blog_listing">
                        <?php
                        $i = 1;
                        while (have_posts()) : the_post();
                            $post_id = $post->ID;
                            ?>
                            <div class="row" id="post-<?php echo $post_id; ?>">
                                <?php
                                $read_more = ' <h5 class="read-more"><a href="' . get_the_permalink() . '">Read More...</a></h5>';
                                /* translators: %s: Name of current post */
                                $content = get_the_content();
                                ?>
                                <?php
                                if (has_post_thumbnail($post_id)):
                                    $trimmed_content = wp_trim_words( $content, 70, $read_more );
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 img_div">
                                        <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post_id, 'full'); ?></a>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 text_div hide-img">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php
                                        echo apply_filters('the_content',$trimmed_content);
                                        //echo html_entity_decode(wp_trim_words(htmlentities(wpautop($content)), 70, $read_more));
                                        ?>								
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text_div">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <?php
                                         $trimmed_content = wp_trim_words( $content, 70, $read_more );
                                        echo apply_filters('the_content',$trimmed_content);
                                        ?>
                                        <?php // echo force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(wpautop($content)), 70, $read_more))); ?>							
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 imp_links">
                                    <?php
                                    if (in_array(get_post_type(), array('post', 'attachment'))) {
                                        page1bloggers_entry_date();
                                    }
                                    if ('post' === get_post_type()) {
                                        page1bloggers_entry_taxonomies();
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php
                    // Previous/next page navigation.
                    the_posts_pagination(array(
                        'prev_text' => __('&lt; Previous', 'twentysixteen'),
                        'next_text' => __('Next &gt;', 'twentysixteen'),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('', 'twentysixteen') . ' </span>',
                    ));
                    ?>
                </div>
            </div><!-- img_w_content -->

        </article><!-- #post-## -->
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'page1bloggers') . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '<span class="screen-reader-text">' . __('Page', 'page1bloggers') . ' </span>%',
            'separator' => '<span class="screen-reader-text">, </span>',
        ));
    /* if (comments_open() || get_comments_number()) {
      comments_template();
      } */
    // If no content, include the "No posts found" template.
    else :
        get_template_part('template-parts/content', 'none');

    endif;
    ?>
</main>
<?php get_footer(); ?>