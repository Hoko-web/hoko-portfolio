<?php
/**
 * Works 個別ページ
 */
?>
<?php get_header(); ?>

<main id="top">
  <!-- ===================================== -->
  <!-- Works Detail -->
  <!-- ===================================== -->
  <section class="p-works-detail">

    <?php if ( have_posts() ) : 
      while ( have_posts() ) :
        the_post();

        $description = get_field( 'description' );
        $client      = get_field( 'client' );
        $role        = get_field( 'role' );
        $term        = get_field( 'term' );
        $site_url    = get_field( 'site_url' );
        $github_url  = get_field( 'github_url' );
        $points      = [
          [ 'title' => get_field( 'point_1_title' ), 'text' => get_field( 'point_1_text' ) ],
          [ 'title' => get_field( 'point_2_title' ), 'text' => get_field( 'point_2_text' ) ],
          [ 'title' => get_field( 'point_3_title' ), 'text' => get_field( 'point_3_text' ) ],
        ];
    ?>

    <div class="p-works-detail__inner">

      <div class="p-works-detail__hero">
        <div class="p-works-detail__thumb">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'large', [
              'alt'           => esc_attr( get_the_title() . 'のモックアップ' ),
              'fetchpriority' => 'high',
              'decoding'      => 'async',
            ] ); ?>
          <?php endif; ?>
        </div>
        <div class="p-works-detail__hero-text">
          <h1 class="p-works-detail__title"><?php the_title(); ?></h1>
          <?php if ( $description ) : ?>
            <p class="p-works-detail__description"><?php echo esc_html( $description ); ?></p>
          <?php endif; ?>
          <dl class="p-works-detail__meta">
            <?php if ( $client ) : ?>
              <dt class="p-works-detail__meta-label">Client</dt>
              <dd class="p-works-detail__meta-value"><?php echo esc_html( $client ); ?></dd>
            <?php endif; ?>
            <?php if ( $role ) : ?>
              <dt class="p-works-detail__meta-label">Role</dt>
              <dd class="p-works-detail__meta-value"><?php echo esc_html( $role ); ?></dd>
            <?php endif; ?>
            <?php if ( $term ) : ?>
              <dt class="p-works-detail__meta-label">Term</dt>
              <dd class="p-works-detail__meta-value"><?php echo esc_html( $term ); ?></dd>
            <?php endif; ?>
            <?php if ( $site_url ) : ?>
              <dt class="p-works-detail__meta-label">URL</dt>
              <dd class="p-works-detail__meta-value"><a href="<?php echo esc_url( $site_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $site_url ); ?></a></dd>
            <?php endif; ?>
          </dl>
        </div>
      </div>

      <section class="p-works-detail__overview">
        <div class="c-heading">
          <h2 class="c-heading__title">Overview</h2>
        </div>
        <div class="p-works-detail__overview-body">
          <?php the_content(); ?>
        </div>
      </section>

      <section class="p-works-detail__points">
        <div class="c-heading">
          <h2 class="c-heading__title">Points</h2>
        </div>
        <div class="p-works-detail__points-list">
          <?php foreach ( $points as $point ) : ?>
            <?php if ( $point['title'] || $point['text'] ) : ?>
              <div class="p-works-detail__point">
                <?php if ( $point['title'] ) : ?>
                  <h3 class="p-works-detail__point-title"><?php echo esc_html( $point['title'] ); ?></h3>
                <?php endif; ?>
                <?php if ( $point['text'] ) : ?>
                  <p class="p-works-detail__point-text"><?php echo nl2br( esc_html( $point['text'] ) ); ?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </section>
    </div>
    <?php endwhile; wp_reset_postdata();
    endif;
    ?>
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
          $works_query = hoko_get_related_works( get_the_ID() ); 
          
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