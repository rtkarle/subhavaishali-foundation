// SCROLL REVEAL
const reveals = document.querySelectorAll('.reveal');
const revealOnScroll = () => {
  for (let r of reveals) {
    const top = r.getBoundingClientRect().top;
    if (top < window.innerHeight - 80) r.classList.add("visible");
  }
};
window.addEventListener("scroll", revealOnScroll);
revealOnScroll();


// CHART
const ctx = document.getElementById('impactGraph');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["2021","2022","2023","2024","2025"],
    datasets: [{
      label: "People Impacted",
      data: [450, 1200, 2400, 3800, 5200],
      borderWidth: 3,
      tension: 0.4
    }]
  }
});
