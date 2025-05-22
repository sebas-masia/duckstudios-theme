<?php
/**
 * Template Name: Thank You Page
 *
 * @package Duck_Studios
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="thank-you-section">
        <div class="container">
            <div class="thank-you-content">
                <h1 class="thank-you-title">Thank You!</h1>
                <div class="thank-you-message">
                    <p>Your submission has been received successfully. We appreciate you contacting Duck Studios.</p>
                    <p>Our team will review your information and get back to you shortly using your preferred contact method.</p>
                </div>
                <div class="thank-you-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.thank-you-section {
    padding: 120px 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
    background-color: #1a1a1a;
    color: #ffffff;
}

.thank-you-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.thank-you-title {
    font-size: 3rem;
    margin-bottom: 30px;
    color: #FFD700;
}

.thank-you-message {
    margin-bottom: 40px;
    font-size: 1.2rem;
    line-height: 1.6;
}

.thank-you-actions {
    margin-top: 30px;
}

.thank-you-actions .btn {
    padding: 12px 30px;
    font-size: 1.1rem;
}
</style>

<?php
get_footer(); 