<?php
/*
 * Template Name: Client Template
 */
get_header();
global $post;

$class = '';
if (!is_front_page()) {
    $class = 'client-page';
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


        <section id="client">
            <div class="container">
                <div class="cleint-list clearfix">
                    <div class="flex-cls">
                        <?php
                        $time = 200;
                        // check if the repeater field has rows of data
                        if (have_rows('client-repeater')):
                            // loop through the rows of data
                            while (have_rows('client-repeater')) : the_row();
                                ?>
                                <div class="col-3 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="<?php echo $time; ?>ms">
                                    <div class="LogoImg flex-cls align-items-center"><img class="img-responsive" src="<?php echo the_sub_field('logo-img', $post->ID); ?>"></div>
                                    <!--<div class="CName"><?php echo the_sub_field('client-name', $post->ID); ?></div>-->
                                </div>                        
                                <?php
                                $time = $time + 100;
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>        
            </div><!--/.container-->
        </section><!--/#client-->
        <?php
    // End of the loop.
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
