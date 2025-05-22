<?php
/**
 * The main template file
 *
 * @package Duck_Studios
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (is_front_page()) {
        // Include front page sections
        get_template_part('template-parts/section', 'hero');
        get_template_part('template-parts/section', 'services');
        get_template_part('template-parts/section', 'results');
        get_template_part('template-parts/section', 'case-studies');
        get_template_part('template-parts/section', 'testimonials');
        get_template_part('template-parts/section', 'choose-us');
        get_template_part('template-parts/section', 'methodology');
        get_template_part('template-parts/section', 'faq');
        get_template_part('template-parts/section', 'contact');
    } else {
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;

            the_posts_navigation();
        else :
            get_template_part('template-parts/content', 'none');
        endif;
    }
    ?>
</main><!-- #primary -->

<?php
get_footer();
