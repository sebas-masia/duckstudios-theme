/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
;(() => {
  const mobileMenuToggle = document.querySelector(".mobile-menu-toggle")
  const mainNavigation = document.querySelector(".main-navigation")

  if (mobileMenuToggle && mainNavigation) {
    mobileMenuToggle.addEventListener("click", () => {
      mainNavigation.classList.toggle("active")
      mobileMenuToggle.setAttribute("aria-expanded", mainNavigation.classList.contains("active"))
    })
  }

  // Close the mobile menu when clicking outside
  document.addEventListener("click", (event) => {
    if (mainNavigation && mainNavigation.classList.contains("active")) {
      if (!mainNavigation.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
        mainNavigation.classList.remove("active")
        mobileMenuToggle.setAttribute("aria-expanded", "false")
      }
    }
  })

  // Handle smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href")

      if (targetId === "#") return

      const targetElement = document.querySelector(targetId)

      if (targetElement) {
        e.preventDefault()

        // Close mobile menu if open
        if (mainNavigation && mainNavigation.classList.contains("active")) {
          mainNavigation.classList.remove("active")
          mobileMenuToggle.setAttribute("aria-expanded", "false")
        }

        window.scrollTo({
          top: targetElement.offsetTop - 80, // Adjust for header height
          behavior: "smooth",
        })
      }
    })
  })
})()
