document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".carousel-inner");
  const items = document.querySelectorAll(".carousel-item");
  let currentIndex = 0;

  function showNextItem() {
    items[currentIndex].classList.remove("active");
    currentIndex = (currentIndex + 1) % items.length;
    items[currentIndex].classList.add("active");
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  setInterval(showNextItem, 3000);
});
