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
  <?php get_template_part( 'template-parts/section-works' ); ?>
</main>

<?php get_footer(); ?>