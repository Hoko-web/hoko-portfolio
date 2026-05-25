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

  <?php get_template_part( 'template-parts/section-works', null, [ 'exclude_id' => get_the_ID() ] ); ?>

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