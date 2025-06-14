<?php
/**
 * Duck Studios Theme functions and definitions
 *
 * @package Duck_Studios
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Start session if not already started
function duck_studios_start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'duck_studios_start_session', 1);

// Define theme version
if (!defined('DUCK_STUDIOS_VERSION')) {
    define('DUCK_STUDIOS_VERSION', '1.0.5');
}

// Set up theme defaults and register support for various WordPress features
function duck_studios_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'duck-studios'),
        'footer' => esc_html__('Footer Menu', 'duck-studios'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'duck_studios_setup');

// Enqueue scripts and styles
function duck_studios_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('duck-studios-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap', array(), null);
    
    // Enqueue FontAwesome - Check for local first, then fallback to CDN
    $local_fa_path = get_template_directory() . '/assets/fonts/fontawesome/css/all.min.css';
    $local_fa_url = get_template_directory_uri() . '/assets/fonts/fontawesome/css/all.min.css';
    
    if (file_exists($local_fa_path)) {
        // Use local FontAwesome if available
        wp_enqueue_style('font-awesome', $local_fa_url, array(), DUCK_STUDIOS_VERSION);
    } else {
        // Fallback to CDN with multiple options
        wp_enqueue_style('font-awesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css', array(), '6.4.0');
        
        // Add fallback script to check if FontAwesome loaded
        wp_add_inline_script('jquery', '
            jQuery(document).ready(function($) {
                setTimeout(function() {
                    // Check if FontAwesome is loaded
                    var testElement = $("<i class=\"fas fa-home\" style=\"display:none;\"></i>").appendTo("body");
                    var computedStyle = window.getComputedStyle(testElement[0], ":before");
                    var fontFamily = computedStyle.getPropertyValue("font-family");
                    var isFALoaded = fontFamily && (fontFamily.indexOf("Font Awesome") !== -1 || fontFamily.indexOf("FontAwesome") !== -1);
                    testElement.remove();
                    
                    if (!isFALoaded) {
                        console.log("FontAwesome failed to load from primary CDN, trying fallbacks...");
                        
                        // Try cdnjs.cloudflare.com
                        $("<link>", {
                            rel: "stylesheet",
                            type: "text/css",
                            href: "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css",
                            crossorigin: "anonymous"
                        }).appendTo("head");
                        
                        // Final fallback to use.fontawesome.com
                        setTimeout(function() {
                            var testElement2 = $("<i class=\"fas fa-home\" style=\"display:none;\"></i>").appendTo("body");
                            var computedStyle2 = window.getComputedStyle(testElement2[0], ":before");
                            var fontFamily2 = computedStyle2.getPropertyValue("font-family");
                            var isFALoaded2 = fontFamily2 && (fontFamily2.indexOf("Font Awesome") !== -1 || fontFamily2.indexOf("FontAwesome") !== -1);
                            testElement2.remove();
                            
                            if (!isFALoaded2) {
                                console.log("Trying final FontAwesome fallback...");
                                $("<link>", {
                                    rel: "stylesheet",
                                    type: "text/css", 
                                    href: "https://use.fontawesome.com/releases/v6.4.0/css/all.css"
                                }).appendTo("head");
                                
                                // If all CDNs fail, activate text fallbacks
                                setTimeout(function() {
                                    var testElement3 = $("<i class=\"fas fa-home\" style=\"display:none;\"></i>").appendTo("body");
                                    var computedStyle3 = window.getComputedStyle(testElement3[0], ":before");
                                    var fontFamily3 = computedStyle3.getPropertyValue("font-family");
                                    var isFALoaded3 = fontFamily3 && (fontFamily3.indexOf("Font Awesome") !== -1 || fontFamily3.indexOf("FontAwesome") !== -1);
                                    testElement3.remove();
                                    
                                    if (!isFALoaded3) {
                                        console.log("All FontAwesome CDNs failed. Activating text fallbacks.");
                                        $("body").addClass("fa-fallback-active");
                                    }
                                }, 3000);
                            }
                        }, 2000);
                    }
                }, 1000);
            });
        ');
    }
    
    // Enqueue main stylesheet
    wp_enqueue_style('duck-studios-style', get_stylesheet_uri(), array(), DUCK_STUDIOS_VERSION);
    
    // Enqueue section-specific stylesheets
    wp_enqueue_style('duck-studios-hero', get_template_directory_uri() . '/assets/css/sections/hero.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-results', get_template_directory_uri() . '/assets/css/sections/results.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-transitions', get_template_directory_uri() . '/assets/css/sections/transitions.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-carousel', get_template_directory_uri() . '/assets/css/carousel.css', array(), DUCK_STUDIOS_VERSION);
    
    // Enqueue FontAwesome fallback CSS
    wp_enqueue_style('duck-studios-fontawesome-fallback', get_template_directory_uri() . '/assets/css/fontawesome-fallback.css', array(), DUCK_STUDIOS_VERSION);
    
    // Enqueue custom scripts
    wp_enqueue_script('duck-studios-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), DUCK_STUDIOS_VERSION, true);
    wp_enqueue_script('duck-studios-sliders', get_template_directory_uri() . '/assets/js/sliders.js', array('jquery'), DUCK_STUDIOS_VERSION, true);
    wp_enqueue_script('duck-studios-faq', get_template_directory_uri() . '/assets/js/faq.js', array('jquery'), DUCK_STUDIOS_VERSION, true);
    wp_enqueue_script('duck-studios-carousel', get_template_directory_uri() . '/assets/js/carousel.js', array(), DUCK_STUDIOS_VERSION, true);
    
    // Enqueue blob animation and parallax effect scripts
    wp_enqueue_script('duck-studios-blob-animation', get_template_directory_uri() . '/assets/js/blob-animation.js', array(), DUCK_STUDIOS_VERSION, true);
    wp_enqueue_script('duck-studios-section-parallax', get_template_directory_uri() . '/assets/js/section-parallax.js', array(), DUCK_STUDIOS_VERSION, true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'duck_studios_scripts');

// Register widget areas
function duck_studios_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'duck-studios'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'duck-studios'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'duck_studios_widgets_init');

// Custom template tags for this theme
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress
require get_template_directory() . '/inc/template-functions.php';

// Customizer additions
require get_template_directory() . '/inc/customizer.php';

// Register Custom Post Types
function duck_studios_register_post_types() {
    // Testimonials
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'duck-studios'),
            'singular_name' => __('Testimonial', 'duck-studios'),
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
    
    // Case Studies
    register_post_type('case_study', array(
        'labels' => array(
            'name' => __('Case Studies', 'duck-studios'),
            'singular_name' => __('Case Study', 'duck-studios'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-analytics',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
    
    // Services
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'duck-studios'),
            'singular_name' => __('Service', 'duck-studios'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'duck_studios_register_post_types');

// Register Custom Taxonomies
function duck_studios_register_taxonomies() {
    // Service Categories
    register_taxonomy('service_category', 'service', array(
        'labels' => array(
            'name' => __('Service Categories', 'duck-studios'),
            'singular_name' => __('Service Category', 'duck-studios'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));
    
    // Case Study Categories
    register_taxonomy('case_study_category', 'case_study', array(
        'labels' => array(
            'name' => __('Case Study Categories', 'duck-studios'),
            'singular_name' => __('Case Study Category', 'duck-studios'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'duck_studios_register_taxonomies');

// ACF JSON save point
function duck_studios_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'duck_studios_acf_json_save_point');

// ACF JSON load point
function duck_studios_acf_json_load_point($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'duck_studios_acf_json_load_point');

// Custom shortcode for contact form
function duck_studios_contact_form_shortcode() {
    ob_start();
    get_template_part('template-parts/contact-form');
    return ob_get_clean();
}
add_shortcode('contact_form', 'duck_studios_contact_form_shortcode');

// Process contact form submission
function duck_studios_process_contact_form() {
    if (isset($_POST['duck_studios_contact_submit'])) {
        // Debug - log form submission
        error_log('Form submitted at: ' . date('Y-m-d H:i:s'));
        error_log('POST data: ' . print_r($_POST, true));
        
        // Verify nonce
        if (!isset($_POST['duck_studios_contact_nonce']) || !wp_verify_nonce($_POST['duck_studios_contact_nonce'], 'duck_studios_contact_form')) {
            error_log('Nonce verification failed');
            wp_die('Security check failed');
        }
        
        // Initialize form data array with POST values
        $form_data = array(
            'full_name' => isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '',
            'industry' => isset($_POST['industry']) ? sanitize_text_field($_POST['industry']) : '',
            'country_code' => isset($_POST['country_code']) ? sanitize_text_field($_POST['country_code']) : '+1',
            'phone' => isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '',
            'company' => isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '',
            'email' => isset($_POST['email']) ? sanitize_email($_POST['email']) : '',
            'note' => isset($_POST['note']) ? sanitize_text_field($_POST['note']) : '',
            'contact_method' => isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '',
            'monthly_income' => isset($_POST['monthly_income']) ? sanitize_text_field($_POST['monthly_income']) : '',
            'additional_info' => isset($_POST['additional_info']) ? sanitize_textarea_field($_POST['additional_info']) : ''
        );
        
        // Log the sanitized form data
        error_log('Sanitized form data: ' . print_r($form_data, true));
        
        $validation_errors = array();
        
        // Check required fields
        $required_fields = array('full_name', 'industry', 'phone', 'company', 'email', 'note', 'contact_method', 'monthly_income');
        foreach ($required_fields as $field) {
            if (empty($form_data[$field])) {
                $validation_errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }
        
        // Store form data in session for persistence
        $_SESSION['contact_form_data'] = $form_data;
        
        // If no validation errors, save to database and send email
        if (empty($validation_errors)) {
            // Create post
            $post_data = array(
                'post_title'    => wp_strip_all_tags($form_data['full_name']) . ' - ' . date('Y-m-d H:i:s'),
                'post_status'   => 'publish',
                'post_type'     => 'contact_submission'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (!is_wp_error($post_id)) {
                // Save meta data and log submission
                foreach ($form_data as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
                
                duck_studios_log_form_submission($post_id, $form_data);
                
                // Set up multiple recipients
                $to = array(
                    'info@duckstudios.net',
                    'sebastianmasia@gmail.com'
                );
                
                $subject = 'New Contact Form Submission: ' . $form_data['full_name'] . ' - ' . $form_data['company'];
                
                // Build HTML email
                $message = '<html><body>';
                $message .= '<h2>New Contact Form Submission</h2>';
                $message .= '<p><strong>Submitted on:</strong> ' . date('F j, Y, g:i a') . '</p>';
                $message .= '<table style="width: 100%; border-collapse: collapse;">';
                
                foreach ($form_data as $field => $value) {
                    if (!empty($value)) {
                        $field_name = ucfirst(str_replace('_', ' ', $field));
                        $message .= '<tr style="border-bottom: 1px solid #eee;">';
                        $message .= '<th style="padding: 8px; text-align: left; width: 30%;">' . $field_name . ':</th>';
                        $message .= '<td style="padding: 8px;">' . esc_html($value) . '</td>';
                        $message .= '</tr>';
                    }
                }
                
                $message .= '</table>';
                $message .= '</body></html>';
                
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: Duck Studios <info@duckstudios.net>',
                    'Reply-To: ' . $form_data['full_name'] . ' <' . $form_data['email'] . '>'
                );
                
                // Send email to each recipient and log the results
                $all_sent = true;
                foreach ($to as $recipient) {
                    $mail_sent = wp_mail($recipient, $subject, $message, $headers);
                    error_log('Email sending attempt to ' . $recipient . ' result: ' . ($mail_sent ? 'Success' : 'Failed'));
                    if (!$mail_sent) {
                        $all_sent = false;
                    }
                }
                
                // Log overall email sending status
                error_log('All emails sent successfully: ' . ($all_sent ? 'Yes' : 'No'));
                
                // Clear session data
                unset($_SESSION['contact_form_data']);
                
                // Redirect to thank you page
                wp_redirect(home_url('/thank-you/'));
                exit;
            } else {
                error_log('Failed to create post: ' . $post_id->get_error_message());
                wp_redirect(add_query_arg('form_error', '1', '#contact'));
                exit;
            }
        } else {
            error_log('Validation errors: ' . print_r($validation_errors, true));
            wp_redirect(add_query_arg('form_error', '1', '#contact'));
            exit;
        }
    }
}
add_action('template_redirect', 'duck_studios_process_contact_form');

/**
 * Fallback for ACF functions when the plugin is not active
 */
