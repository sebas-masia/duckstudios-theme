<?php
/**
 * Template part for displaying the services section
 *
 * @package Duck_Studios
 */
?>

<section id="services" class="services-section">
    <div class="site-background">
        <div class="gradient-blob blob-yellow"></div>
    </div>
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('services_subtitle', 'option') ?: 'Our 360 services'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('services_title', 'option') ?: 'Integrated Strategies, Real Execution'); ?></h2>
            <p class="section-description"><?php echo esc_html(get_field('services_description', 'option') ?: 'Every stage of your brand journey, worked step by step to maximize results'); ?></p>
            <span class="wavy-divider"></span>
        </div>
        
        <div class="services-grid">
            <?php
            // Get service categories
            $service_categories = get_terms(array(
                'taxonomy' => 'service_category',
                'hide_empty' => false,
            ));
            
            if (!empty($service_categories) && !is_wp_error($service_categories)) :
                foreach ($service_categories as $category) :
                    // Get services in this category
                    $services = get_posts(array(
                        'post_type' => 'service',
                        'numberposts' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'service_category',
                                'field' => 'term_id',
                                'terms' => $category->term_id,
                            ),
                        ),
                    ));
            ?>
            <div class="service-card">
                <h3 class="service-title"><?php echo esc_html($category->name); ?></h3>
                <?php if (!empty($services)) : ?>
                <ul class="service-list">
                    <?php foreach ($services as $service) : ?>
                    <li><?php echo esc_html($service->post_title); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php
                endforeach;
            else :
                // Fallback if no service categories are set up yet
            ?>
            <div class="service-card">
                <h3 class="service-title">Creative</h3>
                <ul class="service-list">
                    <li>Branding/Logo Design</li>
                    <li>UI/UX Design</li>
                    <li>Video and photo creation</li>
                    <li>Graphic design formats</li>
                </ul>
            </div>
            <div class="service-card">
                <h3 class="service-title">Marketing & Advertising</h3>
                <ul class="service-list">
                    <li>Google Ads/Meta Ads</li>
                    <li>Email Marketing</li>
                    <li>Online/Offline Marketing Strategy</li>
                    <li>SEO</li>
                    <li>Social Media Management</li>
                    <li>Copywriting</li>
                    <li>Content Creation</li>
                </ul>
            </div>
            <div class="service-card">
                <h3 class="service-title">Development</h3>
                <ul class="service-list">
                    <li>Website/Software</li>
                    <li>CRM and Portal set up</li>
                    <li>Optimization and Automation processes</li>
                    <li>API Integration (JSON)</li>
                    <li>Chatbots</li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
