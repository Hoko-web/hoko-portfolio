<?php
/**
 * Works 一覧ページ（カスタム投稿タイプ archive）
 */
?>
<?php get_header(); ?>

<main id="top">
  <section class="p-works p-works--archive">
    <div class="p-works__inner">
      <h1 class="c-eyebrow">All Works</h1>
      <div class="p-works__wrapper">
        <ul class="p-works__list js-reveal">
          <?php if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
              $categories = get_the_terms( get_the_ID(), 'works_category' );
              $tags       = get_the_terms( get_the_ID(), 'works_tag' );
          ?>
          <li class="p-works__item">
            <article class="p-works__card js-tilt">
              <a href="<?php the_permalink(); ?>" class="p-works__link">
                <div class="p-works__thumb">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', [
                      'alt'            => esc_attr( get_the_title() . 'のモックアップ' ),
                      'fetchpriority'  => 'high',
                      'decoding'       => 'async',
                    ] ); ?>
                  <?php endif; ?>
                </div>
                <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                  <p class="p-works__category"><?php echo esc_html( $categories[0]->name ); ?></p>
                <?php endif; ?>
                <h2 class="p-works__title"><?php the_title(); ?></h2>
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
          <?php 
          endwhile;
          endif; 
          ?>
        </ul>
        <?php hoko_pagination(); ?>
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