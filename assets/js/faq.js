/**
 * File faq.js.
 *
 * Handles the FAQ accordion functionality.
 */
((window, $) => {
  window.jQuery = window.$ = $;
  jQuery(document).ready(($) => {
    // Initialize all FAQ answers as hidden except the first one
    $(".faq-answer").hide();
    $(".faq-item:first-child .faq-answer").show();
    $(".faq-item:first-child .faq-toggle i")
      .removeClass("fa-plus")
      .addClass("fa-minus");

    $(".faq-question").on("click", function () {
      const $this = $(this);
      const $faqItem = $this.parent();
      const $faqAnswer = $faqItem.find(".faq-answer");
      const $faqToggle = $this.find(".faq-toggle i");
      const isActive = $faqItem.hasClass("active");

      // If clicking the active item, just close it
      if (isActive) {
        $faqItem.removeClass("active");
        $faqAnswer.slideUp(300);
        $faqToggle.removeClass("fa-minus").addClass("fa-plus");
        return;
      }

      // Close all other items
      $(".faq-item").removeClass("active");
      $(".faq-answer").slideUp(300);
      $(".faq-toggle i").removeClass("fa-minus").addClass("fa-plus");

      // Open clicked item
      $faqItem.addClass("active");
      $faqAnswer.slideDown(300);
      $faqToggle.removeClass("fa-plus").addClass("fa-minus");
    });
  });
})(window, jQuery);
