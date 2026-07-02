<?php
/**
 * トップページ（1ページLP構成）
 */
?>
<?php get_header(); ?>

<!-- ===================================== -->
<!-- Loading（一回だけ） sessionStorage.clear()でリセット-->
<!-- ===================================== -->
<div class="p-loading js-loading" aria-hidden="true">
  <canvas class="p-loading__canvas js-loading-canvas"></canvas>
  <span class="p-loading__counter js-loading-counter">0%</span>
</div>

<main id="top">
  <!-- ===================================== -->
  <!-- FV -->
  <!-- ===================================== -->
  <section class="p-fv">
    <canvas class="p-fv__canvas js-fv-canvas" aria-hidden="true"></canvas>
    <div class="p-fv__inner">
      <h1 class="u-visually-hidden">鉾立光将（ほこたてひろまさ）のポートフォリオサイト
      </h1>
      <div class="p-fv__scroll">
        <span class="p-fv__scroll-text">Scroll</span>
        <span class="p-fv__scroll-line"></span>
      </div>
    </div>
  </section>
  <!-- ===================================== -->
  <!-- About -->
  <!-- ===================================== -->
  <section class="p-about" id="about">
    <div class="p-about__inner">
      <div class="p-about__layout js-reveal">
        <div class="p-about__visual">
          <div class="p-about__photo">
            <div class="p-about__photo-inner">
              <img
              src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/Hoko-image.webp' ); ?>"
              alt="ほこたてひろまさの写真"
              width="1044"
              height="1567"
              loading="lazy"
              decoding="async"
            />
            </div>
          </div>
          <p class="p-about__copy-sp">
            <span class="p-about__copy-inner">
              <span class="p-about__line"><span>想いを引き出し</span></span>
              <span class="p-about__line"><span>期待を超える提案を</span></span>
            </span>
          </p>
        </div>
        <div class="p-about__body">
          <p class="p-about__copy-pc">
            <span class="p-about__line"><span>想いを引き出し</span></span>
            <span class="p-about__line"><span>期待を超える提案を</span></span>
          </p>
          <h2 class="c-eyebrow p-about__eyebrow">About Me</h2>
          <p class="p-about__name">鉾立 光将<span>Hokotate Hiromasa</span></p>
          <p class="p-about__text">
            「うまく形にできずにいた想い」を引き出せたときが、私にとって一番うれしい瞬間です。 <br>その想いにもっと自由に応えたい。そんな気持ちで、毎日コードと向き合っています。
          </p>
          <div class="p-about__action">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="c-btn">More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===================================== -->
  <!-- Works -->
  <!-- ===================================== -->
  <?php get_template_part( 'template-parts/section-works' ); ?>
  <!-- ===================================== -->
  <!-- Skills -->
  <!-- ===================================== -->
  <section class="p-skills" id="skills">
    <div class="p-skills__inner">
      <h2 class="c-eyebrow">Skills</h2>
      <p class="p-skills__hint">// click a tab to read the code</p>
      <div class="p-skills__editor">
        <!-- Tab -->
        <div class="p-skills__tabs" role="tablist" aria-label="スキル">
          <button type="button" class="p-skills__tab js-skill-tab" role="tab" aria-selected="false" aria-controls="s-html">index.html</button>
          <button type="button" class="p-skills__tab js-skill-tab" role="tab" aria-selected="false" aria-controls="s-scss">style.scss</button>
          <button type="button" class="p-skills__tab js-skill-tab" role="tab" aria-selected="false" aria-controls="s-base">_base.scss</button>
          <button type="button" class="p-skills__tab js-skill-tab is-active" role="tab" aria-selected="true" aria-controls="s-main">main.js</button>
          <button type="button" class="p-skills__tab js-skill-tab" role="tab" aria-selected="false" aria-controls="s-functions">functions.php</button>
          <button type="button" class="p-skills__tab js-skill-tab" role="tab" aria-selected="false" aria-controls="s-git">git log</button>
        </div>
        <div class="p-skills__panels">
          <!-- JSのタブパネル -->
          <div class="p-skills__panel is-active" id="s-main" role="tabpanel">
            <!-- インデントが実際の表示に影響するので注意 -->
            <pre class="p-skills__code"><code>(() => {
  const hamburger = document.querySelector(".js-hamburger");
  const drawer = document.querySelector(".js-drawer");
  if (!hamburger || !drawer) return; <span class="p-skills__comment">// 要素が無ければ抜ける（nullチェック）</span>

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("is-open");
    drawer.classList.toggle("is-open");

    <span class="p-skills__comment">// 開閉に合わせて状態・ラベルも同期（a11y）</span>
    const isOpen = hamburger.classList.contains("is-open");
    hamburger.setAttribute("aria-expanded", isOpen);
    hamburger.setAttribute("aria-label", isOpen ? "メニューを閉じる" : "メニューを開く");
  });
})();</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">IIFE（スコープ隔離）</li>
              <li class="p-skills__chip">null チェック</li>
              <li class="p-skills__chip">aria 同期（a11y）</li>
            </ul>
          </div>
          <!-- HTMLのパネル -->
          <div class="p-skills__panel" id="s-html" role="tabpanel">
            <pre class="p-skills__code"><code>&lt;header class="p-header"&gt;
  <span class="p-skills__comment">&lt;!-- 開閉状態を aria で明示（JSで true/false を切替） --&gt;</span>
  &lt;button type="button" class="js-hamburger"
  aria-label="メニューを開く" aria-expanded="false"&gt;&lt;/button&gt;
