<?php
/**
 * Template part for displaying the methodology section
 *
 * @package Duck_Studios
 */
?>

<section id="team" class="methodology-section">
    <div class="site-background">
        <div class="gradient-blob blob-yellow"></div>
    </div>
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('methodology_subtitle', 'option') ?: 'Our methodology'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('methodology_title', 'option') ?: "We don't guess: we build, measure, and evolve"); ?></h2>
            <span class="wavy-divider"></span>
        </div>
        
        <div class="methodology-grid">
            <?php if (have_rows('methodology_items', 'option')) : 
                while (have_rows('methodology_items', 'option')) : the_row(); 
                    $icon = get_sub_field('icon');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
            ?>
            <div class="methodology-card">
                <?php if ($icon) : ?>
                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="methodology-icon">
                <?php endif; ?>
                <h3 class="methodology-title"><?php echo esc_html($title); ?></h3>
                <p class="methodology-description"><?php echo esc_html($description); ?></p>
            </div>
            <?php endwhile;
            else : ?>
            <div class="methodology-card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/telegram.webp" alt="Telegram" class="methodology-icon">
                <h3 class="methodology-title">Telegram</h3>
                <p class="methodology-description">We use it for constant communication with all the team. It's flexible, efficient, and communication are crucial for success.</p>
            </div>
            <div class="methodology-card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/notion.webp" alt="Notion" class="methodology-icon">
                <h3 class="methodology-title">Notion Client Portal</h3>
                <p class="methodology-description">Keep track of the work with your own Client Portal. Organized to document, track all the progress, payments, and requests.</p>
            </div>
            <div class="methodology-card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/drive.webp" alt="Google Drive" class="methodology-icon">
                <h3 class="methodology-title">Google Drive</h3>
                <p class="methodology-description">The final work is yours. Store all the approved work in your individual and shared folders.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
