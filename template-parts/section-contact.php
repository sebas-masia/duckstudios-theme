<?php
/**
 * Template part for displaying the contact section
 *
 * @package Duck_Studios
 */

// Initialize variables to store form data
$form_data = array(
    'full_name' => '',
    'industry' => '',
    'country_code' => '+1',
    'phone' => '',
    'company' => '',
    'email' => '',
    'note' => '',
    'contact_method' => '',
    'monthly_income' => '',
    'additional_info' => ''
);

$form_message = '';
$form_status = '';

// Only process the form here if there's an error parameter indicating the form was already processed
if (isset($_GET['form_error']) && $_GET['form_error'] === '1') {
    $form_message = 'There was an error processing your submission. Please try again.';
    $form_status = 'error';
    
    // Retrieve form data from session if available
    if (isset($_SESSION['contact_form_data']) && is_array($_SESSION['contact_form_data'])) {
        $form_data = $_SESSION['contact_form_data'];
    }
}
?>

<section id="contact" class="contact-section">
    <div class="site-background">
        <div class="gradient-blob blob-yellow"></div>
    </div>
    <div class="container">
        <div class="contact-content">
            <div class="contact-logo">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.webp" alt="Duck Studios Logo">
            </div>
            <h2 class="contact-title"><?php echo esc_html(get_field('contact_title_part_1', 'option') ?: 'Instant Results? No.'); ?></h2>
            <h3 class="contact-subtitle"><?php echo esc_html(get_field('contact_title_part_2', 'option') ?: 'Real Results? Absolutely.'); ?></h3>
            <p class="contact-description"><?php echo esc_html(get_field('contact_description', 'option') ?: 'Tell us about your brand, let\'s build something big!'); ?></p>
            
            <?php if (!empty($form_message)) : ?>
                <div class="form-message <?php echo esc_attr($form_status); ?>">
                    <?php echo wp_kses_post($form_message); ?>
                </div>
            <?php endif; ?>
            
            <div class="contact-form">
                <form method="post" action="">
                    <?php wp_nonce_field('duck_studios_contact_form', 'duck_studios_contact_nonce'); ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo esc_attr($form_data['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="industry" class="form-label">Industry *</label>
                            <input type="text" id="industry" name="industry" class="form-control" value="<?php echo esc_attr($form_data['industry']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone *</label>
                            <div class="phone-input-wrapper">
                                <div class="country-code">
                                    <select id="country_code" name="country_code" class="country-select">
                                        <option value="+1" <?php selected($form_data['country_code'], '+1'); ?>>+1</option>
                                        <option value="+44" <?php selected($form_data['country_code'], '+44'); ?>>+44</option>
                                        <option value="+61" <?php selected($form_data['country_code'], '+61'); ?>>+61</option>
                                        <option value="+91" <?php selected($form_data['country_code'], '+91'); ?>>+91</option>
                                        <option value="+86" <?php selected($form_data['country_code'], '+86'); ?>>+86</option>
                                    </select>
                                </div>
                                <input type="tel" id="phone" name="phone" class="form-control phone-number" value="<?php echo esc_attr($form_data['phone']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company" class="form-label">Company *</label>
                            <input type="text" id="company" name="company" class="form-control" value="<?php echo esc_attr($form_data['company']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo esc_attr($form_data['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="note" class="form-label">Note *</label>
                            <input type="text" id="note" name="note" class="form-control" value="<?php echo esc_attr($form_data['note']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_method" class="form-label">Preferred contact method *</label>
                            <select id="contact_method" name="contact_method" class="form-select custom-select" required>
                                <option value="">Select an option</option>
                                <option value="WhatsApp" <?php selected($form_data['contact_method'], 'WhatsApp'); ?>>WhatsApp</option>
                                <option value="Email" <?php selected($form_data['contact_method'], 'Email'); ?>>Email</option>
                                <option value="Phone" <?php selected($form_data['contact_method'], 'Phone'); ?>>Phone</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="monthly_income" class="form-label">Monthly Income *</label>
                            <select id="monthly_income" name="monthly_income" class="form-select custom-select" required>
                                <option value="">Select an option</option>
                                <option value="Under $500" <?php selected($form_data['monthly_income'], 'Under $500'); ?>>Under $500</option>
                                <option value="$500 - $1,000" <?php selected($form_data['monthly_income'], '$500 - $1,000'); ?>>$500 - $1,000</option>
                                <option value="$1,000 - $5,000" <?php selected($form_data['monthly_income'], '$1,000 - $5,000'); ?>>$1,000 - $5,000</option>
                                <option value="$5,000 - $10,000" <?php selected($form_data['monthly_income'], '$5,000 - $10,000'); ?>>$5,000 - $10,000</option>
                                <option value="$10,000+" <?php selected($form_data['monthly_income'], '$10,000+'); ?>>$10,000+</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="additional_info" class="form-label">Additional information</label>
                        <input type="text" id="additional_info" name="additional_info" class="form-control" value="<?php echo esc_attr($form_data['additional_info']); ?>">
                    </div>
                    
                    <div class="form-group text-center">
                        <button type="submit" name="duck_studios_contact_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.form-message {
    margin-bottom: 20px;
    padding: 10px 15px;
    border-radius: 4px;
}
.form-message.success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}
.form-message.error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}
</style>
