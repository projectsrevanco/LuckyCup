document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function (e) {
    const href = this.getAttribute('href');

    if (href.startsWith('#')) {
      e.preventDefault();  // block only for in-page anchors
      const targetId = href.substring(1);
      document.getElementById(targetId)?.scrollIntoView({ behavior: 'smooth' });
    }
    // else: let browser do normal navigation (aboutus.html, services.html, etc.)
  });
});
