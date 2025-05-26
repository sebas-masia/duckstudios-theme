<?php
/**
 * Template part for displaying the testimonials section
 *
 * @package Duck_Studios
 */
?>

<section id="about" class="testimonials-section">
    <div class="site-background">
        <div class="gradient-blob blob-blue"></div>
    </div>
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('testimonials_subtitle', 'option') ?: 'Why us?'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('testimonials_title', 'option') ?: 'We work with you and think like you'); ?></h2>
            <span class="wavy-divider"></span>
        </div>
        
        <div class="testimonials-device">
            <div class="device-header">
                <h3 class="device-title">Comments</h3>
                <div class="device-dots">
                    <span class="device-dot"></span>
                    <span class="device-dot"></span>
                    <span class="device-dot"></span>
                </div>
            </div>
            
            <?php
            // Get testimonials
            $testimonials = get_posts(array(
                'post_type' => 'testimonial',
                'numberposts' => 3,
            ));
            
            if (!empty($testimonials)) :
                foreach ($testimonials as $testimonial) :
                    $client_name = get_field('client_name', $testimonial->ID);
                    $client_company = get_field('client_company', $testimonial->ID);
            ?>
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <?php if (has_post_thumbnail($testimonial->ID)) : ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($testimonial->ID, 'thumbnail')); ?>" alt="<?php echo esc_attr($client_name); ?>" class="testimonial-avatar">
                    <?php else : ?>
                    <div class="testimonial-avatar-placeholder">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <?php endif; ?>
                    
                    <div class="testimonial-author">
                        <div class="testimonial-name"><?php echo esc_html($client_name); ?></div>
                        <?php if ($client_company) : ?>
                        <div class="testimonial-company"><?php echo esc_html($client_company); ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="testimonial-heart"><i class="fa-solid fa-heart"></i></div>
                </div>
                
                <div class="testimonial-content">
                    <?php echo wp_kses_post(get_the_content(null, false, $testimonial->ID)); ?>
                </div>
            </div>
            <?php
                endforeach;
            else :
                // Fallback if no testimonials are set up yet
            ?>
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar-placeholder" style="background-color: #e77fbf;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-name">umlfemcr</div>
                    </div>
                    <div class="testimonial-heart"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="testimonial-content">
                    Duck Studios has been one of the best experiences we've ever had! Always attentive and professional! We're grateful to their entire team, who in one way or another have helped move us into where we are today. We've managed to increase our sales by over 800% in a very short time!
                </div>
            </div>
            
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar-placeholder" style="background-color: #5d9cec;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-name">funinaboxcr</div>
                    </div>
                    <div class="testimonial-heart"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="testimonial-content">
                    Duck Studios guidance has been top-notch, super interesting! They've helped us improve our brand, optimize our controls and elevate them to a whole new level. We're very pleased with the action plan and strategies for our development. We highly recommend them, especially for the structure they work with makes communication and the development of initiatives much more efficient.
                </div>
            </div>
            
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar-placeholder" style="background-color: #4fc1e9;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-name">antonioprada</div>
                    </div>
                    <div class="testimonial-heart"><i class="fa-solid fa-heart"></i></div>
                </div>
                <div class="testimonial-content">
                    El Grupo Prada have been working with Duck Studios since the beginning of the year, and it's been a flawless experience. The organization, structure, follow-up on every detail - everything has been excellent. I believe they're a perfect match with DUCK! We are currently have three of our companies working with them, and the results have been amazing. Highly recommended!
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (get_field('testimonials_button_text', 'option')) : ?>
            <a href="https://www.instagram.com/p/C7VIzCMRQGO/?igsh=dDR2ZTQ5NWs0c2hx" class="view-more-btn btn btn-outline" target="_blank" rel="noopener noreferrer">
                <?php echo esc_html(get_field('testimonials_button_text', 'option')); ?>
            </a>
            <?php else : ?>
            <div class="text-center">
                <a href="https://www.instagram.com/p/C7VIzCMRQGO/?igsh=dDR2ZTQ5NWs0c2hx" class="view-more-btn btn btn-outline" target="_blank" rel="noopener noreferrer">Click Here</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="gradient-bg gradient-1"></div>
</section>
