<?php
/**
 * Contact ページ（CF7フォーム設置）
 */
?>
<?php get_header(); ?>

<main id="top">
  <section class="p-contact p-contact--page">
    <div class="p-contact__inner p-contact__inner--page">
        <h1 class="c-eyebrow">Contact</h1>
      <div class="p-contact__body">
        <p class="p-contact__text">
          ご相談・お問い合わせは、内容を問わずお気軽にご連絡ください。
        </p>

        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            the_content();
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>