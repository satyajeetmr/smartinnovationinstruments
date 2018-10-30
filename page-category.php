<?php
/*
 * Template Name: Product Template 
 */
get_header();
global $post;
$class = '';
if (!is_front_page()) {
    $class = 'category-page';
}
if (get_field('page_title_background_image')) {
    $pagetitle_bg = get_field('page_title_background_image');
} else if (get_field('page_title_background_image', 'option')) {
    $pagetitle_bg = get_field('page_title_background_image', 'option');
}

if ($pagetitle_bg) {
    ?>
    <style>
        .page-title {
            background-image: url(<?php echo $pagetitle_bg; ?>);
        }
    </style>
    <?php
}
?>
<main class="main-page <?php echo $class; ?>" role="main">
    <div class="page-title">
        <div class="container">
            <?php the_title('<h1 class="entry-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">', '</h1>'); ?>
        </div>
    </div><!-- page title -->

    <div class="cat-list">    
        <div class="container">  
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC'
            ));
            ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="pro-title">Product category</div>
                <ul class="pro-cat-list"> 
                    <?php
                    foreach ($categories as $category) {
                        if ($category->name == "Popular") {
                            // Popular
                        } else {
                            ?> 
                            <li> 
                                <a href="<?php echo get_term_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul> 

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <ul> 
                    <?php
                    foreach ($categories as $category) {
                        if ($category->name == "Popular") {
                            // Popular
                        } else {
                            ?> 
                            <li> 
                                <div class="cat-name"><a href="<?php echo get_term_link($category->term_id); ?>"><span><?php echo $category->name; ?> (<?php echo $category->count; ?>)</span></a></div>
                                <?php
                                // $cats = get_the_category();
                                $args = array(
                                    'post_type' => 'post',
                                    'cat' => $category->term_id,
                                    'posts_per_page' => 6
                                );
                                $query = new WP_Query($args);
                                $delayTime = 300;
                                ?>  
                                <div class="row">
                                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>   

                                            <div class="col-md-4 col-sm-6 col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="<?php echo $delayTime; ?>ms" >
                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="catBox">
                                                        <div class="thumbnail-img"><?php echo get_the_post_thumbnail($post_id, 'full'); ?></div>
                                                        <?php
                                                        $Title = get_the_title();
                                                        if (strlen($Title) > 50) {
                                                            echo '<h6>' . substr($Title, 0, 50) . '... </h6>';
                                                        } else {
                                                            echo '<h6>' . $Title . '</h6>';
                                                        }
                                                        ?>
                                                    </div>
                                                </a> 
                                            </div>
                                            <?php
                                            $delayTime += 100;
                                        endwhile;
                                        ?>
                                    </div>
                                    <?php
                                endif;
                                wp_reset_postdata();
                                ?> 
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul> 
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
