// Simple parallax effect for section backgrounds
document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll("section");

  // Function to update background positions on scroll
  function updateParallax() {
    const scrollPosition = window.pageYOffset;

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const backgroundElements = section.querySelectorAll(".gradient-blob");

      // Check if section is in viewport or close to it
      if (
        scrollPosition > sectionTop - window.innerHeight &&
        scrollPosition < sectionTop + sectionHeight
      ) {
        // Calculate parallax scroll rate
        const scrollRate =
          (scrollPosition - (sectionTop - window.innerHeight)) /
          (sectionHeight + window.innerHeight);

        // Apply different parallax effects to each background element
        backgroundElements.forEach((blob, index) => {
          // Different movement speed for each blob
          const parallaxSpeed = 0.15 + index * 0.05;
          const yOffset = scrollRate * 100 * parallaxSpeed - 50;

          // Apply transform
          blob.style.transform = `translateY(${yOffset}px)`;

          // Adjust opacity based on visibility in viewport
          const opacity = 0.3 + scrollRate * 0.2;
          blob.style.opacity = Math.min(opacity, 0.6);
        });
      }
    });
  }

  // Initial update
  updateParallax();

  // Update on scroll with throttling for performance
  let ticking = false;
  window.addEventListener("scroll", function () {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        updateParallax();
        ticking = false;
      });
      ticking = true;
    }
  });

  // Update on resize
  window.addEventListener("resize", updateParallax);
});