&lt;/header&gt;

&lt;main&gt;
  &lt;h1 class="u-visually-hidden"&gt;Hoko Portfolio&lt;/h1&gt; <span class="p-skills__comment">&lt;!-- h1は1ページ1つ --&gt;</span>
  &lt;section id="about"&gt;
    &lt;h2&gt;About&lt;/h2&gt; <span class="p-skills__comment">&lt;!-- 見出しは大→小で飛ばさない --&gt;</span>
    <span class="p-skills__comment">&lt;!-- CLSは width/height、LCPは主役画像のfetchpriority high（lazyにしない） --&gt;</span>
    &lt;img src="about.webp" alt="鉾立光将の作業風景"
        width="1044" 
        height="1567"
        fetchpriority="high" 
        decoding="async"&gt;
  &lt;/section&gt;

  &lt;section id="works"&gt;
    &lt;h2&gt;Works&lt;/h2&gt;
    <span class="p-skills__comment">&lt;!-- 折り返しより下の画像はloading lazyで遅延読み込み＝初期表示を軽く --&gt;</span>
    &lt;img src="daymaga.webp" alt="daymagaのトップ画面"
        width="800" height="500"
        loading="lazy" 
        decoding="async"&gt;
    <span class="p-skills__comment">&lt;!-- 外部リンクは別タブで開く noopenerで乗っ取り防止、noreferrerで参照元を渡さない --&gt;</span>
    &lt;a href="https://github.com/Hoko-web" 
        target="_blank" 
        rel="noopener noreferrer"&gt;GitHub&lt;/a&gt;
  &lt;/section&gt;
&lt;/main&gt;</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">セマンティックなHTML</li>
              <li class="p-skills__chip">見出し階層を意識</li>
              <li class="p-skills__chip">ariaでアクセシビリティ対応</li>
              <li class="p-skills__chip">CLS/LCP対策</li>
              <li class="p-skills__chip">外部リンクを安全に noopener / noreferrer</li>
            </ul>
          </div>
          <!-- SCSSのパネル -->
          <div class="p-skills__panel" id="s-scss" role="tabpanel">
            <pre class="p-skills__code"><code>@use "../../foundation/variable" as *;
@use "../../foundation/mixin" as *;

<span class="p-skills__comment">// =====================================</span>
<span class="p-skills__comment">// Card</span>
<span class="p-skills__comment">// =====================================</span>
.c-card { 
  position: relative; <span class="p-skills__comment">// プロパティ順は「npm run lint:scss:fix」 で自動整列</span>
  display: flex;
  padding: 16px;
  background: #fff;
  border-radius: 8px;
  opacity: 0;
  transform: translateY(16px);
  transition: opacity 0.6s ease, transform 0.6s ease; 

  @include mq(pc) { <span class="p-skills__comment">// モバイルファースト</span>
    padding: 24px;
  }
  .is-show &amp; {
    opacity: 1;
    transform: translateY(0);
  }
}

