<?php
/**
 * Thanks ページ（送信完了）
 */
?>
<?php get_header(); ?>

<main id="top">
  <!-- ===================================== -->
  <!-- Thanks -->
  <!-- ===================================== -->
  <section class="p-thanks">
    <div class="p-thanks__inner">
      <h1 class="p-thanks__title">Thank You!</h1>
      <div class="p-thanks__note">
        <p>24時間以内にご返信させていただきます。</p>
        <p>
          返信がない場合は、お手数ですが迷惑メールフォルダをご確認ください。
        </p>
      </div>

      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-btn p-thanks__back">Back To Home</a>
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
</main>

<?php get_footer(); ?>