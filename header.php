<?php
/**
 * The header for our theme
 *
 * @package Duck_Studios
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6LW76DLFVS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6LW76DLFVS');
    </script>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2216752165444612');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2216752165444612&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'duck-studios'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                    ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="custom-logo">
                        </a>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <nav id="site-navigation" class="main-navigation">
                    <?php
                    // Check if a menu exists in the primary location
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'fallback_cb'    => false,
                            )
                        );
                    } else {
                        // Fallback menu if no menu is assigned
                        ?>
                        <ul id="primary-menu" class="menu">
                            <li class="menu-item"><a href="#about">About us</a></li>
                            <li class="menu-item"><a href="#team">Our team</a></li>
                            <li class="menu-item"><a href="#services">Services</a></li>
                            <li class="menu-item"><a href="#portfolio">Portfolio</a></li>
                            <li class="menu-item"><a href="#contact" class="contact-btn">Contact Us</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </header><!-- #masthead -->
