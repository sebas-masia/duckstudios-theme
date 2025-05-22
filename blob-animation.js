// Subtle animations for gradient blobs
document.addEventListener("DOMContentLoaded", function () {
  // Get all gradient blobs
  const blobs = document.querySelectorAll(".gradient-blob");

  // Apply different animation to each blob
  blobs.forEach((blob, index) => {
    // Create random animation duration between 15-30 seconds
    const duration = 15 + Math.random() * 15;
    // Create random delay between 0-5 seconds
    const delay = Math.random() * 5;

    // Set animation properties
    blob.style.animation = `blobFloat${
      (index % 3) + 1
    } ${duration}s ease-in-out ${delay}s infinite alternate`;
  });
});

// Add this to your stylesheet or include in your CSS file
document.head.insertAdjacentHTML(
  "beforeend",
  `
  <style>
    @keyframes blobFloat1 {
      0% {
        transform: translate(0, 0) scale(1);
      }
      100% {
        transform: translate(20px, -20px) scale(1.05);
      }
    }
    
    @keyframes blobFloat2 {
      0% {
        transform: translate(0, 0) scale(1);
      }
      100% {
        transform: translate(-15px, 25px) scale(1.08);
      }
    }
    
    @keyframes blobFloat3 {
      0% {
        transform: translate(0, 0) scale(1);
      }
      100% {
        transform: translate(25px, 10px) scale(1.03);
      }
    }
    
    .gradient-blob {
      transition: all 0.5s ease;
    }
  </style>
`
);
