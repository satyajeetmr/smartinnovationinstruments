<?php
/*
 * Template Name: About Template
 */
get_header();
global $post;

$class = '';
if (!is_front_page()) {
    $class = 'about-page';
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
    <?php
    // Start the loop.
    while (have_posts()) : the_post();
        ?>
        <div class="page-title">
            <div class="container">
                <?php the_title('<h1 class="entry-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">', '</h1>'); ?>
            </div>
        </div><!-- page title -->

        <div class="aboutus">
            <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                <?php the_content(); ?>
            </div>
        </div>
        <?php
    // End of the loop.
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
