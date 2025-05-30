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
                        'question' => 'What types of brands do you work with?',
                        'answer' => 'We work with brands that are looking to grow strategically, creatively, and sustainably. Our sweet spot is partnering with businesses that understand marketing as a long-term investment—not just a short-term expense.'
                    ),
                    array(
                        'question' => 'What does your 360 marketing service include?',
                        'answer' => 'It includes strategy, digital ads, graphic design, audiovisual content, social media management, brand activations, and performance tracking. If needed, we also develop landing pages, apps, automations, and other tech tools.'
                    ),
                    array(
                        'question' => 'Do you offer fixed packages or custom services?',
                        'answer' => 'We personalize every proposal. We don\'t believe in one-size-fits-all formulas—your brand is unique, and your strategy should be too.'
                    ),
                    array(
                        'question' => 'How long does it take to see results?',
                        'answer' => 'It depends on the strategy. You\'ll usually start seeing visible results around months 2–3, but the strongest results are built from month 6 onward.'
                    ),
                    array(
                        'question' => 'How do I know if Duck Studios is the right agency for my brand?',
                        'answer' => 'If you\'re looking for a committed, creative, and strategic team that works as an extension of your business, we\'re probably the right fit. And if we\'re not, we\'ll be honest about that too 😉'
                    ),
                    array(
                        'question' => 'Can I meet with you before signing up?',
                        'answer' => 'Absolutely! You can schedule a free discovery call where we\'ll analyze your case and tell you if—and how—we can help.'
                    ),
                    array(
                        'question' => 'Can you help me with just one part of the process (like design, ads, or content)?',
                        'answer' => 'Yes. We offer standalone packages for specific services like audiovisual production, and we also provide custom quotes based on your goals and needs.'
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
