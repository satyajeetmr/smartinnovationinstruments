<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header();
global $post;

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
<main class="main-page blog-single" role="main">
    <div class="page-title">
        <div class="container">
            <?php
            $category = get_the_category();
            $firstCategory = $category[0]->cat_name;
            ?> 
            <h2 class="entry-title"> <?php echo $firstCategory; ?> </h2>
        </div>
    </div><!-- page title -->

    <div class="container">

        <?php
        // Start the loop.
        while (have_posts()) : the_post();
            ?>

            <?php get_the_category(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h4>', '</h4>'); ?>
                </header><!-- .entry-header -->

                <div class="content clearfix">
                    <div class="thumbnail"><?php the_post_thumbnail(); ?></div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->
                </div>
                <?php
                edit_post_link(
                        sprintf(
                                /* translators: %s: Name of current post */
                                __('Edit<span class="screen-reader-text"> "%s"</span>', 'smartinnovation'), get_the_title()
                        ), '<span class="edit-link">', '</span>'
                );
                ?>
                </footer> <!-- entry-footer -->
            </article><!-- #post-## -->
            <?php
        // End of the loop.
        endwhile;
        ?>
    </div>
</main><!-- .site-main -->

<?php get_footer(); ?>
