/**
 * ローディング画面の制御
 * 黒幕（is-loading)を、ロードが完了するまで表示し続け、ロードが終わったら外す
 * 「黒幕を出すかださないか」の判定はheader.phpのブートが担当
 */
(() => {
  const root = document.documentElement;
  if (!root.classList.contains("is-loading")) return;

  const MIN_DISPLAY = 1600;
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
  function tick(now) {
    if (startTime === null) startTime = now;
    const elapsed = now - startTime;

    const ready = elapsed >= MIN_DISPLAY && windowLoaded && fontsReady;
    if (ready || elapsed >= MAX_WAIT) {
      finish();
      return;
    }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
