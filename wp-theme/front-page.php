<?php
/**
 * トップページ（1ページLP構成）
 */
?>
<?php get_header(); ?>

<!-- ===================================== -->
<!-- Loading -->
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
          <h2 class="p-about__eyebrow">About Me</h2>
          
          <p class="p-about__name">鉾立 光将<span>Hokotate Hiromasa</span></p>
          <p class="p-about__text">
            相手も気づいていなかった「こうしたい」を引き出せたときが、私にとって一番うれしい瞬間です。その想いにもっと自由に応えたい。そんな気持ちで、毎日コードと向き合っています。
          </p>
          <div class="p-about__action">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="c-btn p-about__more">More</a>
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
      <div class="c-heading c-heading--no-line">
        <h2 class="c-heading__title">Skills</h2>
      </div>
      <div class="p-skills__wrapper">
        <ul class="p-skills__list">
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">HTML</h3>
            <p class="p-skills__item-text">
              セマンティックなタグ選び、見出し階層、ARIA属性。SEOとアクセシビリティの両面を意識し、構造の崩れないHTMLを書きます。
            </p>
          </li>
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">SCSS / CSS</h3>
            <p class="p-skills__item-text">
              FLOCSS +
              BEM設計、変数活用、ネストの管理。保守性と可読性の両面を意識し、修正しやすいスタイルシートを書きます。
            </p>
          </li>
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">JavaScript</h3>
            <p class="p-skills__item-text">
              バニラJS、スコープ管理、過剰なライブラリの回避。可読性とパフォーマンスの両面を意識し、軽量で保守しやすいコードを書きます。
            </p>
          </li>
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">
              Responsive<span class="p-skills__item-sub"
                >レスポンシブ対応</span
              >
            </h3>
            <p class="p-skills__item-text">
              モバイルファースト設計、複数段階のブレイクポイント、各実機での表示確認。可読性と保守性の両面を意識し、どの幅でも崩れないレイアウトを組みます。
            </p>
          </li>
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">
              Accessibility<span class="p-skills__item-sub"
                >アクセシビリティ</span
              >
            </h3>
            <p class="p-skills__item-text">
              alt属性、aria属性、見出し階層の管理。スクリーンリーダーとキーボード操作の両面を意識し、多くの利用者に届くサイトを仕上げます。
            </p>
          </li>
          <li class="p-skills__item">
            <h3 class="p-skills__item-title">Git / GitHub</h3>
            <p class="p-skills__item-text">
              基本的なブランチ運用、コミットメッセージの粒度、変更履歴の整理。協業のしやすさを意識し、後から見ても分かりやすいGit運用を心がけます。
            </p>
          </li>
        </ul>

        <!-- <div class="p-skills__marquee" aria-hidden="true">
          <ul class="p-skills__marquee-list">
            <li>HTML</li>
            <li>SCSS</li>
            <li>JavaScript</li>
            <li>jQuery</li>
            <li>PHP</li>
            <li>WordPress</li>
            <li>Git</li>
            <li>GitHub</li>
          </ul>
          <ul class="p-skills__marquee-list" aria-hidden="true">
            <li>HTML</li>
            <li>SCSS</li>
            <li>JavaScript</li>
            <li>jQuery</li>
            <li>PHP</li>
            <li>WordPress</li>
            <li>Git</li>
            <li>GitHub</li>
          </ul>
          <ul class="p-skills__marquee-list" aria-hidden="true">
            <li>HTML</li>
            <li>SCSS</li>
            <li>JavaScript</li>
            <li>jQuery</li>
            <li>PHP</li>
            <li>WordPress</li>
            <li>Git</li>
            <li>GitHub</li>
          </ul>
        </div>
      </div>
    </div>
  </section> -->
  <!-- ===================================== -->
  <!-- Contact -->
  <!-- ===================================== -->
  <section class="p-contact" id="contact">
    <div class="p-contact__inner">
      <div class="c-heading">
        <h2 class="c-heading__title">Contact</h2>
      </div>

      <div class="p-contact__wrapper">
        <p class="p-contact__text">
          ご相談・お問い合わせは、内容を問わずお気軽にご連絡ください。
        </p>

        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="c-btn p-contact__more">Contact</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
