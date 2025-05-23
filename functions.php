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
define('DUCK_STUDIOS_VERSION', '1.0.0');

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
    
    // Enqueue FontAwesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue main stylesheet
    wp_enqueue_style('duck-studios-style', get_stylesheet_uri(), array(), DUCK_STUDIOS_VERSION);
    
    // Enqueue section-specific stylesheets
    wp_enqueue_style('duck-studios-hero', get_template_directory_uri() . '/assets/css/sections/hero.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-results', get_template_directory_uri() . '/assets/css/sections/results.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-transitions', get_template_directory_uri() . '/assets/css/sections/transitions.css', array(), DUCK_STUDIOS_VERSION);
    wp_enqueue_style('duck-studios-carousel', get_template_directory_uri() . '/assets/css/carousel.css', array(), DUCK_STUDIOS_VERSION);
    
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
        // Verify nonce
        if (!isset($_POST['duck_studios_contact_nonce']) || !wp_verify_nonce($_POST['duck_studios_contact_nonce'], 'duck_studios_contact_form')) {
            wp_die('Security check failed');
        }
        
        // Debug - log POST data
        error_log('Form submitted with data: ' . print_r($_POST, true));
        
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
        
        $validation_errors = array();
        
        // Check required fields
        $required_fields = array('full_name', 'industry', 'phone', 'company', 'email', 'note', 'contact_method', 'monthly_income');
        foreach ($required_fields as $field) {
            if (empty($form_data[$field])) {
                $validation_errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }
        
        // Validate email
        if (!empty($form_data['email']) && !is_email($form_data['email'])) {
            $validation_errors[] = 'Please enter a valid email address.';
        }
        
        // Store form data in session for persistence
        $_SESSION['contact_form_data'] = $form_data;
        
        // If no validation errors, save to database
        if (empty($validation_errors)) {
            // Create a new form submission as a custom post type
            $post_data = array(
                'post_title'    => wp_strip_all_tags($form_data['full_name']) . ' - ' . date('Y-m-d H:i:s'),
                'post_status'   => 'publish',
                'post_type'     => 'contact_submission',
                'post_content'  => '' // Empty content
            );
            
            // Insert the post into the database
            $post_id = wp_insert_post($post_data);
            
            if (!is_wp_error($post_id)) {
                // Save each field individually to make sure they're saved properly
                update_post_meta($post_id, 'full_name', $form_data['full_name']);
                update_post_meta($post_id, 'industry', $form_data['industry']);
                update_post_meta($post_id, 'country_code', $form_data['country_code']);
                update_post_meta($post_id, 'phone', $form_data['phone']);
                update_post_meta($post_id, 'company', $form_data['company']);
                update_post_meta($post_id, 'email', $form_data['email']);
                update_post_meta($post_id, 'note', $form_data['note']);
                update_post_meta($post_id, 'contact_method', $form_data['contact_method']);
                update_post_meta($post_id, 'monthly_income', $form_data['monthly_income']);
                update_post_meta($post_id, 'additional_info', $form_data['additional_info']);
                
                // Add timestamp
                update_post_meta($post_id, 'submission_date', current_time('mysql'));
                
                // Create formatted data for display in admin
                $formatted_data = '';
                foreach ($form_data as $field => $value) {
                    if (!empty($value)) {
                        $formatted_data .= '<strong>' . ucfirst(str_replace('_', ' ', $field)) . ':</strong> ' . esc_html($value) . '<br>';
                    }
                }
                update_post_meta($post_id, 'formatted_data', $formatted_data);
                
                // Send email notification
                $recipient_email = 'info@duckstudios.net';
                
                $site_name = get_bloginfo('name');
                $subject = '[' . $site_name . '] New Contact Form Submission: ' . $form_data['full_name'] . ' - ' . $form_data['company'];
                
                // Build HTML email
                $message_html = '<html><body>';
                $message_html .= '<h2>New Contact Form Submission</h2>';
                $message_html .= '<p><strong>Submitted on:</strong> ' . date('F j, Y, g:i a') . '</p>';
                $message_html .= '<table style="width: 100%; border-collapse: collapse;">';
                
                foreach ($form_data as $field => $value) {
                    if (!empty($value)) {
                        $field_name = ucfirst(str_replace('_', ' ', $field));
                        $message_html .= '<tr style="border-bottom: 1px solid #eee;">';
                        $message_html .= '<th style="padding: 8px; text-align: left; width: 30%;">' . $field_name . ':</th>';
                        $message_html .= '<td style="padding: 8px;">' . esc_html($value) . '</td>';
                        $message_html .= '</tr>';
                    }
                }
                
                $message_html .= '</table>';
                $message_html .= '<p style="margin-top: 20px;">This submission has been saved to your WordPress admin area.</p>';
                $message_html .= '</body></html>';
                
                // Plain text version for email clients that don't support HTML
                $message_plain = "New contact form submission from: " . $form_data['full_name'] . "\n\n";
                foreach ($form_data as $field => $value) {
                    if (!empty($value)) {
                        $message_plain .= ucfirst(str_replace('_', ' ', $field)) . ": " . $value . "\n";
                    }
                }
                
                // Headers
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: ' . $site_name . ' <' . get_option('admin_email') . '>',
                    'Reply-To: ' . $form_data['full_name'] . ' <' . $form_data['email'] . '>'
                );
                
                // Add debugging
                error_log('Attempting to send email to: ' . $recipient_email);
                error_log('Email subject: ' . $subject);
                
                // Try PHP's mail function as a fallback if wp_mail doesn't work
                $mail_sent = wp_mail($recipient_email, $subject, $message_html, $headers);
                
                if (!$mail_sent) {
                    error_log('wp_mail failed, trying PHP mail function');
                    
                    // Set mail headers for PHP mail function
                    $php_headers = "MIME-Version: 1.0\r\n";
                    $php_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    $php_headers .= "From: " . $site_name . " <" . get_option('admin_email') . ">\r\n";
                    $php_headers .= "Reply-To: " . $form_data['full_name'] . " <" . $form_data['email'] . ">\r\n";
                    
                    // Send mail using PHP's mail function
                    $mail_sent = mail($recipient_email, $subject, $message_html, $php_headers);
                    
                    if (!$mail_sent) {
                        error_log('Both wp_mail and PHP mail failed to send the email');
                    } else {
                        error_log('Email sent successfully using PHP mail function');
                    }
                } else {
                    error_log('Email sent successfully using wp_mail');
                }
                
                // Clear session data
                unset($_SESSION['contact_form_data']);
                
                // Check if thank-you page exists, if not create it
                $thank_you_page = get_page_by_path('thank-you');
                if (!$thank_you_page) {
                    // Create thank you page
                    $page_data = array(
                        'post_title'    => 'Thank You',
                        'post_name'     => 'thank-you',
                        'post_status'   => 'publish',
                        'post_type'     => 'page',
                        'post_content'  => '<!-- wp:paragraph --><p>Thank you for your submission! We will contact you shortly.</p><!-- /wp:paragraph -->'
                    );
                    wp_insert_post($page_data);
                }
                
                // Redirect to thank you page
                wp_redirect(home_url('/thank-you/'));
                exit;
            } else {
                // Redirect back with error
                wp_redirect(add_query_arg('form_error', '1', '#contact'));
                exit;
            }
        } else {
            // Redirect back with error
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
