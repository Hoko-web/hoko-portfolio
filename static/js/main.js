// Hamburger(sp) Drawer(sp)
const hamburger = document.querySelector(".js-hamburger");
const drawer = document.querySelector(".js-drawer");

if (hamburger && drawer) {
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("is-open");
    drawer.classList.toggle("is-open");
  });
}
