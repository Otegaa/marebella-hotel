document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.hamburger');
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay = document.querySelector('.mobile-menu-overlay');
  const body = document.body;

  // Toggle menu function
  function toggleMenu() {
    hamburger.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    overlay.classList.toggle('active');
    body.classList.toggle('menu-open');
  }

  // Close menu function
  function closeMenu() {
    hamburger.classList.remove('active');
    mobileMenu.classList.remove('active');
    overlay.classList.remove('active');
    body.classList.remove('menu-open');
  }

  hamburger.addEventListener('click', toggleMenu);

  overlay.addEventListener('click', closeMenu);

  // Close hamburger when clicking any link inside mobile menu
  const mobileLinks = mobileMenu.querySelectorAll('a');
  mobileLinks.forEach((link) => link.addEventListener('click', closeMenu));

  // Close hamburger on window resize if open to prevent issue
  window.addEventListener('resize', function () {
    if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
      closeMenu();
    }
  });

  // Close hamburger on ESC key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
      closeMenu();
    }
  });
});
