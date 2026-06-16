/**
 * カスタムカーソル（遅れて追従する計測リング）
 * 全ページ共通
 */
(() => {
  const ring = document.querySelector(".js-cursor-ring");
  const dot = document.querySelector(".js-cursor-dot");
  if (!ring || !dot) return;

  const canHover = window.matchMedia("(hover: hover)").matches;
  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;
  if (!canHover || reduceMotion) return;

  let targetX = -100;
  let targetY = -100;
  let ringX = -100;
  let ringY = -100;

  document.addEventListener("mousemove", (e) => {
    targetX = e.clientX;
    targetY = e.clientY;
    dot.style.transform = `translate(${targetX}px, ${targetY}px)`;
  });

  document.querySelectorAll("a,button").forEach((el) => {
    el.addEventListener("mouseenter", () => ring.classList.add("is-hover"));
    el.addEventListener("mouseleave", () => ring.classList.remove("is-hover"));
  });

  const loop = () => {
    ringX += (targetX - ringX) * 0.18;
    ringY += (targetY - ringY) * 0.18;
    ring.style.transform = `translate(${ringX}px, ${ringY}px)`;
    requestAnimationFrame(loop);
  };
  loop();
})();
