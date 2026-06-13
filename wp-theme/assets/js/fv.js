/**
 * FVパーティクル
 */
(() => {
  const canvas = document.querySelector(".js-fv-canvas");
  if (!canvas) return; // canvasが無いページでは何もしない

  const ctx = canvas.getContext("2d"); // canvasを使うときに呼ぶ（２D用）　ctxにして使い回す
  // 設置値
  const MAX_PARTICLES = 4000; // 粒子の上限
  const DOT_SIZE = 2; // 粒子の大きさ
  const COLOR = "#1a1a1a"; //色
  const EASE = 0.085; // イージング係数
  const MAX_DELAY = 900; // 出発遅延の最大。ばらけて飛んでくる演出
  const REACH = 110; // カーソルの影響が届く半径（px）
  const PUSH = 70; // カーソル反発の最大押し出し（px）

  // canvasは粒子の現在地を覚えない→データとしてもたせる用
  let particles = []; // 粒子に位置を配列データとして持たせる
  let startTime = null; // 開始時刻。経過時間（elapsed）の計算に使う
  let refId = null; // ループ稼働中か？null=停止中
  const mouse = { x: -9999, y: -9999 }; // カーソルの位置。初期値は画面外

  // カーソルが動いたら、その位置をmouseに書き込む
  window.addEventListener("mousemove", (e) => {
    const rect = canvas.getBoundingClientRect(); // canvasの画面上の位置を所得
    mouse.x = e.clientX - rect.left; // 「画面基準」を「canvas基準」に座標変換
    mouse.y = e.clientY - rect.top;
  });
  // カーソルが画面から出たら、影響0の位置に戻す
  document.addEventListener("mouseleave", () => {
    mouse.x = -9999;
    mouse.y = -9999;
  });

  // 文字の形から、不透明なピクセルの座標配列を作って返す関数
  function samplePoints() {
    // 画面に追加しないトレース用の　canvasを生成、文字描画とピクセル走査に使う
    const off = document.createElement("canvas");
    // 解像度を表示用canvasと揃える
    off.width = canvas.width;
    off.height = canvas.height;
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

  // 座標配列をもとに、全粒子の初期状態を作る関数
  function createParticles() {
    particles = samplePoints().map((point) => ({
      x: Math.random() * canvas.width, // 初期位置はランダム
      y: Math.random() * canvas.height, // 初期位置はランダム
      goalX: point.x, // 目標座標、初期化時に確定し、以降この値は変更しない
      goalY: point.y,
      delay: Math.random() * MAX_DELAY,
      scatterX: (Math.random() - 0.5) * canvas.width, // 散開方向X
      scatterY: (Math.random() - 0.5) * canvas.height,
    }));
  }

  // 各粒子の座標を目標へ近づける
  // elapsed= 開始からの経過時間ms.progress= スクロールによる散開度（0〜１）
  function update(elapsed, progress) {
    particles.forEach((p) => {
      if (elapsed <= p.delay) return; // 遅延時間に達していない粒子は動かさない
      // このフレームの実際の目標座標 ＝ 基準の目標 ＋ 散開方向×散開度
      // （progressが0なら基準の目標のまま）
      let goalX = p.goalX + p.scatterX * progress;
      let goalY = p.goalY + p.scatterY * progress;
      // カーソルと粒子の距離を計算
      const dx = p.x - mouse.x;
      const dy = p.y - mouse.y;
      const dist = Math.hypot(dx, dy);
      // 影響半径の内側にあるときだけ、目標をカーソルと反対方向へずらす（反発）
      if (dist > 0 && dist < REACH) {
        const force = (REACH - dist) / REACH;
        goalX += (dx / dist) * force * PUSH;
        goalY += (dy / dist) * force * PUSH;
      }
      p.x += (goalX - p.x) * EASE;
      p.y += (goalY - p.y) * EASE;
    });
  }

  // 全消去　→ 再描画
  function draw(progress) {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // 前フレームを消す
    ctx.globalAlpha = 1 - progress; // 3回が進むほど全体を透明に近づける
    ctx.fillStyle = COLOR;
    particles.forEach((p) => {
      ctx.fillRect(p.x, p.y, DOT_SIZE, DOT_SIZE); // 現在の座標に粒子を描画
    });
  }

  // フレームループ本体 requestAnimationFrameから毎フレーム呼ばれる

  function tick(now) {
    if (startTime === null) startTime = now;

    const progress = Math.min(window.scrollY / (window.innerHeight * 0.85), 1);

    update(now - startTime, progress);
    draw(progress);
    refId = requestAnimationFrame(tick);
  }

  // 画面内にあるときだけ動かす（パフォーマンス対策）
  const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
      if (refId === null) refId = requestAnimationFrame(tick);
    } else {
      cancelAnimationFrame(refId);
      refId = null;
    }
  });

  // 初期化。load後フォント読み込み後に実行される開始処理
  function init() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
    createParticles();
    canvas.closest(".p-fv").classList.add("is-active");
    observer.observe(canvas);
  }
  // リサイズ対応
  let lastWidth = window.innerWidth;
  let resizeTimer = null;

  window.addEventListener("resize", () => {
    if (window.innerWidth === lastWidth) return;
    lastWidth = window.innerWidth;
    // デバウンス
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      startTime = null;
      init();
    }, 200);
  });

  window.addEventListener("load", () => {
    // フォント読み込み完了を待ってからinit（待たないと別フォントの形で座標が確定してしまう）
    document.fonts.ready.then(init);
  });
})();
