<?php
/*
 * Template Name: Home Template
 */
get_header();
global $post;

$class = '';
if (!is_front_page()) {
    $class = 'home-page';
}
?>

<main class="main-page <?php echo $class; ?>" role="main">
    <section id="main-slider" class="no-margin">
        <div id="carousel-slider" class="carousel slide" data-ride="carousel"> 
            <div class="carousel-inner">
                <?php
                $i = 1;
                // check if the repeater field has rows of data
                if (have_rows('home_slider')):
                    // loop through the rows of data
                    while (have_rows('home_slider')) : the_row();
                        ?>
                <div class="item <?php if ($i == 1): { ?> active <?php } endif; ?>" style="background-image: url('<?php echo the_sub_field('slide_img'); ?>')"><img src="<?php echo the_sub_field('slide_img'); ?>" alt="" /></div><!--/.item-->     
                        <?php
                        $i++;
                    endwhile;
                endif;
                ?>
            </div><!--/.carousel-inner-->

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                $j = 0;
                // check if the repeater field has rows of data
                if (have_rows('home_slider')):
                    // loop through the rows of data
                    while (have_rows('home_slider')) : the_row();
                        ?>
                        <li data-target="#carousel-slider" data-slide-to="<?php echo $j; ?>" class="<?php if ($j == 0): { ?> active <?php } endif; ?>"></li>
                        <?php
                        $j++;
                    endwhile;


                endif;
                ?>
            </ol>
        </div><!--/.carousel-->
    </section><!--/#main-slider-->

    <div class="feature">
        <div class="container">
            <div class="row text-center">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 4,
                    'category_name' => 'popular'
                );
                $query = new WP_Query($args);
                $delayTime = 300;
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                        ?>   
                        <div class="col-md-3 col-sm-6 col-sm-12">
                            <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="<?php echo $delayTime; ?>ms" >
                                <div class="thumbnail-img"><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post_id, 'full'); ?></a></div>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $Title = get_the_title();
                                    if (strlen($Title) > 40) {
                                        echo '<h5>' . substr($Title, 0, 40) . '... </h5>';
                                    } else {
                                        echo '<h5>' . $Title . '</h5>';
                                    }
                                    ?>
                                </a>
                                <div class="excerpt_text">
                                    <?php
                                    $content = get_the_excerpt();
                                    $trimmed_content = wp_trim_words($content, 20);
                                    echo apply_filters('the_content', $trimmed_content);
                                    ?>
                                </div>
                                <p><a class="btn-default" href="<?php the_permalink(); ?>">Read More</a></p>
                            </div>
                        </div>
                        <?php
                        $delayTime += 100;
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
                    <h2><?php echo get_field("welcome_title", $post->ID); ?></h2>
                </div>
                <div class="col-md-12 fadeInDown clearfix" data-wow-duration="1000ms" data-wow-delay="300ms" >
                    <?php echo get_field("welcome_text", $post->ID); ?>
                </div>                
            </div>
        </div>
    </div>

    <section id="partner" style="background-image: url('<?php echo get_field("partners_bg", $post->ID); ?>'); background-size: cover; background-position: 50% 50%;">
        <div class="container">
            <div class="center wow fadeInDown">
                <?php echo get_field("partners_text", $post->ID); ?>
            </div>    

            <div class="partners clearfix">

                <ul class="clearfix">
                    <?php
                    $time = 300;
                    // check if the repeater field has rows of data
                    if (have_rows('partners_slider')):
                        // loop through the rows of data
                        while (have_rows('partners_slider')) : the_row();
                            ?>
                            <li> <a href="<?php echo the_sub_field('link', $post->ID); ?>"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="<?php echo $time; ?>ms" src="<?php echo the_sub_field('logo_image', $post->ID); ?>"></a></li>                        
                            <?php
                            $time = $time + 300;
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 ">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="form_wrap clearfix"><?php echo get_field("enquiry_form", $post->ID); ?></div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-xs-12 ">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <?php echo get_field("address", 'option'); ?>
                        <?php echo get_field("address_map", 'option'); ?>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->
</main>
<?php get_footer(); ?>
