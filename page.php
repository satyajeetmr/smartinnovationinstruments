<?php
/**
 * The template for displaying pages
 */
get_header();
global $post;
?>
<?php
$class = '';
if (!is_front_page()) {
    $class = 'inner_page';
}

if(get_field('page_title_background_image')){
	$pagetitle_bg = get_field('page_title_background_image');
}else if (get_field('page_title_background_image','option')){
	$pagetitle_bg = get_field('page_title_background_image','option');
}

if($pagetitle_bg){
?>
<style>
.page_title {
    background-image: url(<?php echo $pagetitle_bg;?>);
}
</style>
<?php
}
?>
<main class="main_page <?php echo $class; ?>" id="main_page">
    <?php
    // Start the loop.
    while (have_posts()) : the_post();
        ?>

        <div class="page_title">
            <div class="container">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </div>
        </div><!-- page title -->

        <div class="container"> 
            <?php
            // Start the loop.
            //  while (have_posts()) : the_post();
            // Include the page content template.
            get_template_part('template-parts/content', 'page');
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'smartinnovation') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'smartinnovation') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            ));
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?> 

        </div> 
        <?php
    // End of the loop.
    endwhile;
    ?>

</main>
<?php get_footer(); ?>
