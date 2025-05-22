<?php
/**
 * Template part for displaying the choose us section
 *
 * @package Duck_Studios
 */
?>

<section class="choose-us-section">
    <div class="choose-us-banner" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/choose-us-background.webp');">
        <div class="container">
            <div class="choose-us-content">
                <h2 class="choose-us-title"><?php echo esc_html(get_field('choose_us_title', 'option') ?: 'CHOOSE US DUCK STUDIOS'); ?></h2>
                <p class="choose-us-description">
                    <?php echo wp_kses_post(get_field('choose_us_description', 'option') ?: "We don't believe in shortcuts. We believe in building together, <strong>step by step</strong>, with strategy, data, real creativity, and hands deep in the work. We're not here to promise magic results - <strong>we're here to design them</strong>, test them, and perfect them with you."); ?>
                </p>
            </div>
        </div>
    </div>
    
    <!-- <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('success_stories_subtitle', 'option') ?: 'Success stories'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('success_stories_title', 'option') ?: 'Business stories that chose to build with us'); ?></h2>
            <span class="wavy-divider"></span>
        </div>
        
        <?php if (have_rows('success_stories_slider', 'option')) : ?>
        <div class="results-slider">
            <div class="slider-container">
                <div class="slider-track success-stories-track">
                    <?php while (have_rows('success_stories_slider', 'option')) : the_row(); 
                        $image = get_sub_field('image');
                        $title = get_sub_field('title');
                        if ($image) :
                    ?>
                    <div class="slider-item">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="success-story-image">
                        <?php if ($title) : ?>
                        <div class="success-story-title"><?php echo esc_html($title); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; endwhile; ?>
                </div>
            </div>
            <div class="slider-nav slider-prev success-prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="slider-nav slider-next success-next"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
        <?php else : ?>
        <div class="results-slider">
            <div class="slider-container">
                <div class="slider-track success-stories-track">
                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                    <div class="slider-item">
                        <div class="success-story-placeholder">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>Success Story <?php echo $i; ?></span>
                        </div>
                        <div class="success-story-title">Client <?php echo $i; ?></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="slider-nav slider-prev success-prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="slider-nav slider-next success-next"><i class="fa-solid fa-chevron-right"></i></div>
        </div>
        <?php endif; ?>
    </div> -->
</section>
