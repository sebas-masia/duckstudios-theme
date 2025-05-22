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
