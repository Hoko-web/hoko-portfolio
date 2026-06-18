/**
 * ローディング画面の制御
 * 黒幕（is-loading)を、ロードが完了するまで表示し続け、0→９０→１００に動かす
 * 「黒幕を出すかださないか」の判定はheader.phpのブートが担当
 */
(() => {
  const root = document.documentElement;
  if (!root.classList.contains("is-loading")) return;

  const counter = document.querySelector(".js-loading-counter");

  const MIN_DISPLAY = 1600;
  const SPRINT = 400;
  const MAX_WAIT = 7000;

  let windowLoaded = false;
  let fontsReady = false;

  window.addEventListener("load", () => {
    windowLoaded = true;
  });
  document.fonts.ready.then(() => {
    fontsReady = true;
  });

  function finish() {
    root.classList.remove("is-loading");
    sessionStorage.setItem("loaderSeen", "1");
  }

  let startTime = null;
  let readyTime = null;

  function tick(now) {
    if (startTime === null) startTime = now;
    const elapsed = now - startTime;

    const ready =
      (elapsed >= MIN_DISPLAY && windowLoaded && fontsReady) ||
      elapsed >= MAX_WAIT;

    let pct;
    if (!ready) {
      pct = Math.min(elapsed / MIN_DISPLAY, 1) * 90;
    } else {
      if (readyTime === null) readyTime = now;
      const t = Math.min((now - readyTime) / SPRINT, 1);
      pct = 90 + t * 10;
    }

    if (counter) counter.textContent = `${Math.round(pct)}%`;

    if (ready && pct >= 100) {
      finish();
      return;
    }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
