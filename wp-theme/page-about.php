<?php get_header(); ?>

<!-- ===================================== -->
<!-- aboutページ -->
<!-- ===================================== -->
<main id="top">
  <section class="p-about p-about--page">
    <div class="p-about__inner">
      <div class="c-heading">
        <h1 class="c-heading__title">About Me</h1>
      </div>

      <div class="p-about__hero">
        <div class="p-about__photo">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'large', [
              'alt'            => 'Hokoの写真',
              'decoding'       => 'async',
              'fetchpriority'  => 'high',
            ] ); ?>
          <?php else : ?>
            <img
              src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about-image.png' ); ?>"
              alt="Hokoの写真"
              width="400"
              height="400"
              decoding="async"
              fetchpriority="high"
            />
          <?php endif; ?>
        </div>
        <div class="p-about__hero-body">
          <dl class="p-about__meta">
            <dt class="p-about__meta-label">Name</dt>
            <dd class="p-about__meta-value">
              鉾立 光将 (ほこたて ひろまさ)
            </dd>
            <dt class="p-about__meta-label">Born</dt>
            <dd class="p-about__meta-value">1995.7.23 / 愛知県新城市</dd>
            <dt class="p-about__meta-label">Hobby</dt>
            <dd class="p-about__meta-value">
              歌うこと / 車いじり / 運動全般
            </dd>
            <dt class="p-about__meta-label">Dream</dt>
            <dd class="p-about__meta-value">ポルシェを買う</dd>
          </dl>
        </div>
      </div>
      <div class="p-about__block">
        <div class="c-heading">
          <h2 class="c-heading__title">Profile</h2>
        </div>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
      </div>
      <div class="p-about__block">
        <div class="c-heading">
          <h2 class="c-heading__title">Personality</h2>
        </div>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
        <p class="p-about__description">
          テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります
        </p>
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
          お仕事のご相談・ご依頼、その他お問い合わせはこちらよりお気軽にご連絡ください。
        </p>

        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="c-btn p-contact__more">Contact</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>