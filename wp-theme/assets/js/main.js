(() => {
  // Hamburger(sp) Drawer(sp)
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");

  if (hamburger && drawer) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("is-open");
      drawer.classList.toggle("is-open");
      document.body.classList.toggle("is-open");

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
        document.body.classList.remove("is-open");

        hamburger.setAttribute("aria-expanded", "false");
        hamburger.setAttribute("aria-label", "メニューを開く");
      });
    });

    // ドロワー背景：押したら閉じる
    drawer.addEventListener("click", (e) => {
      if (e.target === drawer) {
        hamburger.classList.remove("is-open");
        drawer.classList.remove("is-open");
        document.body.classList.remove("is-open");

        hamburger.setAttribute("aria-expanded", "false");
        hamburger.setAttribute("aria-label", "メニューを開く");
      }
    });
  }
})();

(() => {
  //Reveal: js-revealが画面中央あたりに来たらis-showをつける
  const targets = document.querySelectorAll(".js-reveal");
  if (!targets.length) return;

  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;
  if (reduceMotion) {
    targets.forEach((el) => el.classList.add("is-show"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-show");
        observer.unobserve(entry.target);
      });
    },
    { rootMargin: "0px 0px -45% 0px" },
  );

  targets.forEach((el) => observer.observe(el));
})();

(() => {
  // WorksCard　３Dチルト
  const cards = document.querySelectorAll(".js-tilt");
  if (!cards.length) return;

  const canHover = window.matchMedia("(hover: hover)").matches;
  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;
  if (!canHover || reduceMotion) return;

  const MAX = 15;

  cards.forEach((card) => {
    let rect = null;

    card.addEventListener("mouseenter", () => {
      rect = card.getBoundingClientRect();
      card.style.transition = "transform 0.1s ease";
    });

    card.addEventListener("mousemove", (e) => {
      if (!rect) return;
      const centerX = rect.left + rect.width / 2;
      const centerY = rect.top + rect.height / 2;
      const offsetX = e.clientX - centerX;
      const offsetY = e.clientY - centerY;
      const rotateY = (offsetX / (rect.width / 2)) * MAX;
      const rotateX = -(offsetY / (rect.height / 2)) * MAX;
      card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });

    card.addEventListener("mouseleave", () => {
      rect = null;
      card.style.transition = "transform 0.6s ease";
      card.style.transform = "rotateX(0deg) rotateY(0deg)";
    });
  });
})();

(() => {
  // Skillsエディタのタブ切り替え
  const tabs = [...document.querySelectorAll(".js-skill-tab")];
  if (!tabs.length) return;

  const panels = document.querySelectorAll(".p-skills__panel");

  const activate = (tab) => {
    const panel = document.getElementById(tab.dataset.target);
    if (!panel) return;

    tabs.forEach((t) => {
      t.classList.remove("is-active");
      t.setAttribute("aria-selected", "false");
      t.tabIndex = -1;
    });
    panels.forEach((p) => p.classList.remove("is-active"));

    tab.classList.add("is-active");
    tab.setAttribute("aria-selected", "true");
    tab.tabIndex = 0;
    panel.classList.add("is-active");
  };

  tabs.forEach((tab, i) => {
    tab.addEventListener("click", () => activate(tab));

    tab.addEventListener("keydown", (e) => {
      let next = null;
      if (e.key === "ArrowRight") next = tabs[(i + 1) % tabs.length];
      if (e.key === "ArrowLeft")
        next = tabs[(i - 1 + tabs.length) % tabs.length];
      if (e.key === "Home") next = tabs[0];
      if (e.key === "End") next = tabs[tabs.length - 1];
      if (!next) return;

      e.preventDefault();
      activate(next);
      next.focus();
    });
  });

  tabs.forEach((t) => {
    t.tabIndex = t.classList.contains("is-active") ? 0 : -1;
  });
})();
