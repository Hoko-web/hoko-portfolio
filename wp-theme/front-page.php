<?php
/**
 * トップページ（1ページLP構成）
 */
?>
<?php get_header(); ?>

<main id="top">
  <!-- ===================================== -->
  <!-- FV -->
  <!-- ===================================== -->
  <section class="p-fv">
    <div class="p-fv__inner">

      <div class="p-fv__wrapper">
        <p class="p-fv__logo">Hoko</p>
        <p class="p-fv__text">Portfolio</p>
        <h1 class="p-fv__catch">
          職人気質で、<br class="u-sp" />細部まで丁寧に。
        </h1>
        <p class="p-fv__sub">
          マルチデバイス対応、表示速度、保守性<br />
          見えない部分まで手を抜かず、<br class="u-sp" />意図通りに仕上げます。
        </p>
      </div>
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

      <div class="c-heading">
        <h2 class="c-heading__title">About</h2>
      </div>

      <div class="p-about__profile">
        <div class="p-about__photo">
          <img
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about-image.png' ); ?>"
            alt="Hokoの写真"
            width="400"
            height="400"
            loading="lazy"
            decoding="async"
          />
        </div>
        <div class="p-about__intro">
          <h3 class="p-about__name-en">Hiromasa Hokotate</h3>
          <p class="p-about__text">
            自動車整備士と設備保全の現場で、長年『見えない不具合』を探し続けてきました。0.01mmのズレ、わずかな音の違和感、小さな配線の異常。それらを見逃さない目と感覚を、Web制作に活かしています。
          </p>
          <p class="p-about__text">
            『約束した期日を守る』『進捗をこまめに共有する』。当たり前のことかもしれませんが、自分が逆の立場だったらして欲しいことを、当たり前に貫きます。
          </p>

          <div class="p-about__action">
            <div class="c-arrows c-arrows--left" aria-hidden="true">
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
            </div>
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="c-btn p-about__more">More</a>
            <div class="c-arrows c-arrows--right" aria-hidden="true">
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
              <img
                src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>"
                alt=""
                class="c-arrows__item"
              />
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- ===================================== -->
  <!-- Works -->
  <!-- ===================================== -->
  <section class="p-works" id="works">
    <div class="p-works__inner">

      <div class="c-heading">
        <h2 class="c-heading__title">Works</h2>
      </div>

      <div class="p-works__wrapper">
        <ul class="p-works__list">

          <?php
          $works_query = hoko_get_related_works();

          if ( $works_query->have_posts() ) :
            while ( $works_query->have_posts() ) :
              $works_query->the_post();
              $categories = get_the_terms( get_the_ID(), 'works_category' );
              $tags       = get_the_terms( get_the_ID(), 'works_tag' );
          ?>

          <li class="p-works__item">
            <article class="p-works__card">
              <a
                href="<?php the_permalink(); ?>"
                class="p-works__link"
              >
                <div class="p-works__thumb">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', [
                      'alt'     => esc_attr( get_the_title() . 'のモックアップ' ),
                      'loading' => 'lazy',
                      'decoding'=> 'async',
                    ] ); ?>
                  <?php endif; ?>  
                </div>
                <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                  <p class="p-works__category"><?php echo esc_html( $categories[0]->name ); ?></p>
                <?php endif; ?>  
                <h3 class="p-works__title"><?php the_title(); ?></h3>
                <?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
                  <ul class="p-works__tags">
                    <?php foreach ( $tags as $tag ) : ?>
                      <li class="p-works__tag"><?php echo esc_html( $tag->name ); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </a>
            </article>
          </li>
        <?php endwhile; wp_reset_postdata(); endif; ?>
        </ul>

        <div class="p-works__action">
          <div class="c-arrows c-arrows--left" aria-hidden="true">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
          </div>
          <a href="<?php echo esc_url( home_url( '/works/' ) ); ?>" class="c-btn p-works__more">More</a>
          <div class="c-arrows c-arrows--right" aria-hidden="true">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/more-arrow.svg' ); ?>" alt="" class="c-arrows__item" />
          </div>
        </div>
      </div>
    </div>
  </section>
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

        <div class="p-skills__marquee" aria-hidden="true">
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
  </section>
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
