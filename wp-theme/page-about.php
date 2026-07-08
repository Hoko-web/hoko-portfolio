<?php
/**
 * About-detail ページ
 */
?>
<?php get_header(); ?>

<main id="top">
  <section class="p-about-detail">
    <div class="p-about-detail__inner">
      <h1 class="c-eyebrow">About Me</h1>
      <div class="p-about-detail__hero js-reveal">
        <div class="p-about-detail__hero-body">
          <div class="p-about-detail__meta">
            <div class="p-about-detail__meta-lead">
              <p>設備保全エンジニアを8年、自動車整備士を4年経験してきました。</p>
              <p>「その人が本当に求めていることを引き出し、全力で応える」ことを大切にし、ご満足いただけたときの「ありがとう」が何よりのやりがいでした。</p>
              <p>今度はWeb制作で、その「ありがとう」をいただけるよう、日々スキルを磨いています。</p>
            </div>
            <p class="p-about-detail__meta-born">Born：1995.7.23 / 愛知県新城市出身</p>
            <p class="p-about-detail__meta-hobby">Hobby：車いじり / 野球 / カラオケ / F1観戦 etc</p>
          </div>
        </div>
        <div class="p-about-detail__photo">
          <div class="p-about-detail__photo-inner">
            <img
              src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/Hoko-image.webp' ); ?>"
              alt="Hokoの写真"
              width="800"
              height="800"
              decoding="async"
              fetchpriority="high"
            />
          </div>
          <p class="p-about-detail__photo-name">鉾立 光将</p>
          <p class="p-about-detail__photo-name-en">Hokotate Hiromasa</p>
        </div>
      </div>

      <div class="p-about-detail__blocks">
        <div class="p-about-detail__block">
          <h2 class="c-eyebrow c-eyebrow--sm">「要望を引き出し、応える力」</h2>
          <p class="p-about-detail__description">
            相手が、本当に<span class="p-about-detail__strong">求めている</span>ことを引き出し、<span class="p-about-detail__strong">応えられる</span>ことが私の強みです。 <br><span class="p-about-detail__strong">整備士</span>時代は、お客様の困りごとを<span class="p-about-detail__strong">些細</span>なことでも丁寧に<span class="p-about-detail__strong">汲み取る</span>ことを大切にしていました。 <br>話しやすい<span class="p-about-detail__strong">雰囲気</span>をつくり、お客様自身が忘れていた<span class="p-about-detail__strong">要望</span>や潜在的な<span class="p-about-detail__strong">不安</span>まで引き出すことを意識した結果、顧客アンケートで<span class="p-about-detail__strong p-about-detail__strong--box">全社1位</span>や、その年の<span class="p-about-detail__strong p-about-detail__strong--box">MVP</span>を獲得できました。
          </p>
        </div>
        <div class="p-about-detail__block">
          <h2 class="c-eyebrow c-eyebrow--sm">「なぜWeb制作か」</h2>
          <p class="p-about-detail__description">
            その人の<span class="p-about-detail__strong">「こうしたい」</span>に、より<span class="p-about-detail__strong">深く</span>応えられるものづくりがしたい。 <br>それがWeb制作を選んだ<span class="p-about-detail__strong">理由</span>です。 <br>保全エンジニアとして8年、故障の原因を突き止め処置する中で、細部に<span class="p-about-detail__strong">妥協しない</span>姿勢が身につきました。 <br>整備士として4年、お客様と向き合う中で、本当の要望を引き出し、<span class="p-about-detail__strong">全力で応える</span>、 <br>その結果<span class="p-about-detail__strong">「ありがとう」</span>と言ってもらえる瞬間が何よりの<span class="p-about-detail__strong">やりがい</span>だと気づきました。 <br>ただ、車の構造や規定という超えられない枠があり、想いに応えきれない時、<span class="p-about-detail__strong">もどかしさ</span>を感じていました。 <br>そんな中で出会ったWeb制作は、想いをより<span class="p-about-detail__strong p-about-detail__strong--box">自由</span>に形にできて、何より<span class="p-about-detail__strong p-about-detail__strong--box">夢中</span>になれました。  <br>場所は変わっても、「ものづくりで誰かの役に立ちたい」という<span class="p-about-detail__strong p-about-detail__strong--box">想い</span>は変わりません。
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- ===================================== -->
  <!-- Works -->
  <!-- ===================================== -->
  <?php get_template_part( 'template-parts/section-works' ); ?>
  <!-- ===================================== -->
  <!-- Contact -->
  <!-- ===================================== -->
  <?php get_template_part( 'template-parts/section-contact' ); ?>
</main>

<?php get_footer(); ?>