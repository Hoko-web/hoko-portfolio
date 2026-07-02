<?php
/**
 * 下部「他のWorks」セクション（共通パーツ）
 *
 * @param int|null $args['exclude_id'] 除外する投稿ID（single-works.phpで自分自身を除外用）
 */
$exclude_id  = $args['exclude_id'] ?? null;
$works_query = hoko_get_related_works( $exclude_id );
?>

<!-- ===================================== -->
<!-- Works -->
<!-- ===================================== -->
<section class="p-works" id="works">
  <div class="p-works__inner">
    <h2 class="c-eyebrow">Works</h2>
    <div class="p-works__wrapper">
      <ul class="p-works__list js-reveal">
        <?php if ( $works_query->have_posts() ) : ?>
          <?php while ( $works_query->have_posts() ) : ?>
            <?php
            $works_query->the_post();
            $categories = get_the_terms( get_the_ID(), 'works_category' );
            $tags       = get_the_terms( get_the_ID(), 'works_tag' );
            ?>
            <li class="p-works__item">
              <article class="p-works__card js-tilt">
                <a href="<?php the_permalink(); ?>" class="p-works__link">
                  <div class="p-works__thumb">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'large', [
                        'alt'      => esc_attr( get_the_title() . 'のモックアップ' ),
                        'loading'  => 'lazy',
                        'decoding' => 'async',
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
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </ul>

      <div class="p-works__action">
        
        <a href="<?php echo esc_url( home_url( '/works/' ) ); ?>" class="c-btn p-works__more">More</a>
        
      </div>
    </div>
  </div>
</section>
