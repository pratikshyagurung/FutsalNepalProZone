// Toggle Mobile Navigation
function toggleMenu() {
  document.getElementById("primary-navigation").classList.toggle("active");
}

// Change Header Background on Scroll
window.addEventListener("scroll", function () {
  const header = document.querySelector(".primary-header");
  const hero = document.querySelector(".hero");

  // Get hero section height
  const heroBottom = hero.offsetHeight;

  if (window.scrollY > heroBottom - 100) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});


// slider
let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    dots[i].classList.remove("active");
  });

  slides[index].classList.add("active");
  dots[index].classList.add("active");
}

function nextSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  showSlide(currentIndex);
}

function currentSlide(index) {
  currentIndex = index - 1;
  showSlide(currentIndex);
}

/* Auto Slide */
setInterval(nextSlide, 5000);

document.addEventListener("DOMContentLoaded", function () {
  const heroText = document.querySelector("h1");
  const heroButton = document.querySelector(".cta-button");

  setTimeout(() => {
      heroText.style.opacity = "1";
      heroButton.style.opacity = "1";
  }, 900);
});

// news
document.addEventListener("DOMContentLoaded", function () {
  const newsCards = document.querySelectorAll(".news-card");

  function revealCards() {
      newsCards.forEach((card) => {
          const cardPosition = card.getBoundingClientRect().top;
          const screenPosition = window.innerHeight / 1.2;

          if (cardPosition < screenPosition) {
              card.classList.add("show");
          }
      });
  }

  window.addEventListener("scroll", revealCards);
  revealCards(); // Run once on page load
});

