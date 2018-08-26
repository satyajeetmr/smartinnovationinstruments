<?php
/*
 * Template Name: Contact Template
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
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </div>
        </div><!-- page title -->

        <section id="contact-page">
            <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                <div class="form_wrap clearfix">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>

        <div class="contactInfo flex-cls align-items-center clearfix">            
            <div class="col-left col-6 wow fadeInDown clearfix" data-wow-duration="1000ms" data-wow-delay="300ms">
                <div class="addressDiv">
                    <?php echo get_field("address", 'option'); ?>
                </div>
            </div>
            <div class="col-right col-6 map wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                <?php echo get_field("address_map", 'option'); ?>
            </div>
        </div>



        <?php
    // End of the loop.
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
