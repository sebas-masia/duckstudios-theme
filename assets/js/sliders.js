/**
 * File sliders.js.
 *
 * Handles all slider functionality on the site.
 */
const jQuery = window.jQuery;
jQuery(document).ready(($) => {
  // Generic slider function for results and success stories
  function initGenericSlider(trackClass, prevClass, nextClass) {
    const track = $(trackClass);
    const prev = $(prevClass);
    const next = $(nextClass);

    if (track.length === 0) return;

    const slideWidth = track.find(".slider-item").outerWidth(true);
    const slideCount = track.find(".slider-item").length;
    let currentPosition = 0;

    // Set initial width
    track.css("width", slideWidth * slideCount + "px");

    // Handle next button click
    next.on("click", () => {
      if (currentPosition > -(slideCount - 1)) {
        currentPosition--;
        track.css("transform", `translateX(${currentPosition * slideWidth}px)`);
      } else {
        // Loop back to start
        currentPosition = 0;
        track.css("transform", `translateX(0)`);
      }
    });

    // Handle prev button click
    prev.on("click", () => {
      if (currentPosition < 0) {
        currentPosition++;
        track.css("transform", `translateX(${currentPosition * slideWidth}px)`);
      } else {
        // Loop to end
        currentPosition = -(slideCount - 1);
        track.css("transform", `translateX(${currentPosition * slideWidth}px)`);
      }
    });

    // Auto slide
    let autoSlideInterval = setInterval(() => {
      next.trigger("click");
    }, 5000);

    // Pause on hover
    track
      .parent()
      .on("mouseenter", () => {
        clearInterval(autoSlideInterval);
      })
      .on("mouseleave", () => {
        autoSlideInterval = setInterval(() => {
          next.trigger("click");
        }, 5000);
      });
  }

  // Initialize other sliders
  initGenericSlider(".results-track", ".results-prev", ".results-next");
  initGenericSlider(".success-stories-track", ".success-prev", ".success-next");
});
