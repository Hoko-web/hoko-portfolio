(() => {
  // Hamburger(sp) Drawer(sp)
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");

  if (hamburger && drawer) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("is-open");
      drawer.classList.toggle("is-open");

      const isOpen = hamburger.classList.contains("is-open");
      hamburger.setAttribute("aria-expanded", isOpen);
      hamburger.setAttribute(
        "aria-label",
        isOpen ? "メニューを閉じる" : "メニューを開く",
      );
    });

    // メニューと SNS のリンク：押したら閉じる
    const drawerLinks = drawer.querySelectorAll("a");
    drawerLinks.forEach((link) => {
      link.addEventListener("click", () => {
        hamburger.classList.remove("is-open");
        drawer.classList.remove("is-open");

        hamburger.setAttribute("aria-expanded", "false");
        hamburger.setAttribute("aria-label", "メニューを開く");
      });
    });

    // ドロワー背景：押したら閉じる
    drawer.addEventListener("click", (e) => {
      if (e.target === drawer) {
        hamburger.classList.remove("is-open");
        drawer.classList.remove("is-open");

        hamburger.setAttribute("aria-expanded", "false");
        hamburger.setAttribute("aria-label", "メニューを開く");
      }
    });
  }
})();
