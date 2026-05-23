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
              車いじり / 運動全般 / 歌うこと
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
          高校卒業後の12年間は、工場設備の保全（8年）と自動車整備士（4年）として、Webとは無縁の現場に身を置いてきました。整備士時代に体へ染み込んだのは、「ボルト1本の締め忘れが、時速100kmで走る車では人の命に関わる」という責任の重さです。おかしいと感じたら、手間を惜しまず確かめ直す。その姿勢は、PCに向き合う今も変わりません。設備保全の仕事では、製造ラインが故障で止まるほど損失がふくらんでいくなか、夜勤や緊急対応に追われていました。担当の方から状況を聞き出し、仮説を立てて原因を突き止め、一刻も早く設備を復旧させる。そして、同じ故障を繰り返さないところまで手を入れる。正確に、速く。その仕事の流儀を、この12年で身につけてきました。
        </p>
        <p class="p-about__description">
          そんな自分が、何か心から打ち込めるものを探して、ようやく出会ったのがWeb制作でした。自分の書いたものがそのまま形になる面白さに引き込まれ、時間を忘れて没頭し、飽きずに手を動かし続けています。お客さまと接するなかで感じた「自分の伝えたことで、誰かの役に立てる」という手応えを、今度はものづくりの形で届けたい。そう思えたことが、本気で取り組もうと決めた理由です。AIが当たり前になるこれからの時代、技術を磨き続けなければ通用しないことも理解しています。それでも、前職で培った仕事への向き合い方を支えに、一つひとつ確実に積み上げ、関わる方に「任せてよかった」と思ってもらえる仕事を、誠実に続けていきます。
        </p>
      </div>
      <div class="p-about__block">
        <div class="c-heading">
          <h2 class="c-heading__title">Personality</h2>
        </div>
        <p class="p-about__description">
          「目の前の人を、いちばん良い方へ」これが、私が一番大事にしている考え方です。自分の意見を押し付けるのではなく、相手が何を求め、どう感じているかをまず汲み取る。そのうえで、損得を抜きにして、その人にとって本当に良い方を、まっすぐ伝えたい。前職でも、目先の売上より「このお客さんにとって本当に良い選び方」を正直に伝えることを大事にしていました。それが、相手との信頼につながると考えているからです。技術も知識も、誰かの役に立ってこそ意味がある。その姿勢は、Web制作でも変わりません。
        </p>
        <p class="p-about__description">
          前職は、自分の判断で動くことと、確認を怠らないことの両方が求められる現場でした。もともと引っかかったことを放っておけない性分なので、まず自分で納得いくまで調べ、それでも判断しきれないところだけ確認して進めます。自分で考え抜くことと、引き際を見極めること。その感覚を、時間をかけて養ってきました。この性分は、新しいことを学ぶときも同じです。昔から車でも機械でも、仕組みを知りたくて分解したくなる質で、知らない技術やツールも、教わるのを待たずに自分でいじってみたくなる。新しいものを取り入れていくこと自体を、単純に面白いと感じています。
        </p>
        <p class="p-about__description">
          ずば抜けた才能があるわけではありません。それでも、目の前の人に誠実に向き合うことだけは、これからも貫いていきます。
        </p>
      </div>
    </div>
  </section>
  
  <section class="p-works" id="works">
    <div class="p-works__inner">

      <div class="c-heading">
        <h2 class="c-heading__title">Works</h2>
      </div>

      <div class="p-works__wrapper">
        <ul class="p-works__list">

          <?php
          $works_query = new WP_Query( [
            'post_type'      => 'works',
            'posts_per_page' => 4,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
          ] );

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