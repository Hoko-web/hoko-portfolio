<?php
/**
 * 404 ページ
 */
?>
<?php get_header(); ?>

<main id="top">
  <section class="p-notfound">
    <div class="p-notfound__inner">
      <h1 class="p-notfound__number">404</h1>
      <p class="p-notfound__message">
        お探しのページは見つかりませんでした。
      </p>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-btn p-notfound__back">Back To Home</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
