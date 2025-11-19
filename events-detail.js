/* ---------------- REVEAL ---------------- */
const reveals = document.querySelectorAll(".reveal");

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry =>
    entry.target.classList.toggle("visible", entry.isIntersecting)
  );
}, { threshold: 0.25 });

reveals.forEach(el => observer.observe(el));


/* ---------------- SLIDER ---------------- */
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const sliderContainer = document.querySelector(".slider-container");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");
const dotsContainer = document.querySelector(".slider-dots");


// Create dots
slides.forEach((_, i) => {
  const dot = document.createElement("div");
  dot.classList.add("dot");
  if (i === 0) dot.classList.add("active");
  dotsContainer.appendChild(dot);

  dot.addEventListener("click", () => {
    currentSlide = i;
    updateSlider();
    resetAuto();
  });
});

const dots = document.querySelectorAll(".dot");



function updateSlider() {
  slides.forEach(s => {
    s.classList.remove("active", "left", "right", "left-back", "right-back");
  });

  let total = slides.length;

  let prev = (currentSlide - 1 + total) % total;
  let next = (currentSlide + 1) % total;
  let prev2 = (currentSlide - 2 + total) % total;
  let next2 = (currentSlide + 2) % total;

  slides[currentSlide].classList.add("active");
  slides[prev].classList.add("left");
  slides[next].classList.add("right");
  slides[prev2].classList.add("left-back");
  slides[next2].classList.add("right-back");
}



// Buttons
nextBtn.addEventListener("click", () => {
  currentSlide = (currentSlide + 1) % slides.length;
  updateSlider();
  resetAuto();
});

prevBtn.addEventListener("click", () => {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  updateSlider();
  resetAuto();
});


// Auto slide every 3s
let auto = setInterval(() => {
  currentSlide = (currentSlide + 1) % slides.length;
  updateSlider();
}, 3000);

function resetAuto() {
  clearInterval(auto);
  auto = setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    updateSlider();
  }, 3000);
}


// Swipe
let startX = 0;

sliderContainer.addEventListener("touchstart", e => {
  startX = e.touches[0].clientX;
});

sliderContainer.addEventListener("touchend", e => {
  let endX = e.changedTouches[0].clientX;

  if (startX - endX > 50) nextBtn.click();
  if (endX - startX > 50) prevBtn.click();
});