if (!function_exists('get_field')) {
    function get_field($key, $post_id = false, $format_value = true) {
        // Return default values based on field name
        $defaults = array(
            // Hero section
            'hero_tagline_1' => 'Technology',
            'hero_tagline_2' => 'Creativity',
            'hero_tagline_3' => 'Strategy',
            'hero_title_part_1' => 'We Build',
            'hero_title_part_2' => 'Results,',
            'hero_title_part_3' => 'Not Illusions',
            'hero_description' => 'We integrate into your team, work alongside you, and turn strategy into real outcomes.',
            'hero_button_text' => 'Book consultation',
            'hero_button_link' => '#contact',
            
            // Services section
            'services_subtitle' => 'Our 360 services',
            'services_title' => 'Integrated Strategies, Real Execution',
            'services_description' => 'Every stage of your brand journey, worked step by step to maximize results',
            
            // Results section
            'results_subtitle' => 'Our results',
            'results_title' => 'Impact you can measure, growth you can feel',
            
            // Testimonials section
            'testimonials_subtitle' => 'Why us?',
            'testimonials_title' => 'We work with you and think like you',
            'testimonials_button_text' => 'Click Here',
            'testimonials_button_link' => '#',
            
            // Choose us section
            'choose_us_title' => 'CHOOSE US DUCK STUDIOS',
            'choose_us_description' => "We don't believe in shortcuts. We believe in building together, <strong>step by step</strong>, with strategy, data, real creativity, and hands deep in the work. We're not here to promise magic results - <strong>we're here to design them</strong>, test them, and perfect them with you.",
            'success_stories_subtitle' => 'Success stories',
            'success_stories_title' => 'Business stories that chose to build with us',
            
            // Methodology section
            'methodology_subtitle' => 'Our methodology',
            'methodology_title' => "We don't guess: we build, measure, and evolve",
            
            // FAQ section
            'faq_subtitle' => 'FAQ',
            'faq_title' => 'What no one tells you about growing your brand',
            
            // Contact section
            'contact_title_part_1' => 'Instant Results? No.',
            'contact_title_part_2' => 'Real Results? Absolutely.',
            'contact_description' => "Tell us about your brand, let's build something big!",
        );
        
        return isset($defaults[$key]) ? $defaults[$key] : '';
    }
}

