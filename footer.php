<?php
/**
 * The template for displaying the footer
 *
 * @package Duck_Studios
 */

?>

    <footer id="colophon" class="site-footer">
        <div class="footer-top-border"></div>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.webp" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="footer-logo-img">
                        <span class="footer-logo-text">DUCK STUDIOS</span>
                    </a>
                </div>
                
                <div class="footer-contact">
                    <h3 class="footer-contact-title"><?php echo esc_html__('Contact us at:', 'duck-studios'); ?></h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fa-brands fa-whatsapp"></i>
                            <a href="tel:+5067104-9909">+506 7104-9909</a>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:info@duckstudios.net">info@duckstudios.net</a>
                        </div>
                    </div>
                </div>
                
                <div class="footer-social">
                    <div class="social-container">
                        <h3 class="social-title"><?php echo esc_html__('Follow our socials:', 'duck-studios'); ?></h3>
                        <div class="social-duck-name">@DUCK_STUDIOS</div>
                        <div class="social-links">
                            <a href="#" class="social-link">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
