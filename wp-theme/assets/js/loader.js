/**
 * ローディング画面の制御
 * 黒幕（is-loading)を、ロードが完了するまで表示し続け、0→９０→１００に動かす
 * 黒背景に白い粒子で「Hoko Portfolio」を描く（粒子はfv.jsと同じ）
 * 「黒幕を出すかださないか」の判定はheader.phpのブートが担当
 */
(() => {
  // documentElement　 = HTML要素（ルート要素）を一発で取得できるDOMプロパティ
  const root = document.documentElement;
  // <html>にis-loadingが、「付いていない」場合だけ、この中を実行　 （!←true・falseをひっくり返す）
  if (!root.classList.contains("is-loading")) {
    // もしhokoFVがあれば、そのスタートボタンを”flyin”で押す
    if (window.hokoFV) window.hokoFV.start("flyin");
    return;
  }

  const counter = document.querySelector(".js-loading-counter");
  const canvas = document.querySelector(".js-loading-canvas");
  const loadingEl = document.querySelector(".js-loading");
  const fvCanvas = document.querySelector(".js-fv-canvas");
  const ctx = canvas.getContext("2d");

  const MIN_DISPLAY = 1600; // 0~90%にかける時間。読み込み早くても見せる時間
  const CONVERGE = 1000; // 読み込み完了後、90~100%＆粒子の収束にかける時間
  const FADE_DUR = 700; // 黒→白の反転にかける時間
  const MAX_WAIT = 7000; // 何があってもここの時間で強制終了
  const MAX_PARTICLES = 4000; // 粒子の上限　fv.jsと同値
  const DOT_SIZE = 2; // 粒子の大きさ　 fv.jsと同値
  const EASE = 0.1; // 収束具合

  let viewW = 0;
  let viewH = 0;
  let particles = [];
  // 準備完了か？の材料。両方trueで完了になる
  let windowLoaded = false;
  let fontsReady = false;
  // ページ読み込み完了で、windowLoaded = true
  window.addEventListener("load", () => {
    windowLoaded = true;
  });

  // 画面に出さない“下書き用”canvasに文字を描き、ピクセルを走査して
  // 「文字がある場所」の座標だけ集める。これが粒子の目標位置になる。
  function samplePoints() {
    // 画面に追加しないトレース用の　canvasを生成、文字描画とピクセル走査に使う
    const off = document.createElement("canvas");
    //  fvCanvasがあれば、その幅を使う。なければviewWを使う. (三項演算子　条件　？ A : B)
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
  // canvasは「表示サイズ(CSS)」と「中身の解像度(width/height)」が別物。
  // 高解像度画面(Retinaなど)ではボケるので、dpr倍の解像度を持たせてscaleで辻褄を合わせる。
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
    // 継ぎ目対策の要：採取した座標をグローバルに置いてFVへ渡す。
    // FVは採取し直さず“同じ点”を使うので、ローディング画面とFVの粒子が完全一致する。
    const points = samplePoints();
    window.__hokoLogoPoints = points; // FV(assembled)へ同じ座標を渡して継ぎ目をゼロに
    particles = points.map((point) => ({
      x: Math.random() * viewW,
      y: Math.random() * viewH,
      goalX: point.x,
      goalY: point.y,
    }));
  }
  // activeCount をカウントに合わせて増やすと「粒子がだんだん増える」演出になる
  function draw(activeCount) {
    ctx.clearRect(0, 0, viewW, viewH);
    ctx.fillStyle = "#fff";
    // 先頭からN個だけ取り出したい = for文　　カウンタを0から開始、iがactiveCount未満の間だけ、１週ごとにiを＋１する
    for (let i = 0; i < activeCount; i++) {
      const p = particles[i];
      ctx.fillRect(p.x, p.y, DOT_SIZE, DOT_SIZE);
    }
  }
  // 準備できたら目標へイージング
  function update(ready) {
    if (!ready) return;
    particles.forEach((p) => {
      p.x += (p.goalX - p.x) * EASE;
      p.y += (p.goalY - p.y) * EASE;
    });
  }
  // lerpColor関数は、色Aから色Bへの「途中の色」を計算してくれる。t(0~1)で「どのくらいBに寄っているか」を指定する
  function lerpColor(from, to, t) {
    // from/to は [R,G,B] の配列。t=0でfrom、t=1でto、0.5でちょうど中間
    // 各成分を「始点 + 差分 × t」で計算（＝lerp/線形補間）。色は整数なのでroundで丸める
    const r = Math.round(from[0] + (to[0] - from[0]) * t);
    const g = Math.round(from[1] + (to[1] - from[1]) * t);
    const b = Math.round(from[2] + (to[2] - from[2]) * t);
    return `rgb(${r}, ${g}, ${b})`;
  }
  // フェードの一コマを描く（背景は黒→白、粒子は白→黒へ反転）
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
  // document.fonts.ready は「ページでまだ使ってないウェイト」までは待たない。
  // Hoko=800 / Portfolio=700 をここで明示的に読み込んでから取得することで、
  // “代替フォントの形”で焼き付くのを防ぐ（これを怠るとズレる原因に）。
  Promise.all([
    document.fonts.load('800 100px "Shippori Mincho"'),
    document.fonts.load('700 100px "Shippori Mincho"'),
  ]).then(() => {
    fontsReady = true;
    setupCanvas();
    createParticles();
  });
  // ローディング終了　＝　FVへ引き渡し
  function finish() {
    // 先にFVを「組み上がり済み(assembled)」で起動。黒幕の下で同じ絵を描かせておく
    if (window.hokoFV) window.hokoFV.start("assembled");
    // 黒幕をふわっと透かす。次フレームで opacityを変えるとCSSのtransitionが確実に発火する;
    requestAnimationFrame(() => {
      loadingEl.style.opacity = "0";
    });
    // 透け切ったら黒幕を消し、「もう見せた」印を残す（1セッション1回）
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