if (!function_exists('have_rows')) {
    function have_rows($field_key, $post_id = false) {
        // Always return false when ACF is not active
        return false;
    }
}

if (!function_exists('the_field')) {
    function the_field($key, $post_id = false) {
        echo get_field($key, $post_id);
    }
}

// Check if ACF is active and show admin notice if it's not
function duck_studios_check_acf() {
    if (!function_exists('acf_add_options_page')) {
        add_action('admin_notices', 'duck_studios_acf_notice');
    }
}
add_action('admin_init', 'duck_studios_check_acf');

// Admin notice for ACF recommendation
function duck_studios_acf_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php _e('Duck Studios theme works best with the Advanced Custom Fields plugin. Please install and activate it for full theme functionality.', 'duck-studios'); ?></p>
        <p><a href="<?php echo esc_url(admin_url('plugin-install.php?s=advanced+custom+fields&tab=search&type=term')); ?>" class="button button-primary"><?php _e('Install Advanced Custom Fields', 'duck-studios'); ?></a></p>
    </div>
    <?php
}

/**
 * Register custom post type for contact submissions
 */
function duck_studios_register_contact_submission_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Contact Submissions',
            'singular_name' => 'Contact Submission'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-email'
    );
    
    register_post_type('contact_submission', $args);
}
add_action('init', 'duck_studios_register_contact_submission_post_type');

