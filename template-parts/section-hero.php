<?php
/**
 * Template part for displaying the hero section
 *
 * @package Duck_Studios
 */
?>

<section class="hero-section">
    <div class="site-background">
        <div class="gradient-blob blob-blue"></div>
        <div class="gradient-blob blob-yellow"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-tagline">
                <span><?php echo esc_html(get_field('hero_tagline_1', 'option') ?: 'Technology'); ?></span>
                <span>+</span>
                <span><?php echo esc_html(get_field('hero_tagline_2', 'option') ?: 'Creativity'); ?></span>
                <span>+</span>
                <span><?php echo esc_html(get_field('hero_tagline_3', 'option') ?: 'Strategy'); ?></span>
            </div>
            
            <h1 class="hero-title">
                <?php echo esc_html(get_field('hero_title_part_1', 'option') ?: 'We Build'); ?> 
                <span class="text-yellow"><?php echo esc_html(get_field('hero_title_part_2', 'option') ?: 'Results,'); ?></span><br>
                <?php echo esc_html(get_field('hero_title_part_3', 'option') ?: 'Not Illusions'); ?>
            </h1>
            
            <p class="hero-description">
                <?php echo esc_html(get_field('hero_description', 'option') ?: 'We integrate into your team, work alongside you, and turn strategy into real outcomes.'); ?>
            </p>
            
            <?php if (get_field('hero_button_text', 'option')) : ?>
            <a href="<?php echo esc_url(get_field('hero_button_link', 'option') ?: '#contact'); ?>" class="btn btn-primary">
                <?php echo esc_html(get_field('hero_button_text', 'option') ?: 'Book consultation'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="gradient-bg gradient-1"></div>
    <div class="gradient-bg gradient-2"></div>
</section>

<div class="client-logos-section">
    <div class="logos-ticker-wrap">
        <div class="logos-ticker">
            <!-- First set of logos -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client1.webp" alt="Client 1" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client2.webp" alt="Client 2" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client3.webp" alt="Client 3" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client4.webp" alt="Client 4" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client5.webp" alt="Client 5" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client6.webp" alt="Client 6" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client7.webp" alt="Client 7" class="client-logo">
            
            <!-- Duplicated set for continuous loop -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client1.webp" alt="Client 1" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client2.webp" alt="Client 2" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client3.webp" alt="Client 3" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client4.webp" alt="Client 4" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client5.webp" alt="Client 5" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client6.webp" alt="Client 6" class="client-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client7.webp" alt="Client 7" class="client-logo">
        </div>
    </div>
</div>