.c-card__title {
  font-size: 16px;
  color: $color-text-main; <span class="p-skills__comment">// 変数で一元管理</span>
}

@media (hover: hover) { <span class="p-skills__comment">// hoverできる端末だけ</span>
  .c-card:hover {
    transform: translateY(-4px);
  }
}</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">FLOCSSで設計</li>
              <li class="p-skills__chip">BEMで命名</li>
              <li class="p-skills__chip">変数管理</li>
            </ul>
          </div>
          <!-- BASEのパネル -->
          <div class="p-skills__panel" id="s-base" role="tabpanel">
            <pre class="p-skills__code"><code><span class="p-skills__comment">// 「視差を減らす」設定の人にはアニメーションを無効化（a11y）</span>
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    scroll-behavior: auto !important; <span class="p-skills__comment">// スムーススクロールを切る</span>
    animation-duration: 0.01ms !important; <span class="p-skills__comment">// アニメーションを一瞬で終わらせる（完了イベントは保つため、0ではなく0.01）</span>
    transition-duration: 0.01ms !important; 
    animation-iteration-count: 1 !important; <span class="p-skills__comment">// 無限ループも1回で止める</span>
  }
}</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">reduced-motion対応</li>
              <li class="p-skills__chip">matchMediaでJSも静止（canvas等）</li>
              <li class="p-skills__chip">!important は例外運用</li>
            </ul>
          </div>
          <!-- FUNCTIONのパネル -->
          <div class="p-skills__panel" id="s-functions" role="tabpanel">
            <pre class="p-skills__code"><code>function hoko_enqueue_assets() {
  wp_enqueue_script( 'hoko-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true );
  wp_script_add_data( 'hoko-main', 'strategy', 'defer' ); <span class="p-skills__comment">// defer で描画を止めない</span>

  <span class="p-skills__comment">// FVの粒子はトップだけ読む,他ページで読み込ませない</span>
  if ( is_front_page() ) {
    wp_enqueue_script( 'hoko-fv', get_template_directory_uri() . '/assets/js/fv.js', [], '1.0.0', true );
    wp_script_add_data( 'hoko-fv', 'strategy', 'defer' );
  }
}
add_action( 'wp_enqueue_scripts', 'hoko_enqueue_assets' );

<span class="p-skills__comment">// CPT「制作実績」＋タクソノミー</span>
register_post_type( 'works', [
  'label'        => '制作実績',
  'public'       => true,
  'has_archive'  => true,
  'supports'     => [ 'title', 'thumbnail', 'editor' ],
  'show_in_rest' => true,
] );</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">条件分岐で必要なJSだけ読込</li>
              <li class="p-skills__chip">defer（描画を止めない）</li>
              <li class="p-skills__chip">CPT・タクソノミー</li>
            </ul>
          </div>
          <!-- GITのパネル -->
          <div class="p-skills__panel" id="s-git" role="tabpanel">
            <pre class="p-skills__code"><code>
feat(about):    対角レイアウトに刷新（写真bleed・コピー重ね）
feat(skills):   コードを見せるエディタ風UIに刷新
perf(theme):    Contact以外でCF7のJSを読み込まない
fix(cursor):    reduced-motion時は標準カーソルに戻す
refactor(fv):   冗長な draw(0) を削除</code></pre>
            <ul class="p-skills__chips">
              <li class="p-skills__chip">Conventional Commitsで運用</li>
              <li class="p-skills__chip">1コミット1目的</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===================================== -->
  <!-- Contact -->
  <!-- ===================================== -->
  <section class="p-contact" id="contact">
    <div class="p-contact__inner">
      <h2 class="c-eyebrow">Contact</h2>
      <div class="p-contact__wrapper">
        <p class="p-contact__text">
          ご相談・お問い合わせは、内容を問わずお気軽にご連絡ください。
        </p>
        <div class="p-contact__action">
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="c-btn">Contact</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>