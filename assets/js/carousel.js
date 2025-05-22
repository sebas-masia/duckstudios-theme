document.addEventListener("DOMContentLoaded", function () {
  initCarousels();
});

function initCarousels() {
  const carousels = document.querySelectorAll(".results-carousel");

  carousels.forEach((carousel) => {
    const slide = carousel.querySelector(".carousel-slide");
    const items = carousel.querySelectorAll(".carousel-item");
    const prevBtn = carousel.querySelector(".carousel-nav.prev");
    const nextBtn = carousel.querySelector(".carousel-nav.next");

    let currentIndex = Array.from(items).findIndex((item) =>
      item.classList.contains("active")
    );
    if (currentIndex === -1) currentIndex = 0;

    // Set initial state
    updateCarousel();

    // Add event listeners for navigation
    prevBtn.addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + items.length) % items.length;
      updateCarousel();
    });

    nextBtn.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % items.length;
      updateCarousel();
    });

    // Update carousel based on current index
    function updateCarousel() {
      items.forEach((item, index) => {
        item.classList.remove("active");

        if (index === currentIndex) {
          item.classList.add("active");
        }
      });
    }

    // Optional: Add touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener(
      "touchstart",
      (e) => {
        touchStartX = e.changedTouches[0].screenX;
      },
      false
    );

    carousel.addEventListener(
      "touchend",
      (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
      },
      false
    );

    function handleSwipe() {
      if (touchEndX < touchStartX - 50) {
        // Swipe left - go next
        nextBtn.click();
      } else if (touchEndX > touchStartX + 50) {
        // Swipe right - go prev
        prevBtn.click();
      }
    }
  });
}
