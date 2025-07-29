
  document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector('.slide-track');
    const items = document.querySelectorAll('.slide-track > div');

    if (!track || items.length === 0) return;

    let currentIndex = 0;
    const totalItems = items.length;

    function getItemsPerView() {
      return window.innerWidth < 768 ? 2 : 5;
    }

    function updateSlider() {
      const itemWidth = items[0].offsetWidth;
      const itemsPerView = getItemsPerView();
      const maxIndex = Math.max(0, totalItems - itemsPerView);
      if (currentIndex > maxIndex) currentIndex = 0;

      const transformX = -currentIndex * itemWidth;
      track.style.transform = `translateX(${transformX}px)`;
    }

    setInterval(() => {
      currentIndex++;
      updateSlider();
    }, 3000);

    // Recalculate on resize
    window.addEventListener('resize', () => {
      updateSlider();
    });

    // Initial position
    updateSlider();
  });

