<?php
/**
 * A Simple Category Template
 */
get_header();

if (get_field('page_title_background_image', 'option')) {
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

    <?php
// Check if there are any posts to display
    if (have_posts()) :
        ?>
        <div class="page-title">
            <div class="container">
                <h1 class="entry-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><?php single_cat_title('', true); ?></h1>
            </div>
        </div><!-- page title -->

        <div class="cat-list">    
            <div class="container">    
                <ul> 
                    <li>
                        <div class="row">
                            <?php
                            $delayTime = 300;
// The Loop
                            while (have_posts()) : the_post();
                                ?>
                                <div class="col-md-3 col-sm-6 col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="<?php echo $delayTime; ?>ms" >
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
                    </li>
                </ul>
            </div>
        </div>
        <?php
    else:
        ?>
        <div class="cat-list">    
            <div class="container">
                <p>Sorry, no posts matched your criteria.</p>
            </div>
        </div>


    <?php endif; ?>
</main>

<?php get_footer(); ?>