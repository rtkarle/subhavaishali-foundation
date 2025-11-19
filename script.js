
/* ----------------------------------------------------
   REVEAL ANIMATIONS
---------------------------------------------------- */
/* Add reveal to all vm-box */
document.querySelectorAll(".vm-box").forEach(box=>{
  box.classList.add("reveal");
});

/* ----------------------------------------------------
   REVEAL ANIMATIONS
---------------------------------------------------- */
const reveals = document.querySelectorAll(".reveal");

const revealObserver = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.classList.add("visible");
    }
  });
},{threshold:0.2});

reveals.forEach(el=>revealObserver.observe(el));


/* ----------------------------------------------------
   HERO AUTO EVENT ROTATION (FINAL)
---------------------------------------------------- */
document.addEventListener("DOMContentLoaded", () => {

  const heroEvents = [
    {
      title: "Creating Change, One Life at a Time",
      desc: "Empowering tribal communities through education, healthcare, livelihood and environmental action.",
      img: "hero.jpg",
      link: "about.html"
    },
    {
      title: "Free Medical Camp for Tribal Families",
      desc: "Serving remote villages with healthcare support.",
      img: "img7.jpg",
      link: "event1.html"
    },
    {
      title: "Visit to Asha kiran founation",
      desc: "Health awareness and distribution activity conducted for young students..",
      img: "img3.jpg",
      link: "event3.html"
    }
  ];

  let index = 0;

  function updateHero(){
    let data = heroEvents[index];

    const title = document.getElementById("heroTitle");
    const desc = document.getElementById("heroDesc");
    const img = document.getElementById("heroImg");
    const btn = document.getElementById("heroBtn");

    // fade out
    title.classList.add("fade-hide");
    desc.classList.add("fade-hide");
    img.classList.add("fade-hide");

    setTimeout(() => {
      title.innerHTML = data.title;
      desc.innerHTML = data.desc;
      img.src = data.img;
      btn.href = data.link;

      // fade in
      title.classList.remove("fade-hide");
      desc.classList.remove("fade-hide");
      img.classList.remove("fade-hide");
      title.classList.add("fade-show");
      desc.classList.add("fade-show");
      img.classList.add("fade-show");
    }, 500);

    index = (index + 1) % heroEvents.length;
  }

  updateHero();
  setInterval(updateHero, 6000);
});


/* ----------------------------------------------------
   STORIES AUTO SLIDER
---------------------------------------------------- */

/* ----------------------------------------------------
   STORIES AUTO SLIDER — SUPPORTS ANY IMAGE NAMES
---------------------------------------------------- */

const slider = document.getElementById("storySlider");

/* 👉 येथे images + description + links define कर */
const storyData = [
  { img: "img7.jpg",  desc: "Medical Camp — Tribal Support ",           link: "event1.html" },
  { img: "img11.jpg",  desc: "Medical Service week",  link: "event2.html" },
  { img: "img3.jpg",  desc: " visit to Asha kiran foundation", link: "event3.html" },
  { img: "img4.jpg",  desc: "health Awareness and village outreach", link: "event4.html" },
  { img: "img12.jpg", desc: "free Health Camp:- phanspada",   link: "event5.html" },
  { img: "img15.jpg", desc: "Career Guidance & Social Responsibility Session",      link: "event6.html" },
  { img: "img16.jpg", desc: "Guest Lecture Session",         link: "event7.html" },
  { img: "img17.jpg", desc: "Student interaction  Session",         link: "event8.html" },
 /* { img: "img16.jpg", desc: "Village Cleanliness Drive",       link: "event8.html" },
  { img: "img18.jpg", desc: "Youth Leadership Workshop",       link: "event9.html" } */
];


/* 👉 Generate cards dynamically */
storyData.forEach(item => {
  const card = document.createElement("div");
  card.className = "story-card";

  card.innerHTML = `
    <img src="${item.img}" alt="">
    <p class="story-desc">${item.desc}</p>
  `;

  card.onclick = () => window.location.href = item.link;

  slider.appendChild(card);
});


/* Buttons */
document.querySelector(".story-next").onclick = () => {
  slider.scrollBy({ left: 300, behavior: "smooth" });
};

document.querySelector(".story-prev").onclick = () => {
  slider.scrollBy({ left: -300, behavior: "smooth" });
};

/* Auto slide */
setInterval(() => {
  slider.scrollBy({ left: 300, behavior: "smooth" });
}, 3500);
/* ----------------------------------------------------
   IMPACT COUNT-UP ANIMATION
---------------------------------------------------- */

const countItems = document.querySelectorAll(".impact-card h3");

const countObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !entry.target.classList.contains("counted")) {
      
      entry.target.classList.add("counted");
      let endValue = parseInt(entry.target.getAttribute("data-count"));
      let currentValue = 0;
      let speed = endValue / 60;

      let counter = setInterval(() => {
        currentValue += speed;
        if (currentValue >= endValue) {
          currentValue = endValue;
          clearInterval(counter);
        }
        entry.target.textContent = Math.floor(currentValue) + "+";
      }, 30);
    }
  });
}, { threshold: 0.5 });

countItems.forEach(item => countObserver.observe(item));


