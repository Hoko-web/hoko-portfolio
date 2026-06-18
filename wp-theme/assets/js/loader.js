/**
 * ローディング画面の制御
 * 黒幕（is-loading)を、ロードが完了するまで表示し続け、0→９０→１００に動かす
 * 黒背景に白い粒子で「Hoko Portfolio」を描く（粒子はfv.jsと同じサンプリング）
 * 「黒幕を出すかださないか」の判定はheader.phpのブートが担当
 */
(() => {
  const root = document.documentElement;
  if (!root.classList.contains("is-loading")) {
    if (window.hokoFV) window.hokoFV.start("flyin");
    return;
  }

  const counter = document.querySelector(".js-loading-counter");
  const canvas = document.querySelector(".js-loading-canvas");
  const loadingEl = document.querySelector(".js-loading");
  const fvCanvas = document.querySelector(".js-fv-canvas");
  const ctx = canvas.getContext("2d");

  const MIN_DISPLAY = 1600;
  const CONVERGE = 1000;
  const FADE_DUR = 700;
  const MAX_WAIT = 7000;
  const MAX_PARTICLES = 4000;
  const DOT_SIZE = 2;
  const EASE = 0.1;

  let viewW = 0;
  let viewH = 0;
  let particles = [];

  let windowLoaded = false;
  let fontsReady = false;

  window.addEventListener("load", () => {
    windowLoaded = true;
  });

  // 文字の形から、不透明なピクセルの座標配列を作って返す関数
  function samplePoints() {
    // 画面に追加しないトレース用の　canvasを生成、文字描画とピクセル走査に使う
    const off = document.createElement("canvas");
    // 解像度を表示用canvasと揃える
    off.width = fvCanvas ? fvCanvas.clientWidth : viewW;
    off.height = fvCanvas ? fvCanvas.clientHeight : viewH;
    const offCtx = off.getContext("2d");

    // 文字サイズと配列位置の計算
    const hokoSize = Math.min(off.width * 0.26, 300);
    const portfolioSize = hokoSize * 0.4;
    const centerX = off.width / 2;
    const hokoY = off.height * 0.4;
    const portfolioY = hokoY + hokoSize * 0.55;

    // トレース用canvasに文字を描画する
    offCtx.fillStyle = "#000";
    offCtx.textAlign = "center";
    offCtx.textBaseline = "middle";
    offCtx.font = `800 ${hokoSize}px "Shippori Mincho", serif`;
    offCtx.fillText("Hoko", centerX, hokoY);
    offCtx.font = `700 ${portfolioSize}px "Shippori Mincho", serif`;
    offCtx.fillText("Portfolio", centerX, portfolioY);

    // canvas全体のピクセル色情報を取得
    // dataは[R,G,B,A, R,G,B,A, ・・・]]の形で、４要素ごとに１ピクセルを表す１次元配列
    const data = offCtx.getImageData(0, 0, off.width, off.height).data;
    let step = 2;
    let points = [];

    do {
      step++;
      points = [];
      for (let y = 0; y < off.height; y += step) {
        for (let x = 0; x < off.width; x += step) {
          const alpha = data[(y * off.width + x) * 4 + 3];
          if (alpha > 80) {
            // 不透明度80超＝文字の中心部分。半透明な輪郭(アンチエイリアス)は除外
            points.push({ x, y });
          }
        }
      }
    } while (points.length > MAX_PARTICLES);
    return points;
  }

  function setupCanvas() {
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    viewW = canvas.clientWidth;
    viewH = canvas.clientHeight;
    canvas.width = viewW * dpr;
    canvas.height = viewH * dpr;
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.scale(dpr, dpr);
  }

  // 座標配列をもとに、全粒子の初期状態を作る関数
  function createParticles() {
    const points = samplePoints();
    window.__hokoLogoPoints = points; // FV(assembled)へ同じ座標を渡して継ぎ目をゼロに
    particles = points.map((point) => ({
      x: Math.random() * viewW,
      y: Math.random() * viewH,
      goalX: point.x,
      goalY: point.y,
    }));
  }
  // 全消去　→ 再描画
  function draw(activeCount) {
    ctx.clearRect(0, 0, viewW, viewH);
    ctx.fillStyle = "#fff";
    for (let i = 0; i < activeCount; i++) {
      const p = particles[i];
      ctx.fillRect(p.x, p.y, DOT_SIZE, DOT_SIZE);
    }
  }

  function update(ready) {
    if (!ready) return;
    particles.forEach((p) => {
      p.x += (p.goalX - p.x) * EASE;
      p.y += (p.goalY - p.y) * EASE;
    });
  }

  function lerpColor(from, to, t) {
    const r = Math.round(from[0] + (to[0] - from[0]) * t);
    const g = Math.round(from[1] + (to[1] - from[1]) * t);
    const b = Math.round(from[2] + (to[2] - from[2]) * t);
    return `rgb(${r}, ${g}, ${b})`;
  }

  function drawFade(t) {
    loadingEl.style.backgroundColor = lerpColor(
      [26, 26, 26],
      [255, 255, 255],
      t,
    );
    ctx.clearRect(0, 0, viewW, viewH);
    ctx.fillStyle = lerpColor([255, 255, 255], [26, 26, 26], t);
    particles.forEach((p) => {
      ctx.fillRect(p.x, p.y, DOT_SIZE, DOT_SIZE);
    });
    if (counter) counter.style.opacity = String(1 - t);
  }
  let fadeStart = null;

  Promise.all([
    document.fonts.load('800 100px "Shippori Mincho"'),
    document.fonts.load('700 100px "Shippori Mincho"'),
  ]).then(() => {
    fontsReady = true;
    setupCanvas();
    createParticles();
  });

  function finish() {
    if (window.hokoFV) window.hokoFV.start("assembled");

    requestAnimationFrame(() => {
      loadingEl.style.opacity = "0";
    });
    setTimeout(() => {
      root.classList.remove("is-loading");
      sessionStorage.setItem("loaderSeen", "1");
    }, 500);
  }

  let startTime = null;
  let readyTime = null;

  function tick(now) {
    if (startTime === null) startTime = now;

    if (fadeStart !== null) {
      const t = Math.min((now - fadeStart) / FADE_DUR, 1);
      drawFade(t);
      if (t >= 1) {
        finish();
        return;
      }

      requestAnimationFrame(tick);
      return;
    }

    const elapsed = now - startTime;

    const ready =
      (elapsed >= MIN_DISPLAY && windowLoaded && fontsReady) ||
      elapsed >= MAX_WAIT;

    let pct;
    if (!ready) {
      pct = Math.min(elapsed / MIN_DISPLAY, 1) * 90;
    } else {
      if (readyTime === null) readyTime = now;
      const t = Math.min((now - readyTime) / CONVERGE, 1);
      pct = 90 + t * 10;
    }

    if (counter) counter.textContent = `${Math.round(pct)}%`;

    const active = ready
      ? particles.length
      : Math.floor((pct / 90) * particles.length);
    update(ready);
    draw(active);

    if (ready && pct >= 100) {
      particles.forEach((p) => {
        p.x = p.goalX;
        p.y = p.goalY;
      });
      fadeStart = now;
    }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