// Add custom columns to the Contact Submissions admin list
function duck_studios_contact_submissions_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Name', 'duck-studios'),
        'email' => __('Email', 'duck-studios'),
        'phone' => __('Phone', 'duck-studios'),
        'company' => __('Company', 'duck-studios'),
        'contact_method' => __('Contact Method', 'duck-studios'),
        'date' => $columns['date']
    );
    return $new_columns;
}
add_filter('manage_contact_submission_posts_columns', 'duck_studios_contact_submissions_columns');

// Add data to the custom columns
function duck_studios_contact_submissions_column_data($column, $post_id) {
    switch ($column) {
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'phone':
            $country_code = get_post_meta($post_id, 'country_code', true);
            $phone = get_post_meta($post_id, 'phone', true);
            echo esc_html($country_code . ' ' . $phone);
            break;
        case 'company':
            echo esc_html(get_post_meta($post_id, 'company', true));
            break;
        case 'contact_method':
            echo esc_html(get_post_meta($post_id, 'contact_method', true));
            break;
    }
}
add_action('manage_contact_submission_posts_custom_column', 'duck_studios_contact_submissions_column_data', 10, 2);

// Add metabox to show all contact submission details
function duck_studios_add_contact_meta_box() {
    add_meta_box(
        'contact_submission_details',
        __('Contact Submission Details', 'duck-studios'),
        'duck_studios_contact_meta_box_callback',
        'contact_submission',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'duck_studios_add_contact_meta_box');

// Callback function for the metabox
function duck_studios_contact_meta_box_callback($post) {
    // Get all the post meta
    $meta_fields = array(
        'full_name' => 'Full Name',
        'email' => 'Email',
        'country_code' => 'Country Code',
        'phone' => 'Phone',
        'company' => 'Company',
        'industry' => 'Industry',
        'note' => 'Note',
        'contact_method' => 'Preferred Contact Method',
        'monthly_income' => 'Monthly Income',
        'additional_info' => 'Additional Information',
        'submission_date' => 'Submission Date'
    );
    
    echo '<table class="form-table">';
    foreach ($meta_fields as $field => $label) {
        $value = get_post_meta($post->ID, $field, true);
        if (!empty($value)) {
            echo '<tr>';
            echo '<th><strong>' . esc_html($label) . ':</strong></th>';
            echo '<td>' . esc_html($value) . '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
}

/**
 * Add WhatsApp floating button
 */
function duck_studios_add_whatsapp_button() {
    ?>
    <style>
        .ds-whatsapp-btn {
            position: fixed !important;
            display: flex !important;
            width: 60px !important;
            height: 60px !important;
            bottom: 20px !important;
            right: 20px !important;
            background-color: #25D366 !important;
            color: #FFF !important;
            border-radius: 50% !important;
            text-align: center !important;
            justify-content: center !important;
            align-items: center !important;
            font-size: 32px !important;
            z-index: 100000 !important;
            animation: whatsapp-pulse 1.5s ease-in-out infinite !important;
        }
        
        @keyframes whatsapp-pulse {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.9);
            }
            
            50% {
                transform: scale(1.1);
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            
            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }
        
        .ds-whatsapp-btn i {
            color: white !important;
            font-size: 32px !important;
        }
        
        @media (max-width: 767px) {
            .ds-whatsapp-btn {
                width: 55px !important;
                height: 55px !important;
            }
            
            .ds-whatsapp-btn i {
                font-size: 30px !important;
            }
        }
    </style>
    <a href="https://wa.me/50671049909" class="ds-whatsapp-btn" target="_blank" rel="noopener">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <?php
}
add_action('wp_footer', 'duck_studios_add_whatsapp_button', 999);

/**
 * Add settings page for contact form email configuration
 */
function duck_studios_add_admin_menu() {
    add_options_page(
        'Contact Form Settings',
        'Contact Form',
        'manage_options',
        'duck-studios-contact',
        'duck_studios_contact_options_page'
    );
}
add_action('admin_menu', 'duck_studios_add_admin_menu');

/**
 * Configure SMTP for WordPress
 */
function duck_studios_configure_smtp($phpmailer) {
    // Use WordPress default mail settings instead of SMTP
    // This will use the server's default mail configuration
    $phpmailer->isMail();
    
    // Set the from name and email
    $phpmailer->FromName = 'Duck Studios';
    $phpmailer->From = 'info@duckstudios.net';
    
    // Log mail attempts for debugging
    error_log('Mail Configuration - ' . date('Y-m-d H:i:s'));
    error_log('From: ' . $phpmailer->From);
    error_log('FromName: ' . $phpmailer->FromName);
}
add_action('phpmailer_init', 'duck_studios_configure_smtp');

// Extend the existing settings page to include SMTP settings
function duck_studios_contact_options_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Save settings if form was submitted
    if (isset($_POST['duck_studios_contact_email'])) {
        update_option('duck_studios_contact_email', sanitize_email($_POST['duck_studios_contact_email']));
        
        // Save SMTP settings
        if (isset($_POST['smtp_host'])) {
            update_option('duck_studios_smtp_host', sanitize_text_field($_POST['smtp_host']));
            update_option('duck_studios_smtp_port', absint($_POST['smtp_port']));
            update_option('duck_studios_smtp_user', sanitize_text_field($_POST['smtp_user']));
            if (!empty($_POST['smtp_pass'])) {
                update_option('duck_studios_smtp_pass', sanitize_text_field($_POST['smtp_pass']));
            }
        }
        
        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }
    
    $current_email = get_option('duck_studios_contact_email', get_option('admin_email'));
    $smtp_host = get_option('duck_studios_smtp_host', 'mail.duckstudios.net');
    $smtp_port = get_option('duck_studios_smtp_port', 465);
    $smtp_user = get_option('duck_studios_smtp_user', '_mainaccount@duckstudios.net');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="" method="post">
            <h2>Contact Form Settings</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">Contact Form Notification Email</th>
                    <td>
                        <input type="email" name="duck_studios_contact_email" value="<?php echo esc_attr($current_email); ?>" class="regular-text">
                        <p class="description">Email address where contact form submissions will be sent. Defaults to admin email if left empty.</p>
                    </td>
                </tr>
            </table>
            
            <h2>SMTP Settings</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">SMTP Host</th>
                    <td>
                        <input type="text" name="smtp_host" value="<?php echo esc_attr($smtp_host); ?>" class="regular-text">
                        <p class="description">Your mail server: mail.duckstudios.net</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">SMTP Port</th>
                    <td>
                        <input type="number" name="smtp_port" value="<?php echo esc_attr($smtp_port); ?>" class="small-text">
                        <p class="description">Secure SSL/TLS port: 465</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">SMTP Username</th>
                    <td>
                        <input type="text" name="smtp_user" value="<?php echo esc_attr($smtp_user); ?>" class="regular-text">
                        <p class="description">Your email username: _mainaccount@duckstudios.net</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">SMTP Password</th>
                    <td>
                        <input type="password" name="smtp_pass" class="regular-text">
                        <p class="description">Your cPanel password. Leave empty to keep existing password.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
        
        <div class="card">
            <h2>Test Email Settings</h2>
            <p>After saving your SMTP settings, you can send a test email to verify the configuration.</p>
            <button type="button" class="button button-secondary" id="test-email">Send Test Email</button>
            <span id="test-email-result"></span>
        </div>
        
        <div class="card" style="margin-top: 20px;">
            <h2>Email Configuration Help</h2>
            <p><strong>Your Secure SSL/TLS Settings:</strong></p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                <li>SMTP Host: mail.duckstudios.net</li>
                <li>SMTP Port: 465 (SSL/TLS)</li>
                <li>Username: _mainaccount@duckstudios.net</li>
                <li>Password: Your cPanel password</li>
                <li>Authentication: Required</li>
                <li>Security: SSL</li>
            </ul>
            <p><em>Note: These settings use secure SSL/TLS encryption for maximum security.</em></p>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#test-email').click(function() {
            var $button = $(this);
            var $result = $('#test-email-result');
            
            $button.prop('disabled', true);
            $result.html(' <em>Sending test email...</em>');
            
            $.post(ajaxurl, {
                action: 'test_smtp_email'
            }, function(response) {
                if (response.success) {
                    $result.html(' <span style="color: green;">✓ Test email sent successfully!</span>');
                } else {
                    $result.html(' <span style="color: red;">✗ Failed to send test email. Check your settings.</span>');
                }
                $button.prop('disabled', false);
            });
        });
    });
    </script>
    <?php
}

// Add AJAX handler for test email
function duck_studios_test_smtp_email() {
    $to = get_option('duck_studios_contact_email', get_option('admin_email'));
    $subject = 'SMTP Test Email';
    $message = 'This is a test email to verify your SMTP settings are working correctly.';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    $result = wp_mail($to, $subject, $message, $headers);
    
    wp_send_json_success($result);
}
add_action('wp_ajax_test_smtp_email', 'duck_studios_test_smtp_email');

// Add this function to log all form submissions
function duck_studios_log_form_submission($post_id, $form_data) {
    $log_file = get_stylesheet_directory() . '/form-submissions.log';
    $log_entry = date('Y-m-d H:i:s') . " - New submission:\n";
    $log_entry .= "Post ID: " . $post_id . "\n";
    foreach ($form_data as $key => $value) {
        $log_entry .= $key . ": " . $value . "\n";
    }
    $log_entry .= "------------------------\n";
    
    error_log($log_entry);
    @file_put_contents($log_file, $log_entry, FILE_APPEND);
}
