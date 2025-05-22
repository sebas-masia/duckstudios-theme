// Static gradient blobs - no parallax to avoid horizontal lines
document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll("section");

  // Make backgrounds visible but static
  sections.forEach((section) => {
    const backgroundElements = section.querySelectorAll(".site-background");
    backgroundElements.forEach((bg) => {
      bg.style.opacity = "0.6"; // More visible
      bg.style.zIndex = "0"; // Behind content
    });
  });
});
