
  const slider = document.getElementById('slider');
  const totalSlides = slider.children.length;
  let currentIndex = 0;

  function goToSlide(index) {
    slider.style.transform = `translateX(-${index * 100}%)`;
  }

  // Next Button
  document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % totalSlides;
    goToSlide(currentIndex);
  });

  // Prev Button
  document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    goToSlide(currentIndex);
  });

  // ✅ Auto Slide Every 5 Seconds
  setInterval(() => {
    currentIndex = (currentIndex + 1) % totalSlides;
    goToSlide(currentIndex);
  }, 5000);

