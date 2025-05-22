// Subtle animations for gradient blobs
document.addEventListener("DOMContentLoaded", function () {
  // Get all gradient blobs
  const blobs = document.querySelectorAll(".gradient-blob");

  // Set subtle static properties for blobs
  blobs.forEach((blob) => {
    blob.style.opacity = "0.4";
    blob.style.zIndex = "0";
    // No animations to avoid horizontal lines
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
