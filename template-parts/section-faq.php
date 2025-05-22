<?php
/**
 * Template part for displaying the FAQ section
 *
 * @package Duck_Studios
 */
?>

<section class="faq-section">
    <div class="site-background">
        <div class="gradient-blob blob-blue"></div>
    </div>
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle"><?php echo esc_html(get_field('faq_subtitle', 'option') ?: 'FAQ'); ?></div>
            <h2 class="section-title"><?php echo esc_html(get_field('faq_title', 'option') ?: 'What no one tells you about growing your brand'); ?></h2>
            <span class="wavy-divider"></span>
        </div>
        
        <div class="faq-list">
            <?php if (have_rows('faq_items', 'option')) : 
                $counter = 0;
                while (have_rows('faq_items', 'option')) : the_row(); 
                    $question = get_sub_field('question');
                    $answer = get_sub_field('answer');
                    $counter++;
            ?>
            <div class="faq-item<?php echo ($counter === 1) ? ' active' : ''; ?>">
                <div class="faq-question">
                    <h3><?php echo esc_html($question); ?></h3>
                    <div class="faq-toggle"><i class="fa-solid fa-plus"></i></div>
                </div>
                <div class="faq-answer"<?php echo ($counter === 1) ? ' style="display: block;"' : ''; ?>>
                    <p><?php echo wp_kses_post($answer); ?></p>
                </div>
            </div>
            <?php endwhile;
            else : 
                // Fallback FAQs if none are set up yet
                $fallback_faqs = array(
                    array(
                        'question' => 'How long does it typically take to see results?',
                        'answer' => 'While every project is different, we typically start seeing measurable results within 30-60 days. Our approach focuses on sustainable growth rather than quick fixes, so the most significant results often come after 3-6 months of consistent strategy implementation.'
                    ),
                    array(
                        'question' => 'What makes Duck Studios different from other agencies?',
                        'answer' => 'We integrate directly with your team, working as partners rather than external vendors. Our approach combines data-driven strategy with creative execution, and we focus on measurable results rather than vanity metrics.'
                    ),
                    array(
                        'question' => 'Do you offer ongoing support after project completion?',
                        'answer' => 'Absolutely! We believe in building long-term relationships with our clients. We offer various support packages to ensure your digital assets continue to perform optimally and evolve with your business needs.'
                    ),
                    array(
                        'question' => 'How do you measure success for your projects?',
                        'answer' => 'We establish clear KPIs at the beginning of each project based on your business objectives. These might include conversion rates, cost per acquisition, engagement metrics, or revenue growth. We provide regular reports tracking these metrics.'
                    ),
                    array(
                        'question' => 'What industries do you specialize in?',
                        'answer' => 'While we have experience across many sectors, we have particular expertise in e-commerce, SaaS, professional services, and consumer products. Our diverse team brings insights from various industries to create innovative solutions.'
                    ),
                );
                
                foreach ($fallback_faqs as $index => $faq) :
            ?>
            <div class="faq-item<?php echo ($index === 0) ? ' active' : ''; ?>">
                <div class="faq-question">
                    <h3><?php echo esc_html($faq['question']); ?></h3>
                    <div class="faq-toggle"><i class="fa-solid <?php echo ($index === 0) ? 'fa-minus' : 'fa-plus'; ?>"></i></div>
                </div>
                <div class="faq-answer"<?php echo ($index === 0) ? ' style="display: block;"' : ''; ?>>
                    <p><?php echo wp_kses_post($faq['answer']); ?></p>
                </div>
            </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
    
    <div class="gradient-bg gradient-2"></div>
</section>
