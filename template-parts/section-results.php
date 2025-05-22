<?php
/**
 * Template part for displaying the results section
 *
 * @package Duck_Studios
 */
?>

<section id="portfolio" class="results-section">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('results_subtitle', 'option') ?: 'Our results'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('results_title', 'option') ?: 'Impact you can measure, growth you can feel'); ?></h2>
            <span class="wavy-divider"></span>
        </div>
        
        <div class="results-showcase">
            <div class="results-carousel">
                <button class="carousel-nav prev"><span class="dashicons dashicons-arrow-left-alt2"></span></button>
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result5.webp" alt="Results showcase">
                        </div>
                        
                        <div class="carousel-item active">
                            <div class="result-stats-card">
                                <div class="stats-header">
                                    <div class="stat-block blue">
                                        <span class="stat-label">Clicks</span>
                                        <span class="stat-value">2.41K</span>
                                    </div>
                                    <div class="stat-block red">
                                        <span class="stat-label">Impressions</span>
                                        <span class="stat-value">38.5K</span>
                                    </div>
                                    <div class="stat-block yellow">
                                        <span class="stat-label">Avg. CPC</span>
                                        <span class="stat-value">$0.03</span>
                                    </div>
                                </div>
                                <div class="stats-graph">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result6.webp" alt="Performance chart">
                                </div>
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result7.webp" alt="Results showcase">
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next"><span class="dashicons dashicons-arrow-right-alt2"></span></button>
            </div>
            
            <div class="metrics-grid">
                <div class="metric-item">
                    <div class="metric-label">Investment</div>
                    <div class="metric-value">-60%</div>
                </div>
                <div class="metric-item">
                    <div class="metric-label">Reach</div>
                    <div class="metric-value">+447.2K</div>
                </div>
                <div class="metric-item">
                    <div class="metric-label">Recognition</div>
                    <div class="metric-value">+100%</div>
                </div>
                <div class="metric-item">
                    <div class="metric-label">CPC</div>
                    <div class="metric-value">$0.5</div>
                </div>
                <div class="metric-item">
                    <div class="metric-label">Closing sales</div>
                    <div class="metric-value">+100%</div>
                </div>
                <div class="metric-item">
                    <div class="metric-label">Brand loyalty</div>
                    <div class="metric-value">+100%</div>
                </div>
            </div>
            
            <div class="results-carousel">
                <button class="carousel-nav prev"><span class="dashicons dashicons-arrow-left-alt2"></span></button>
                <div class="carousel-container">
                    <div class="carousel-slide">
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result1.webp" alt="Results showcase">
                        </div>
                        
                        <div class="carousel-item active">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result3.webp" alt="Results showcase">
                        </div>
                        
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/result4.webp" alt="Results showcase">
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next"><span class="dashicons dashicons-arrow-right-alt2"></span></button>
            </div>
        </div>
    </div>
        <div class="container">
            <?php
            // Get case studies
            $case_studies = get_posts(array(
                'post_type' => 'case_study',
                'numberposts' => 3,
            ));
            
            if (!empty($case_studies)) :
            ?>
            <div class="case-study-grid">
                <?php foreach ($case_studies as $case_study) : 
                    $metrics = get_field('metrics', $case_study->ID);
                ?>
                <div class="case-study-card">
                    <h3 class="case-study-title"><?php echo esc_html($case_study->post_title); ?></h3>
                    <?php if ($metrics) : ?>
                    <div class="case-study-metrics">
                        <?php foreach ($metrics as $metric) : ?>
                        <div class="case-study-metric">
                            <div class="metric-value"><?php echo esc_html($metric['value']); ?></div>
                            <div class="metric-label"><?php echo esc_html($metric['label']); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="case-study-content">
                        <?php echo wp_kses_post(get_the_excerpt($case_study->ID)); ?>
                    </div>
                    <a href="<?php echo esc_url(get_permalink($case_study->ID)); ?>" class="btn btn-outline">View Case Study</a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <div class="case-study-grid">
                <div class="case-study-card">
                    <div class="case-study-content">
                        <div class="giant-number">2410</div>
                        <p class="large-text">clicks generated with a total investment of <strong>$65.94</strong></p>
                    </div>
                </div>
                <div class="case-study-card">
                    <div class="case-study-content">
                        <p class="large-text">which represents an average cost per click of only <strong>$0.03</strong>.</p>
                    </div>
                </div>
                <div class="case-study-card">
                    <div class="case-study-content">
                        <p class="large-text">Our focus is on continuously optimizing to achieve the greatest impact at the lowest possible cost.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>