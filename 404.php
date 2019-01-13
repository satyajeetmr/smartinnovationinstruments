<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header();

global $post;

$class = '';
if (!is_front_page()) {
    $class = '404-page';
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
            <h1 class="entry-title">404 pages not found</h1>
        </div>
    </div><!-- page title -->

    <section id="contact-page">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="error-404 clearfix">
                Oops! That page can't be found.<br /><br />
                <a href="<?php echo site_url(); ?>">Go To Home Page</a>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
