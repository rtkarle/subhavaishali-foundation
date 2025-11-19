
/* REVEAL */
const reveals = document.querySelectorAll(".reveal");

const obs = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.classList.add("visible");
    }
  });
},{threshold:0.2});

reveals.forEach(r=>obs.observe(r));


/* FILTER */
const filterBtns = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.activity-card');

filterBtns.forEach(btn=>{
  btn.addEventListener('click',()=>{
    
    document.querySelector('.filter-btn.active').classList.remove('active');
    btn.classList.add('active');

    let category = btn.getAttribute('data-filter');

    cards.forEach(card=>{
      if(category === "all" || card.classList.contains(category)){
        card.style.display = "flex";
        card.style.opacity = "1";
      } else {
        card.style.opacity = "0";
        setTimeout(()=>{ card.style.display = "none"; }, 300);
      }
    });

  });
});
