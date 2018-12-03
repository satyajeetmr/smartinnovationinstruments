<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage smartinnovation
 * @since Twenty Sixteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon-icon.png" type="image/favicon-icon.icon" />
        <link rel="profile" href="http://gmpg.org/xfn/11">      
        
            <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TFDT6T8');</script>
    <!-- End Google Tag Manager -->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
<!--        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129344065-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-129344065-1');
        </script>-->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-129344065-1', 'auto');
          ga('send', 'pageview');
        </script>
        <meta name="google-site-verification" content="2mDH5Ngfvt_0M514MuYTwufXecXh92S_ah7T-FC52w8" />
    </head>

    <body <?php body_class(); ?>>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFDT6T8"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div id="page">
            <header>		
                <nav id="Mobile_menu">
                    <a href="#" class="close_m_menu">X</a>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => '',
                        'container_id' => 'HeaderNav',
                        'container_class' => 'mobile-nav',
                        'menu_class' => 'nav',
                        'menu_id' => 'HeaderNav'
                    ));
                    ?>
                </nav>
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="navigation">
                        <div class="container">					
                            <div class="navbar-header">
                                <div class="navbar-brand">
                                    <a href="<?php echo site_url(); ?>"><img src="<?php echo bloginfo('template_directory') ?>/images/smartinnovationinstruments-logo-1.png" alt="" /></a>
                                    <div class="open_m_menu"><a href="#Mobile_menu"><span class="s_icon"></span></a></div>
                                </div>
                            </div>

                            <div class="navbar-collapse collapse">							
                                <div class="menu">
                                    <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'container' => '',
                                        'container_id' => 'HeaderNav',
                                        'container_class' => 'nav-wrap',
                                        'menu_class' => 'nav nav-tabs',
                                        'menu_id' => 'HeaderNav'
                                    ));
                                    ?>
                                </div>
                            </div>						
                        </div>
                    </div>	
                </nav>		
            </header>
            <!-- page wrapper -->
            <div class="page-wrapper">
